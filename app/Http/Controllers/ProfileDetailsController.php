<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileDetailsController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Update the user's profile details.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'website' => 'active_url',
            'branch' => 'exists:branches,id'
        ]);

        $request->user()->forceFill([
            'title' => $request->title,
            'website' => $request->website,
            'branch_id' => $request->branch,
            'description' => $request->description,
        ])->save();
    }
}
