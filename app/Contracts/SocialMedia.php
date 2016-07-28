<?php

namespace App\Contracts;

interface SocialMedia
{
    /**
     * Get the login url.
     *
     * @return string
     */
    public function getLoginUrl();

    /**
     * Handle the initial OAuth callback from the social media platform.
     *
     * @return void
     */
    public function handleCallback();

    /**
     * Get the follower count for the user belonging to the access token.
     *
     * @param string $token
     * @return int
     */
    public function getFollowerCount($token);
}