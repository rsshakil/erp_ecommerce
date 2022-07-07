<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $this->middleware('auth');
        $title = "Dashboard";
        $active = 'dashboard';
        return view('backend.layouts.master', compact('title', 'active'));

    }
    public function frontend()
    {
        $title = "Geniecup";
        $active = 'Geniecup';
        return view('frontend.layouts.master', compact('title', 'active'));

    }
}
