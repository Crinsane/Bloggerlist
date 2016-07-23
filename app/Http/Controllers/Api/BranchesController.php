<?php

namespace App\Http\Controllers\Api;

use App\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BranchesController extends Controller
{
    /**
     * Return a list of all branches.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(Branch::all());
    }
}
