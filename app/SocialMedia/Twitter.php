<?php

namespace App\SocialMedia;

use App\SocialMedia;
use Thujohn\Twitter\Twitter as TwitterApi;
use App\Contracts\SocialMedia as SocialMediaContract;

class Twitter implements SocialMediaContract
{
    /**
     * Instance of the Twitter class.
     *
     * @var \Thujohn\Twitter\Twitter
     */
    private $twitter;

    /**
     * Twitter constructor.
     *
     * @param \Thujohn\Twitter\Twitter $twitter
     */
    public function __construct(TwitterApi $twitter)
    {
        $this->twitter = $twitter;
    }

    /**
     * Get the login url.
     *
     * @return string
     */
    public function getLoginUrl()
    {
        $token = $this->twitter->getRequestToken('http://thebloggerlist.dev/oauth/twitter');

        \Session::put('oauth_state', 'start');
        \Session::put('oauth_request_token', $token['oauth_token']);
        \Session::put('oauth_request_token_secret', $token['oauth_token_secret']);

        return $this->twitter->getAuthorizeURL($token, true, false);
    }

    /**
     * Handle the initial OAuth callback from the social media platform.
     *
     * @return void
     */
    public function handleCallback()
    {
        $requestToken = [
            'token'  => \Session::get('oauth_request_token'),
            'secret' => \Session::get('oauth_request_token_secret'),
        ];

        $this->twitter->reconfig($requestToken);

        $token = $this->twitter->getAccessToken(request('oauth_verifier'));

        auth()->user()->socialMedia->update([
            'twitter_id' => $token['user_id'],
            'twitter_name' => $token['screen_name'],
            'twitter_token' => $token['oauth_token'],
            'twitter_token_expires_at' => null,
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
        $response = $this->twitter->getUsers(['user_id' => $socialMedia->twitter_id]);

        return $response->followers_count;
    }
}