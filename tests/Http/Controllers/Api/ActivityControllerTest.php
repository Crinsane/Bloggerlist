<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_get_all_activities_for_a_given_user()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\Activities\Activity::class)->times(5)->create(['user_id' => 1]);

        $this->be($user);

        $this->get('/api/users/1/activity')
            ->assertResponseOk()
            ->seeJsonStructure(['current_page', 'last_page', 'data' => ['*' => ['user_id', 'target', 'title', 'body']]]);
    }

    /** @test */
    public function it_will_get_all_activities_for_all_users_a_user_is_following()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\User::class)->create();
        $this->app->make('db')->table('user_follows')->insert(['user_id' => 1, 'follows' => 2]);
        factory(\App\Activities\Activity::class)->times(5)->create(['user_id' => 2]);

        $this->be($user);

        $this->get('/api/activity')
            ->assertResponseOk()
            ->seeJsonStructure(['current_page', 'last_page', 'data' => ['*' => ['user_id', 'target', 'title', 'body']]]);
    }
}