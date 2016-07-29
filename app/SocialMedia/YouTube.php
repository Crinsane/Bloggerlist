<?php

namespace App\SocialMedia;

use Carbon\Carbon;
use App\SocialMedia;
use Alaouy\Youtube\Youtube as YoutubeApi;
use App\Contracts\SocialMedia as SocialMediaContract;

class YouTube implements SocialMediaContract
{
    /**
     * Instance of the Youtube class.
     *
     * @var \Alaouy\Youtube\Youtube
     */
    private $youtube;

    /**
     * YouTube constructor.
     *
     * @param \Alaouy\Youtube\Youtube $youtube
     */
    public function __construct(YoutubeApi $youtube)
    {
        $this->youtube = $youtube;
    }

    /**
     * Get the login url.
     *
     * @return string
     */
    public function getLoginUrl()
    {
        // TODO: Implement getLoginUrl() method.
    }

    /**
     * Handle the initial OAuth callback from the social media platform.
     *
     * @return void
     */
    public function handleCallback()
    {
        $user = \Socialite::driver('youtube')->stateless()->user();

        auth()->user()->socialMedia->update([
            'youtube_id' => $user->id,
            'youtube_name' => $user->nickname,
            'youtube_token' => $user->token,
            'youtube_token_expires_at' => Carbon::now()->addSeconds($user->expiresIn),
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
        $response = $this->youtube->getChannelById('UCElfoFp9Qn9cSTCK8rqq4fQ');

        return $response->statistics->subscriberCount;
    }
}