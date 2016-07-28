<?php

namespace App\Activities;

use App\Contracts\ActivityRepository as ActivityRepositoryContract;
use App\User;

class ActivityRepository implements ActivityRepositoryContract
{
    /**
     * Log a new activity.
     *
     * @param \App\User $user
     * @param array     $data
     * @return \App\Activities\Activity
     */
    public function create(User $user, array $data)
    {
        Activity::create([
            'user_id' => $user->id,
            'target' => array_get($data, 'target'),
            'title' => $data['title'],
            'body' => array_get($data, 'body'),
            'action_text' => array_get($data, 'action_text'),
            'action_url' => array_get($data, 'action_url'),
        ]);
    }
}