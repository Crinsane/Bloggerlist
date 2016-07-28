<?php

namespace App\SocialMedia;

use App\SocialMedia;
use SammyK\LaravelFacebookSdk\LaravelFacebookSdk;
use App\Contracts\SocialMedia as SocialMediaContract;

class Facebook implements SocialMediaContract
{
    /**
     * Instance of the Facebook SDK class.
     *
     * @var \SammyK\LaravelFacebookSdk\LaravelFacebookSdk
     */
    private $facebook;

    /**
     * Facebook constructor.
     *
     * @param \SammyK\LaravelFacebookSdk\LaravelFacebookSdk $facebook
     */
    public function __construct(LaravelFacebookSdk $facebook)
    {
        $this->facebook = $facebook;
    }

    /**
     * Get the login url.
     *
     * @return string
     */
    public function getLoginUrl()
    {
        return $this->facebook->getLoginUrl();
    }

    /**
     * Handle the initial OAuth callback from the social media platform.
     *
     * @return void
     */
    public function handleCallback()
    {
        $token = $this->getClientAccessToken();

        if ( ! $token) {
            abort(403, 'Unauthorized action.');
        }

        if ( ! $token->isLongLived()) {
            $token = $this->getLongLivedToken($token);
        }

        $this->facebook->setDefaultAccessToken($token);

        $response = $this->facebook->get('/me?fields=id,name,link');

        $graphUser = $response->getGraphUser();

        auth()->user()->socialMedia->update([
            'facebook_id' => $graphUser->getId(),
            'facebook_name' => $graphUser->getName(),
            'facebook_token' => $token->getValue(),
            'facebook_token_expires_at' => $token->getExpiresAt(),
        ]);
    }

    /**
     * Get the follower count for the user.
     *
     * @param \App\SocialMedia $socialMedia
     * @return int
     */
    public function getFollowerCount(SocialMedia $socialMedia)
    {
        $this->facebook->setDefaultAccessToken($socialMedia->facebook_token);

        $response = $this->facebook->get('/me/friends');

        $graphEdge = $response->getGraphEdge();

        $metaData = $graphEdge->getMetaData();

        if( ! $metaData) {
            return 0;
        }

        return $metaData['summary']['total_count'];
    }

    /**
     * Get the client access token from the redirect request.
     *
     * @return \Facebook\Authentication\AccessToken
     */
    private function getClientAccessToken()
    {
//        try {
//            $token = $this->facebook->getAccessTokenFromRedirect();
//        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
//            dd($e->getMessage());
//        }
//
//        return $token;

        return $this->facebook->getAccessTokenFromRedirect();
    }

    /**
     * Get a long lived access token using the previous token.
     *
     * @param \Facebook\Authentication\AccessToken $token
     * @return \Facebook\Authentication\AccessToken
     */
    private function getLongLivedToken($token)
    {
        $oauth_client = $this->facebook->getOAuth2Client();

//        try {
//            $token = $oauth_client->getLongLivedAccessToken($token);
//        } catch (\Facebook\Exceptions\FacebookSDKException $e) {
//            dd($e->getMessage());
//        }

        return $oauth_client->getLongLivedAccessToken($token);
    }
}