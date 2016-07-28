<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectStepsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_return_a_list_of_all_steps_of_a_project()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);
        factory(\App\Projects\Step::class)->times(5)->create(['project_id' => 1]);

        $this->be($user);

        $this->get('api/projects/1/steps')
             ->seeJsonStructure(['*' => ['id', 'order', 'title', 'description']]);
    }
}