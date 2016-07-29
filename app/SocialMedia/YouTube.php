<?php

namespace App\SocialMedia;

use App\Contracts\SocialMedia;
use App\SocialMedia as SocialMediaModel;
use Alaouy\Youtube\Youtube as YoutubeApi;
use Carbon\Carbon;

class YouTube implements SocialMedia
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
     * Get the follower count for the user.
     *
     * @param \App\SocialMedia $socialMedia
     * @return int
     */
    public function getFollowerCount(SocialMediaModel $socialMedia)
    {
        $response = $this->youtube->getChannelById('UCElfoFp9Qn9cSTCK8rqq4fQ');

        return $response->statistics->subscriberCount;
    }
}