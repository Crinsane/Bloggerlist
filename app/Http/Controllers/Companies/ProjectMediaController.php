<?php

namespace App\Http\Controllers\Companies;

use App\Projects\Project;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Media;
use App\Http\Controllers\Controller;

class ProjectMediaController extends Controller
{
    /**
     * Return a list of all images in the images collection of the given project.
     *
     * @param \App\Projects\Project $project
     * @return \Illuminate\Support\Collection
     */
    public function index(Project $project)
    {
        return $project->getMedia('images');
    }

    /**
     * Store a new image to the images collection of the given project.
     *
     * @param \App\Projects\Project    $project
     * @param \Illuminate\Http\Request $request
     * @return \Spatie\MediaLibrary\Media
     */
    public function store(Project $project, Request $request)
    {
        return $project->addImage($request->file('image'));
    }

    /**
     * Remove the given image from the images collection of the given project.
     *
     * @param \App\Projects\Project      $project
     * @param \Spatie\MediaLibrary\Media $media
     */
    public function destroy(Project $project, Media $media)
    {
        $project->deleteMedia($media);
    }
}
