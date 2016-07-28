<?php

namespace App\Http\Controllers;

use App\Projects\Project;
use App\Projects\Category;

class ProjectsController extends Controller
{
    /**
     * Show a listing of all projects.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $category = Category::findBySlug(request('category'));

        $projects = Project::with('category', 'user')
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            })
            ->whereNull('completed_at')
            ->latest()
            ->paginate(9);

        return view('projects.index', compact('projects', 'category'));
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
