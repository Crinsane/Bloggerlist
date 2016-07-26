<?php

namespace App\Http\Controllers;

use App\Projects\Project;
use Illuminate\Http\Request;

class ProjectSubscriptionController extends Controller
{
    /**
     * Subscribe the user for the project.
     *
     * @param \App\Projects\Project    $project
     * @param \Illuminate\Http\Request $request
     */
    public function store(Project $project, Request $request)
    {
        $request->user()->subscribeForProjectWithMessage($project, $request->message);
    }

    /**
     * Unsubscribe the user from the project.
     *
     * @param \App\Projects\Project    $project
     * @param \Illuminate\Http\Request $request
     */
    public function destroy(Project $project, Request $request)
    {
        $request->user()->unsubscribeFromProject($project);
    }
}
