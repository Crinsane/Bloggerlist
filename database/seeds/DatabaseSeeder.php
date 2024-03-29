<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BranchTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProjectCategoriesTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        $this->call(UserFollowersPerformanceIndicatorsTableSeeder::class);
    }
}
