<?php

namespace App\Performance;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;

class UserFollowersPerformance
{
    /**
     * Instance of the database manager.
     *
     * @var \Illuminate\Database\DatabaseManager
     */
    private $db;

    /**
     * UserFollowersPerformance constructor.
     *
     * @param \Illuminate\Database\DatabaseManager $db
     */
    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param \App\User $user
     * @return array
     */
    public function getFollowerCountForUser(User $user)
    {
        $end = Carbon::yesterday();
        $start = $end->copy()->subDays(21);

        return $this->db->table('user_followers_performance_indicators')->where('user_id', $user->id)
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at')
            ->lists('follower_count', 'created_at');
    }

    /**
     * @param \App\User $user
     * @return int
     */
    public function getNewFollowerCountForLastWeek(User $user)
    {
        $followerCountLastWeek = $this->db->table('user_followers_performance_indicators')
            ->where('user_id', $user->id)
            ->where('created_at', Carbon::today()->subWeek()->subDay())
            ->value('follower_count');

        $followerCountNow = $this->db->table('user_followers_performance_indicators')
            ->where('user_id', $user->id)
            ->where('created_at', Carbon::today()->subDay())
            ->value('follower_count');

        return $followerCountNow - $followerCountLastWeek;
    }
}