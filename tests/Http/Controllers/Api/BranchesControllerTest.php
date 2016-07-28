<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class BranchesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_return_a_list_of_branches()
    {
        $user = factory(\App\User::class)->create();

        factory(\App\Branch::class)->times(5)->create();

        $this->be($user);

        $this->get('/api/branches')
             ->seeJsonStructure(['*' => ['id', 'slug', 'name']]);
    }
}