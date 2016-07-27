<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_will_add_a_project_to_a_users_favorites()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        $project = factory(\App\Projects\Project::class)->create(['user_id' => $user->id, 'category_id' => 1]);

        /** @var \App\User $user */
        $user->favorite($project);

        $this->seeInDatabase('user_project_favorites', ['user_id' => $user->id, 'project_id' => $project->id]);
    }

    /** @test */
    public function it_will_remove_a_project_from_a_users_favorites()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        $project = factory(\App\Projects\Project::class)->create(['user_id' => $user->id, 'category_id' => 1]);

        $this->app->make('db')->table('user_project_favorites')->insert(['user_id' => $user->id, 'project_id' => $project->id]);

        /** @var \App\User $user */
        $user->unfavorite($project);

        $this->dontSeeInDatabase('user_project_favorites', ['user_id' => $user->id, 'project_id' => $project->id]);
    }

    /** @test */
    public function it_will_subscribe_a_user_for_a_project()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        $project = factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        /** @var \App\User $user */
        $user->subscribeForProjectWithMessage($project, 'Subscription message');

        $this->seeInDatabase('user_project_subscriptions', ['user_id' => 1, 'project_id' => 1, 'message' => 'Subscription message']);
    }

    /** @test */
    public function it_will_unsubscribe_a_user_from_a_project()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        $project = factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        $this->app->make('db')->table('user_project_subscriptions')->insert(['user_id' => 1, 'project_id' => 1, 'message' => 'Subscription message']);

        /** @var \App\User $user */
        $user->unsubscribeFromProject($project);

        $this->dontSeeInDatabase('user_project_subscriptions', ['user_id' => 1, 'project_id' => 1, 'message' => 'Subscription message']);
    }
}