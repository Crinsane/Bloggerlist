<?php

namespace App\SocialMedia;

use App\SocialMedia;
use \Andreyco\Instagram\Client;
use App\Contracts\SocialMedia as SocialMediaContract;

class Instagram implements SocialMediaContract
{
    /**
     * Instance of the Instagram client.
     *
     * @var \Andreyco\Instagram\Client
     */
    private $instagram;

    /**
     * Instagram constructor.
     *
     * @param \Andreyco\Instagram\Client $instagram
     */
    public function __construct(Client $instagram)
    {
        $this->instagram = $instagram;
    }

    /**
     * Get the login url.
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->instagram->getLoginUrl();
    }

    /**
     * Handle the initial OAuth callback from the social media platform.
     *
     * @return void
     */
    public function handleCallback()
    {
        $data = $this->instagram->getOAuthToken(request('code'));

        auth()->user()->socialMedia->update([
            'instagram_id' => $data->user->id,
            'instagram_name' => $data->user->username,
            'instagram_token' => $data->access_token,
            'instagram_token_expires_at' => null,
        ]);
    }

    /**
     * Refresh the access token.
     *
     * @param \App\SocialMedia $socialMedia
     * @return mixed
     */
    public function refreshToken(SocialMedia $socialMedia)
    {
        // TODO: Implement refreshToken() method.
    }

    /**
     * Get the follower count for the user.
     *
     * @param \App\SocialMedia $socialMedia
     * @return int
     */
    public function getFollowerCount(SocialMedia $socialMedia)
    {
        $this->instagram->setAccessToken($socialMedia->instagram_token);

        $likes = $this->instagram->getUser();

        return $likes->data->counts->followed_by;
    }
}