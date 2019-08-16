<?php

namespace App\Http\Controllers;

use App\Addon;
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
        return view('manage', ['addons' => $addons]);
    }
}
