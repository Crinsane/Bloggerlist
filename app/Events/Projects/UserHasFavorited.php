<?php

namespace App\Events\Projects;

use App\User;
use App\Events\Event;
use App\Projects\Project;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasFavorited extends Event
{
    use SerializesModels;

    /**
     * The user that favorited the project.
     *
     * @var \App\User
     */
    public $user;

    /**
     * The project that the user favorited.
     *
     * @var \App\Projects\Project
     */
    public $project;

    /**
     * Create a new event instance.
     *
     * @param \App\User             $user
     * @param \App\Projects\Project $project
     */
    public function __construct(User $user, Project $project)
    {
        $this->user = $user;
        $this->project = $project;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
