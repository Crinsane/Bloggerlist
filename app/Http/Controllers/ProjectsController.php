<?php

namespace App\Http\Controllers;

use App\Projects\Category;
use App\Projects\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $projects = Project::forUser(auth()->user())->get();

        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateProjectRequest $request)
    {
        $project = Project::createProjectForUser($request->user(), $request->only(['title', 'description', 'reward', 'category_id', 'location']));

        $project->addImages($request->allFiles()['images']);

        return response()->json([
            'redirect' => route('projects.edit', $project)
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Projects\Project $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $categories = Category::all();

        return view('projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProjectRequest $request
     * @param \App\Projects\Project                   $project
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->only(['title', 'description', 'reward', 'category_id', 'location']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
