<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Spark\Contracts\Repositories\Geography\CountryRepository;

class CompaniesController extends Controller
{
    /**
     * Show a listing of all companies.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $companies = User::companies()->paginate(12);

        return view('companies.index', compact('companies'));
    }

    /**
     * Show a detailed view of the blogger.
     *
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user, CountryRepository $countries)
    {
        $latestProject = $user->projects()->latest()->first();
        $country = $user->country ? $countries->all()[$user->country] : '';

        return view('companies.show', ['company' => $user, 'latestProject' => $latestProject, 'country' => $country]);
    }
}
