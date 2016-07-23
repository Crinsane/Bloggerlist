<?php

namespace App\Http\Controllers\Api;

use App\Projects\Project;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProjectsController extends Controller
{
    public function index()
    {
        return Project::with('category')->forUser(auth()->user())->get();
    }
}
