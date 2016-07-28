<?php

use App\Branch;
use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branch::create(['name' => 'Fashion']);
        Branch::create(['name' => 'Beauty']);
        Branch::create(['name' => 'Health']);
        Branch::create(['name' => 'Lifestyle']);
        Branch::create(['name' => 'Travel']);
        Branch::create(['name' => 'Family & Kids']);
        Branch::create(['name' => 'Food']);
        Branch::create(['name' => 'Other']);
    }
}
