<?php

namespace App\Http\Controllers\Api;

use App\Projects\Project;
use App\Http\Controllers\Controller;

class ProjectStepsController extends Controller
{
    /**
     * Return a list of all steps belonging to the project.
     *
     * @param \App\Projects\Project $project
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Project $project)
    {
        return response()->json($project->steps);
    }
}
