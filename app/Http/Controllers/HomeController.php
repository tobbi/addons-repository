<?php

namespace App\Http\Controllers;

use App\Addon;
use App\License;
use App\SuperTuxVersion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show list of add-ons
     */
    public function manage()
    {
        $addons = Addon::all();
        $licenses = License::all();
        $st_versions = SuperTuxVersion::all();
        return view('manage', ['addons' => $addons, 'licenses' => $licenses, 'st_versions' => $st_versions]);
    }

    /**
     * Manage SuperTux versions
     */
    public function manage_supertux_versions()
    {
        $st_versions = SuperTuxVersion::all();
        return view('manage_supertux_versions', ['st_versions' => $st_versions]);
    }
}
