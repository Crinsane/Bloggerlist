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
        $project = factory(\App\Projects\Project::class)->create(['user_id' => $user->id, 'category_id' => 1]);

        $this->be($user);

        $this->post('/projects/' . $project->id . '/favorite');

        $this->seeInDatabase('user_project_favorites', ['user_id' => $user->id, 'project_id' => $project->id]);
    }

    /** @test */
    public function it_will_remove_a_project_from_a_users_favorites()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        $project = factory(\App\Projects\Project::class)->create(['user_id' => $user->id, 'category_id' => 1]);

        $this->app->make('db')->table('user_project_favorites')->insert(['user_id' => $user->id, 'project_id' => $project->id]);

        $this->be($user);

        $this->delete('/projects/' . $project->id . '/unfavorite');

        $this->dontSeeInDatabase('user_project_favorites', ['user_id' => $user->id, 'project_id' => $project->id]);
    }
}