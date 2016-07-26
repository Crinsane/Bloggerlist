<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Projects\Project::class)->times(20)->create(['user_id' => 1])->each(function (App\Projects\Project $project) {
            foreach(range(1, mt_rand(1, 5)) as $i) {
                factory(\App\Projects\Step::class)->create(['project_id' => $project->id, 'order' => $i]);
            }
        });
    }
}
