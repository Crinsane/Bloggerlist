<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    /**
     * Show the application splash screen.
     *
     *
     */
    public function show()
    {
        return view('dashboard');
    }
}
