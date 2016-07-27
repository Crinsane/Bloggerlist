<?php

namespace App\Http\Controllers\Api;

use App\Projects\Project;
use App\Http\Controllers\Controller;

class ProjectStepsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Return a list of all steps belonging to the project.
     *
     * @param \App\Projects\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Project $project)
    {
        return $project->steps;
    }
}
