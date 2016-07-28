<?php

namespace App\Http\Controllers\Settings;

use App\Branch;
use Laravel\Spark\Http\Controllers\Settings\DashboardController as SparkDashboardController;

class DashboardController extends SparkDashboardController
{
    /**
     * Show the settings dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $branches = Branch::all();

        return view('spark::settings', compact('branches'));
    }
}
