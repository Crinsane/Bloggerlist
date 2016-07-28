<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Events\Users\UserStartedFollowing;
use App\Events\Users\UserStoppedFollowing;

class UserFollowersController extends Controller
{
    /**
     * Add a user to the list of users the authenticated user is following.
     *
     * @param \App\User                $user
     * @param \Illuminate\Http\Request $request
     */
    public function store(User $user, Request $request)
    {
        $request->user()->follow($user);

        event(new UserStartedFollowing($request->user(), $user));
    }

    /**
     * Remove a user from the list of users the authenticated user is following.
     *
     * @param \App\User                $user
     * @param \Illuminate\Http\Request $request
     */
    public function destroy(User $user, Request $request)
    {
        $request->user()->unfollow($user);

        event(new UserStoppedFollowing($request->user(), $user));
    }
}
