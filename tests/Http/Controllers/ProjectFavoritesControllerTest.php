<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectFavoritesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_add_a_project_to_a_users_favorites()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        $this->be($user);

        $this->post('/projects/1/favorite');

        $this->seeInDatabase('user_project_favorites', ['user_id' => 1, 'project_id' => 1]);
    }

    /** @test */
    public function it_will_remove_a_project_from_a_users_favorites()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        $this->app->make('db')->table('user_project_favorites')->insert(['user_id' => 1, 'project_id' => 1]);

        $this->be($user);

        $this->delete('/projects/1/unfavorite');

        $this->dontSeeInDatabase('user_project_favorites', ['user_id' => 1, 'project_id' => 1]);
    }
}