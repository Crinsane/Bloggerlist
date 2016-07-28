<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserFollowersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_add_a_user_to_a_users_followers_list()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\User::class)->create();

        $this->be($user);

        $this->expectsEvents(\App\Events\Users\UserStartedFollowing::class);

        $this->post('/users/2/follow')->assertResponseOk();

        $this->seeInDatabase('user_follows', ['user_id' => 1, 'follows' => 2]);
    }

    /** @test */
    public function it_will_remove_a_user_from_a_users_followers_list()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\User::class)->create();

        $this->app->make('db')->table('user_follows')->insert(['user_id' => 1, 'follows' => 2]);

        $this->be($user);

        $this->expectsEvents(\App\Events\Users\UserStoppedFollowing::class);

        $this->delete('/users/2/unfollow')->assertResponseOk();

        $this->dontSeeInDatabase('user_follows', ['user_id' => 1, 'follows' => 2]);
    }
}