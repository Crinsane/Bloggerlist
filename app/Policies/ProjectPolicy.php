<?php

namespace App\Policies;

use App\Projects\Project;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Laravel\Spark\Spark;

class ProjectPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param \App\User $user
     * @param           $ability
     * @return bool
     */
    public function before(User $user, $ability)
    {
        if (Spark::developer($user->email)) {
            return true;
        }
    }

    /**
     * Determine if the user can store a project.
     *
     * @param \App\User             $user
     * @return bool
     */
    public function store(User $user)
    {
        return $user->type == 'company';
    }

    /**
     * Determine if a given project can be edited by the user.
     *
     * @param \App\User             $user
     * @param \App\Projects\Project $project
     * @return bool
     */
//    public function edit(User $user, Project $project)
//    {
//        return $user->id === $project->user_id;
//    }

    /**
     * Determine if a given project can be updated by the user.
     *
     * @param \App\User             $user
     * @param \App\Projects\Project $project
     * @return bool
     */
    public function update(User $user, Project $project)
    {
        return $user->id === $project->user_id;
    }
}
