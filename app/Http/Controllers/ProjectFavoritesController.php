<?php

namespace App\Http\Controllers;

use App\Events\Projects\UserHasFavorited;
use App\Projects\Project;
use Illuminate\Http\Request;

class ProjectFavoritesController extends Controller
{
    /**
     * Add the project to the user's favorites.
     *
     * @param \App\Projects\Project    $project
     * @param \Illuminate\Http\Request $request
     */
    public function store(Project $project, Request $request)
    {
        $request->user()->favorite($project);

        event(new UserHasFavorited($request->user(), $project));
    }

    /**
     * Remove the project from the user's favorites.
     * @param \App\Projects\Project    $project
     * @param \Illuminate\Http\Request $request
     */
    public function destroy(Project $project, Request $request)
    {
        $request->user()->unfavorite($project);
    }
}
