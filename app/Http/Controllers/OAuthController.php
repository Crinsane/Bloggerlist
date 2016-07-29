<?php

namespace App\Http\Controllers;

use App\SocialMedia\Twitter;
use App\SocialMedia\YouTube;
use App\SocialMedia\Facebook;
use App\SocialMedia\Instagram;
use Laravel\Socialite\Facades\Socialite;

class OAuthController extends Controller
{
    /**
     * Handle the Facebook OAuth callback.
     *
     * @param \App\SocialMedia\Facebook $facebook
     * @return \Illuminate\Http\RedirectResponse
     */
    public function facebook(Facebook $facebook)
    {
        $facebook->handleCallback();

        return redirect('/settings#/socialmedia');
    }

    /**
     * Handle the Twitter OAuth callback.
     *
     * @param \App\SocialMedia\Twitter $twitter
     * @return \Illuminate\Http\RedirectResponse
     */
    public function twitter(Twitter $twitter)
    {
        $twitter->handleCallback();

        return redirect('/settings#/socialmedia');
    }

    /**
     * Handle the Instagram OAuth callback.
     *
     * @param \App\SocialMedia\Instagram $instagram
     * @return \Illuminate\Http\RedirectResponse
     */
    public function instagram(Instagram $instagram)
    {
        $instagram->handleCallback();

        return redirect('/settings#/socialmedia');
    }

    /**
     * Handle the YouTube OAuth callback.
     *
     * @param \App\SocialMedia\YouTube $youtube
     * @return \Illuminate\Http\RedirectResponse
     */
    public function youtube(YouTube $youtube)
    {
        $youtube->handleCallback();

        return redirect('/settings#/socialmedia');
    }

    /**
     * Redirect the user to the YouTube OAuth screen.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function youtubeRedirect()
    {
        return Socialite::with('youtube')->redirect();
    }
}
