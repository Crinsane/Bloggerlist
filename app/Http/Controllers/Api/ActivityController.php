<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Activities\Activity;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    /**
     * Return a list of the activity of the given user.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(User $user)
    {
        return Activity::with('user', 'target')->forUser($user)->latest()->paginate(10);
    }
}
