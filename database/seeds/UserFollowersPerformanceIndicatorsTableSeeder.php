<?php

use Illuminate\Database\Seeder;

class UserFollowersPerformanceIndicatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 0;
        $diff = 2;

        foreach (range(1, 24) as $i) {
            $count = $count + $diff;

            app('db')->table('user_followers_performance_indicators')->insert([
                'user_id' => 1,
                'follower_count' => $count,
                'difference' => $diff,
                'created_at' => \Carbon\Carbon::today()->subDays(24 - $i),
                'updated_at' => \Carbon\Carbon::today()->subDays(24 - $i),
            ]);

            $diff = mt_rand(-3, 8);
        }

        $count = 0;
        $diff = 2;

        foreach (range(1, 24) as $i) {
            $count = $count + $diff;

            app('db')->table('user_followers_performance_indicators')->insert([
                'user_id' => 2,
                'follower_count' => $count,
                'difference' => $diff,
                'created_at' => \Carbon\Carbon::today()->subDays(24 - $i),
                'updated_at' => \Carbon\Carbon::today()->subDays(24 - $i),
            ]);

            $diff = mt_rand(-4, 10);
        }
    }
}
