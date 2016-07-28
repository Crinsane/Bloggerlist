<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_automatically_generate_a_slug()
    {
        $category = \App\Projects\Category::create(['name' => 'Category name']);

        $this->assertEquals('category-name', $category->slug);
    }

    /** @test */
    public function it_will_generate_a_unique_slug_when_the_name_already_exists_on_another_category_instance()
    {
        \App\Projects\Category::create(['name' => 'Category name']);
        $category = \App\Projects\Category::create(['name' => 'Category name']);

        $this->assertEquals('category-name-2', $category->slug);
    }
}