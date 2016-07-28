<?php

namespace App\Http\Controllers;

use App\User;
use Laravel\Spark\Contracts\Repositories\Geography\CountryRepository;

class BloggersController extends Controller
{
    /**
     * Show a listing of all bloggers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $bloggers = User::bloggers()->paginate(12);

        return view('bloggers.index', compact('bloggers'));
    }

    /**
     * Show a detailed view of the blogger.
     *
     * @param \App\User $user
     * @return \Illuminate\View\View
     */
    public function show(User $user, CountryRepository $countries)
    {
        $country = $user->country ? $countries->all()[$user->country] : '';

        return view('bloggers.show', ['blogger' => $user, 'country' => $country]);
    }
}