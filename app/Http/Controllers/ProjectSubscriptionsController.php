<?php

namespace App\Http\Controllers;

use App\Projects\Project;
use Illuminate\Http\Request;
use App\Events\Projects\UserHasSubscribed;

class ProjectSubscriptionsController extends Controller
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

        event(new UserHasSubscribed($request->user(), $project));
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
