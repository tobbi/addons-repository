<?php

namespace App\Http\Controllers;

use App\Addon;
use App\AddonType;
use App\Author;
use App\Jobs\ImportAddon;
use App\License;
use DrSlump\Sexp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AddonsController extends Controller
{
    /**
     * Region: Views
     */
    public function ShowAll()
    {
        $addons = Addon::where('enabled', 1)->get();
        return view('listing.listing', ['addons' => $addons]);
    }

    public function Add()
    {
        $licenses = License::all();
        return view('listing.add', ['licenses' => $licenses]);
    }

    public function ViewDetails($id)
    {
        $addon = Addon::where('id', $id)->first();
        return view('listing.info', ['addon' => $addon]);
    }

    public function Download($id)
    {
        $addon = Addon::where('id', $id)->first();
        if($addon == null || !$addon->enabled || $addon->http_url == null)
        {
            return;
        }

        return Storage::disk('public')->download($addon->http_url);
    }

    public function Migrate()
    {
        return view('listing.migrate');
    }

    public function ToggleVisibility($id)
    {
        $addon = Addon::where('id', $id)->first();
        if($addon == null)
        {
            return response()->json(["err_code" => 1, "err_msg" => "Toggling visibility failed. Addon not found."]);
        }
        $addon->enabled = !$addon->enabled;
        $addon->save();
        return response()->json(["err_code" => -1, "is_enabled" => $addon->enabled]);
    }

    public function StoreAddon(Request $request)
    {
        $addon = new Addon();
        $addon->title = $request->addon_name;
        $addon->id = $request->addon_id;
        $addon->version = $request->addon_version;
        $addon->slug = "my-addon-slug";
        $addon->enabled = true;
        // echo 'Request: '.$request;
        // echo 'Addon name: '.$request->addon_name;
        // AddonsController::ShowAll();
    }

    /**
     * Parses one block of add-ons in the nfo file
     * and adds it to the database.
     */
    private function _parseAddonInfo(array $addonInfo)
    {
        $id = null;
        $kind = null;
        $title = null;
        $author = null;
        $license = null;
        $httpUrl = null;
        $file = null;
        $md5 = null;
        foreach($addonInfo as $property)
        {
            $type = gettype($property);
            switch($type)
            {
                case "string":
                    // echo $property."<br/>";
                break;

                case "array":
                    $key = $property[0];
                    $value = $property[1];
                    switch($key)
                    {
                        case "version":
                        break;

                        case "id":
                        $id = $value;
                        break;

                        case "kind":
                        case "type":
                        $kind = $value;
                        break;
                        
                        case "title":
                        $title = $value;
                        break;
                        
                        case "author":
                        $author = $value;
                        break;
                        
                        case "license":
                        $license = $value;
                        break;
                        
                        case "url":
                        case "http-url":
                        $httpUrl = $value;
                        break;
                        
                        case "file":
                        $file = $value;
                        break;
                        
                        case "md5":
                        $md5 = $value;
                        break;

                        default:
                            array_push($responseArr[warnings], "Unknown value ".$key." in NFO file");
                        break;
                    }
                break;
            }
        }

        $targetType = AddonType::where('nfo_key', $kind)->first();
        $type = null;
        if($targetType != null)
        {
            $type = $targetType->id;
        }
        else
        {
            $type = AddonType::first()->id;
        }

        $targetAuthor = Author::where('name', $author)->first();
        $authorId = null;
        if($targetAuthor == null)
        {
            $newAuthor = new Author();
            $newAuthor->name = $author;
            $authorId = $newAuthor->save();
        }
        else
        {
            $authorId = $targetAuthor->id;
        }

        $targetAddon = Addon::where('slug', $id)->first();
        if($targetAddon == null)
        {
            $addon = new Addon();
        }
        else
        {
            $addon = $targetAddon;
        }
        $addon->title = $title;
        $addon->version = 0.1;
        $addon->description = $title;
        $addon->slug = $id != null ? $id : "addon-slug-tbd";
        $addon->http_url = $httpUrl;
        $addon->thumb_url = $httpUrl;
        $addon->md5 = $md5;
        $addon->author_id = $authorId;
        $addon->license_id = 1;
        $addon->enabled = false;
        $addon->type = $type;
        $addon->save();

        // Do further import steps:
        ImportAddon::dispatch($addon);

        $this->addon_cnt++;
    }

    private $responseArr = null;
    private $addon_cnt = 0;

    private function urlExists($file)
    {
        $file_headers = @get_headers($file);
        if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
            return false;
        }
        else {
            return true;
        }
    }

    private function ClearResponse()
    {
        $responseArr = array(
            "error_code" => -1,
            "text" => "",
            "warnings" => array()
        );
    }

    private function SetResponse($err_code = -1, $msg = '')
    {
        $responseArr["error_code"] = $err_code;
        $responseArr["text"] = $msg;

        return response()->json($responseArr);
    }

    public function MigrateFromNFO(Request $request)
    {
        $this->ClearResponse();
        $nfo_url = $request->nfoURL;
        $this->addon_cnt = 0;

        if($this->urlExists($nfo_url))
        {
            $contents = file_get_contents($nfo_url);
        }
        else
        {
            return $this->SetResponse(1, "The file you specified is not accessible");
        }

        $parser = new Sexp();
        try
        {
            $lisp_tree = $parser->parse($contents);
        }
        catch(RuntimeException $ex)
        {
            return $this->SetResponse(3, "The file you specified is not a valid nfo file.");
        }

        if($lisp_tree[0] != "supertux-addons")
        {
            $this->SetResponse(2, "The file you specified does not appear to have a valid format");
            return;
        }

        foreach($lisp_tree as $item)
        {
            $type = gettype($item);
            switch($type)
            {
                case "array":
                if($item[0] == "supertux-addoninfo")
                {
                    $this->_parseAddonInfo($item);
                }
                break;

                default:
                break;
            }
        }

        return $this->SetResponse(-1, $this->addon_cnt." add-ons successfully imported.");
    }
}
