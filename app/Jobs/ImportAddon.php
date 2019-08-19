<?php

namespace App\Jobs;

use App\Addon;

use DrSlump\Sexp;
use Illuminate\Bus\Queueable;
use Illuminate\Http\File;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;

class ImportAddon implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $addon;

    public $tries = 1;

    private $download_directory = "addons";
    private $file_path = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Addon $addon)
    {
        $this->addon = $addon;
    }

    function endsWith($string, $endString) 
    { 
        $len = strlen($endString); 
        if ($len == 0) { 
            return true; 
        } 
        return (substr($string, -$len) === $endString); 
    }

    private function downloadZIP()
    {
        $url = $this->addon->http_url;
        $file_contents = file_get_contents($url);
        $name = substr($url, strrpos($url, '/') + 1);
        $author = $this->addon->author->name;
        $slug = $this->addon->slug;
        $this->file_path = $this->download_directory."/".$author."/".$slug."/".$name;
        Storage::disk('public')->put($this->file_path, $file_contents);
    }

    private function parseZIPNFOFile()
    {
        $zip_location = Storage::disk('public')->path($this->file_path);
        $zip = zip_open($zip_location);
        while($zip_entry = zip_read($zip))
        {
            $entry_name = zip_entry_name($zip_entry);
            if($this->endsWith($entry_name, ".nfo"))
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
            }
        }
        zip_close($zip);
        $this->addon->http_url = $this->file_path;
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
