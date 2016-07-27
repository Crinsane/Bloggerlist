<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProjectsControllerTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /** @test */
    public function it_will_return_a_list_of_all_projects_for_the_authenticated_user()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->times(5)->create(['user_id' => 1, 'category_id' => 1]);

        $this->be($user);

        $this->get('/api/projects')
             ->seeJsonStructure(['*' => ['title', 'description', 'category_id', 'reward', 'location', 'category' => ['id', 'slug', 'name']]]);
    }
}