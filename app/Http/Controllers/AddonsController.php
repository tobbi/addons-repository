<?php

namespace App\Http\Controllers;

use App\Addon;
use App\License;
use Sexp\Sexp;
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

    public function MigrateFromNFO(Request $request)
    {
        $nfo_url = $request->nfoURL;
        echo $nfo_url;
    }
}
