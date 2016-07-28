<?php

namespace App\Console\Commands;

use App\SocialMedia;
use App\SocialMedia\Facebook;
use App\SocialMedia\Twitter;
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
     * @var \App\SocialMedia\Facebook
     */
    private $facebook;

    /**
     * @var \App\SocialMedia\Twitter
     */
    private $twitter;

    /**
     * Create a new command instance.
     *
     * @param \App\SocialMedia\Facebook $facebook
     * @param \App\SocialMedia\Twitter  $twitter
     */
    public function __construct(Facebook $facebook, Twitter $twitter)
    {
        parent::__construct();

        $this->facebook = $facebook;
        $this->twitter = $twitter;
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
            $stat->facebook = $this->facebook->getFollowerCount($socialMedia->facebook_token);
            $stat->twitter = $this->twitter->getFollowerCount($socialMedia->twitter_token);
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
