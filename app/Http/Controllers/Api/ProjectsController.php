<?php

namespace App\Http\Controllers\Api;

use App\Projects\Project;
use App\Http\Controllers\Controller;
use App\User;

class ProjectsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return a list of all project for the current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return Project::with('category', 'subscribers')->forUser(auth()->user())->get();
    }

    /**
     * Return a list of all projects of the given user.
     *
     * @param \App\User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(User $user)
    {
        return Project::with('category', 'subscribers')->forUser($user)->get();
    }
}
