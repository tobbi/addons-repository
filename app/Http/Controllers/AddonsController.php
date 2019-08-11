<?php

namespace App\Http\Controllers;

use App\Addon;
use App\License;
use DrSlump\Sexp;
use Illuminate\Http\Request;

class AddonsController extends Controller
{
    /**
     * Region: Views
     */
    public function ShowAll()
    {
        return view('listing.listing');
    }

    public function Add()
    {
        $licenses = License::all();
        return view('listing.add', ['licenses' => $licenses]);
    }

    public function ViewDetails()
    {
        return view('listing.info');
    }

    public function Migrate()
    {
        return view('listing.migrate');
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
                    echo $property."<br/>";
                break;

                case "array":
                    $key = $property[0];
                    $value = $property[1];
                    switch($key)
                    {
                        case "kind":
                        $kind = ($value == "Worldmap") ? 1 : 2;
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
                            echo "Unknown value: ".$key;
                        break;
                    }
                break;
            }
        }
        $addon = new Addon();
        $addon->title = $title;
        $addon->version = 0.1;
        $addon->description = $title;
        $addon->slug = "addon-slug-tbd";
        $addon->http_url = $httpUrl;
        $addon->thumb_url = $httpUrl;
        $addon->md5 = $md5;
        $addon->author_id = 1;
        $addon->license_id = 1;
        $addon->enabled = true;
        $addon->type = $kind;
        $addon->save();
    }

    public function MigrateFromNFO(Request $request)
    {
        $nfo_url = $request->nfoURL;
        $contents = file_get_contents($nfo_url);

        $parser = new Sexp();
        $lisp_tree = $parser->parse($contents);

        if($lisp_tree[0] != "supertux-addons")
        {
            echo "Invalid lisp file specified";
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
    }
}
