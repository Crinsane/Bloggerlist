<?php

namespace App\Http\Controllers;

use App\Projects\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use Spatie\MediaLibrary\Media;

class ProjectMediaController extends Controller
{
    public function show(Project $project)
    {
        return $project->getMedia('images');
    }

    public function store(Project $project, Request $request)
    {
        return $project->addImage($request->file('image'));
    }

    public function destroy(Project $project, Media $media)
    {
        $project->deleteMedia($media);
    }
}
