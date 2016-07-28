<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectSubscriptionControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_subscribe_a_user_for_a_project()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        $this->expectsEvents(\App\Events\Projects\UserHasSubscribed::class);

        $this->be($user);

        $this->post('/projects/1/subscribe', ['message' => 'Subscription message'])->assertResponseOk();

        $this->seeInDatabase('user_project_subscriptions', ['user_id' => 1, 'project_id' => 1, 'message' => 'Subscription message']);
    }

    /** @test */
    public function it_will_unsubscribe_a_user_from_a_project()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        $this->app->make('db')->table('user_project_subscriptions')->insert(['user_id' => 1, 'project_id' => 1, 'message' => 'Subscription message']);

        $this->be($user);

        $this->delete('/projects/1/unsubscribe')->assertResponseOk();

        $this->dontSeeInDatabase('user_project_subscriptions', ['user_id' => 1, 'project_id' => 1, 'message' => 'Subscription message']);
    }
}