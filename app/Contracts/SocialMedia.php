<?php

namespace App\Contracts;

use App\SocialMedia as SocialMediaModel;

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
     * Refresh the access token.
     *
     * @param \App\SocialMedia $socialMedia
     * @return mixed
     */
    public function refreshToken(SocialMediaModel $socialMedia);

    /**
     * Get the follower count for the user.
     *
     * @param \App\SocialMedia $socialMedia
     * @return int
     */
    public function getFollowerCount(SocialMediaModel $socialMedia);
}