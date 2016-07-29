<?php

namespace App\Console\Commands;

use App\SocialMedia;
use App\SocialMedia\Facebook;
use App\SocialMedia\Instagram;
use App\SocialMedia\Twitter;
use App\SocialMedia\YouTube;
use App\SocialMediaStat;
use App\User;
use Illuminate\Console\Command;

class UpdateSocialMediaStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'socialmedia:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the social media statistics for all users.';

    /**
     * Instance of the Facebook class.
     *
     * @var \App\SocialMedia\Facebook
     */
    private $facebook;

    /**
     * Instance of the Twitter class.
     *
     * @var \App\SocialMedia\Twitter
     */
    private $twitter;

    /**
     * Instance of the Instagram class.
     *
     * @var \App\SocialMedia\Instagram
     */
    private $instagram;

    /**
     * Instance of the YouTube class.
     *
     * @var \App\SocialMedia\YouTube
     */
    private $youtube;

    /**
     * Create a new command instance.
     *
     * @param \App\SocialMedia\Facebook  $facebook
     * @param \App\SocialMedia\Twitter   $twitter
     * @param \App\SocialMedia\Instagram $instagram
     * @param \App\SocialMedia\YouTube   $youtube
     */
    public function __construct(Facebook $facebook, Twitter $twitter, Instagram $instagram, YouTube $youtube)
    {
        parent::__construct();

        $this->facebook = $facebook;
        $this->twitter = $twitter;
        $this->instagram = $instagram;
        $this->youtube = $youtube;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Fetching all users...');

        $users = $this->fetchUsers();

        $this->info("Updating the social media statistics of all users...\n");

        $bar = $this->output->createProgressBar(count($users));

        foreach ($users as $user) {
            $this->updateSocialMediaStats($user->socialMedia);

            $bar->advance();
        }

        $bar->finish();

        $this->info("\n\nAll done!");
    }

    /**
     * Update the social media stats of the given user.
     *
     * @param \App\SocialMedia $socialMedia
     * @return void
     */
    private function updateSocialMediaStats(SocialMedia $socialMedia)
    {
        $stat = new SocialMediaStat(['user_id' => $socialMedia->user_id]);

        if ($socialMedia->facebook_token) {
            if ($socialMedia->tokenShouldBeUpdated('facebook')) {
                $refreshedToken = $this->facebook->refreshToken($socialMedia);
                $token = $refreshedToken->getValue();
                $expiresAt = $refreshedToken->getExpiresAt();
                $socialMedia->updateToken('facebook', $token, $expiresAt);
            }

            $stat->facebook = $this->facebook->getFollowerCount($socialMedia);
        }

        if ($socialMedia->twitter_token) {
            $stat->twitter = $this->twitter->getFollowerCount($socialMedia);
        }

        if ($socialMedia->instagram_token) {
            $stat->instagram = $this->instagram->getFollowerCount($socialMedia);
        }

        if ($socialMedia->youtube_token) {
            $stat->youtube = $this->youtube->getFollowerCount($socialMedia);
        }

        $stat->save();
    }

    /**
     * Fetch all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    private function fetchUsers()
    {
        return User::has('socialMedia')->get();
    }
}
