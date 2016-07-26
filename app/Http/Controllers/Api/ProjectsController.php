<?php

namespace App\Http\Controllers\Api;

use App\Projects\Project;
use App\Http\Controllers\Controller;

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
        return response()->json(
            Project::with('category', 'subscribers')->forUser(auth()->user())->get()
        );
    }
}
