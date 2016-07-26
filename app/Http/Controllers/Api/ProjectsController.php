<?php

namespace App\Http\Controllers\Api;

use App\Projects\Project;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    /**
     * Return a list of all project for the current user.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(
            Project::with('category')->forUser(auth()->user())->get()
        );
    }
}
