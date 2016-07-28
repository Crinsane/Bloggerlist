<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class ProjectSubscriptionsController extends Controller
{
    /**
     * Return a list of all projects the current user has subscribed for.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return auth()->user()->subscribedProjects()->latest()->get();
    }
}
