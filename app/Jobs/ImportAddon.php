<?php

namespace App\Jobs;

use App\Addon;
use App\AddonRevision;
use App\SuperTuxVersion;
use App\SuperTuxVersionToAddonRevision;

use App\Events\AddonUpdated;

use DrSlump\Sexp;
use Illuminate\Bus\Queueable;
use Illuminate\Http\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class ImportAddon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $addon;
    protected $st_version;

    public $tries = 1;

    private $download_directory = "addons";
    private $file_path = null;

    private $timestamp = null;

    private $hash_sha256 = null;
    private $hash_md5 = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Addon $addon, string $st_version)
    {
        $this->addon = $addon;
        $this->st_version = $st_version;
    }

    private function downloadZIP()
    {
        $url = $this->addon->http_url;
        $file_contents = file_get_contents($url);
        $this->hash_md5 = hash('md5', $file_contents);
        $this->hash_sha256 = hash('sha256', $file_contents);
        $name = substr($url, strrpos($url, '/') + 1);
        $author = $this->addon->author->name;
        $slug = $this->addon->slug;
        $this->timestamp = time();
        $this->file_path = sprintf("%s/%s/%s/%s/%s", 
            $this->download_directory,
            $author, $slug, $this->timestamp, $name);
        Storage::disk('public')->put($this->file_path, $file_contents);
    }

    private function parseZIPNFOFile()
    {
        $zip_location = Storage::disk('public')->path($this->file_path);
        $zip = zip_open($zip_location);
        while($zip_entry = zip_read($zip))
        {
            $entry_name = zip_entry_name($zip_entry);
            if(Str::endsWith($entry_name, ".nfo"))
            {
                zip_entry_open($zip, $zip_entry);
                $contents = zip_entry_read($zip_entry);
                zip_entry_close($zip_entry);
                // $this->addon->description .= "\r\n".$contents;
                $parser = new Sexp();
                try
                {
                    $lisp_tree = $parser->parse($contents);
                    foreach($lisp_tree as $item)
                    {
                        $type = gettype($item);
                        switch($type)
                        {
                            case "array":
                            $key = $item[0];
                            $value = $item[1];
                            switch($key)
                            {
                                case "id":
                                $this->addon->slug = $value;
                                break;

                                case "version":
                                $this->addon->version = $value;
                                break;
                            }
                            break;
            
                            default:
                            break;
                        }
                    }
                }
                catch(Exception $ex)
                {
                    $this->addon->description .= "\r\n".$ex->getMessage();
                }

                break;
            }
        }
        zip_close($zip);
        $this->addon->http_url = $this->file_path;

        if($this->addon->slug == "addon-slug-tbd")
        {
            $this->addon->slug = Str::kebab($this->addon->getRealAuthorName())." ".strtolower($this->addon->title);
        }

        $supertux_version = SuperTuxVersion::where("id", $this->st_version)->first();

        $revision = new AddonRevision();
        $revision->addon_id = $this->addon->id;
        $revision->author_id = $this->addon->author_id;
        $revision->changed = date("Y-m-d H:i:s");
        $revision->file_path = $this->file_path;
        $revision->version = $this->timestamp;
        $revision->sha256 = $this->hash_sha256;
        $revision->md5 = $this->hash_md5;
        $revision->revision_text = "SuperTux ".$supertux_version->name.": Automated import via nfo file";
        $revision->save();

        Event::dispatch(new AddonUpdated($this->addon, $revision));

        $st_version_to_addon_revision = SuperTuxVersionToAddonRevision::where(["supertux_version_id" => $this->st_version,
                                                                               "addon_id"            => $this->addon->id])->first();
        if($st_version_to_addon_revision == null)
        {
            $st_version_to_addon_revision = new SuperTuxVersionToAddonRevision();
            $st_version_to_addon_revision->supertux_version_id = $this->st_version;
            $st_version_to_addon_revision->addon_id = $this->addon->id;
        }
        $st_version_to_addon_revision->revision_id = $revision->id;
        $st_version_to_addon_revision->save();
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->downloadZIP();
        $this->parseZIPNFOFile();
        $this->addon->enabled = true;
        $this->addon->save();
    }
}
