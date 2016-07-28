<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class BranchTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_automatically_generate_a_slug()
    {
        $branch = \App\Branch::create(['name' => 'Branch name']);

        $this->assertEquals('branch-name', $branch->slug);
    }

    /** @test */
    public function it_will_generate_a_unique_slug_when_the_name_already_exists_on_another_branch_instance()
    {
        \App\Branch::create(['name' => 'Branch name']);
        $branch = \App\Branch::create(['name' => 'Branch name']);

        $this->assertEquals('branch-name-2', $branch->slug);
    }
}