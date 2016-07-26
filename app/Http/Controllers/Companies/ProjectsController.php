<?php

namespace App\Http\Controllers\Companies;

use App\Projects\Project;
use App\Projects\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Gloudemans\Notify\Notifications\AddsNotifications;

class ProjectsController extends Controller
{
    use AddsNotifications;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('company.projects.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\CreateProjectRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $project = Project::createProjectForUser(
            $request->user(), $request->only(['title', 'description', 'reward', 'category_id', 'location'])
        );

        $project->addSteps(array_map(function ($step) {
            return json_decode($step, true);
        }, $request->get('steps')));

        $project->addImages($request->file('images'));

        $this->notifySuccess('Your new project has successfully been created.');

        return response()->json([
            'redirect' => route('company.projects.edit', $project)
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

        return view('company.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProjectRequest $request
     * @param \App\Projects\Project                   $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->only(['title', 'description', 'reward', 'category_id', 'location']));

        $project->steps()->delete();

        $project->addSteps($request->steps);
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
