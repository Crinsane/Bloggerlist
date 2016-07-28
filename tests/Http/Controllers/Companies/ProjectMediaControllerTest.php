<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProjectMediaControllerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_return_a_list_of_all_project_images()
    {
        $user = factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        factory(\App\Projects\Project::class)->create(['user_id' => 1, 'category_id' => 1]);

        $this->app->make('db')->table('media')->insert([
            'model_id' => 1,
            'model_type' => 'App\Projects\Project',
            'collection_name' => 'images',
            'name' => 'Photo',
            'file_name' => 'Photo.jpg',
            'disk' => 'media',
            'size' => 100000,
            'manipulations' => '[]',
            'custom_properties' => '[]',
            'order_column' => 1,
        ]);

        $this->be($user);

        $this->get('/company/projects/1/media')
             ->assertResponseOk()
             ->seeJsonStructure(['*' => [
                 'id', 'model_id', 'model_type', 'collection_name', 'name', 'file_name', 'disk', 'size', 'manipulations', 'custom_properties', 'order_column',
             ]]);
    }
}