<?php

namespace App\Events\Projects;

use App\User;
use App\Events\Event;
use App\Projects\Project;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserHasSubscribed extends Event
{
    use SerializesModels;

    /**
     * The user that subscribed.
     *
     * @var \App\User
     */
    public $user;

    /**
     * The project that the user subscribed to.
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
