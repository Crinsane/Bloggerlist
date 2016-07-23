<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    /**
     * Show the application splash screen.
     *
     *
     */
    public function show()
    {
        return view('landing');
    }
}
