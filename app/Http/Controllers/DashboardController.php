<?php

namespace App\Http\Controllers;

use App\Performance\UserFollowersPerformance;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function show(UserFollowersPerformance $performance)
    {
        $followerCount = $performance->getFollowerCountForUser(auth()->user());
        $newFollowersLastWeek = $performance->getNewFollowerCountForLastWeek(auth()->user());

        return view('dashboard', compact('followerCount', 'newFollowersLastWeek'));
    }
}
