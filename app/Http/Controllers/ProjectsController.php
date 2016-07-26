<?php

namespace App\Http\Controllers;

use App\Projects\Project;

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
     * Show a listing of all projects.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $projects = Project::with('category', 'user')
            ->whereNull('completed_at')
            ->latest()
            ->paginate(9);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show a detailed view of the project.
     *
     * @param \App\Projects\Project $project
     * @return \Illuminate\View\View
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }
}
