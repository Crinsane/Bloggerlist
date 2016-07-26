<?php

namespace App\Http\Controllers;

use App\Projects\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

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
