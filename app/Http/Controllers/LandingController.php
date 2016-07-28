<?php

namespace App\Http\Controllers;

class LandingController extends Controller
{
    /**
     * Show the application splash screen.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('landing');
    }
}
