<?php

namespace App\Http\Controllers;

use App\Addon;
use Illuminate\Http\Request;

class AddonsController extends Controller
{
    public function ShowAll()
    {
        return view('listing.listing');
    }

    public function Add()
    {
        return view('listing.add');
    }

    public function ViewDetails()
    {
        return view('listing.info');
    }

    public function StoreAddon(Request $request)
    {
        echo 'Request: '.$request;
    }
}
