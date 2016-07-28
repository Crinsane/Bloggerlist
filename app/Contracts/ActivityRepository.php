<?php

namespace App\Contracts;

use App\User;

interface ActivityRepository
{
    /**
     * Log a new activity.
     *
     * @param \App\User $user
     * @param array     $data
     * @return \App\Activities\Activity
     */
    public function create(User $user, array $data);
}