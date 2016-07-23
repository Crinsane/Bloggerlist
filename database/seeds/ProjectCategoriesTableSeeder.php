<?php

use App\Projects\Category;
use Illuminate\Database\Seeder;

class ProjectCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create(['name' => 'Fashion']);
        Category::create(['name' => 'Beauty']);
        Category::create(['name' => 'Health']);
        Category::create(['name' => 'Lifestyle']);
        Category::create(['name' => 'Travel']);
        Category::create(['name' => 'Family & Kids']);
        Category::create(['name' => 'Food']);
    }
}
