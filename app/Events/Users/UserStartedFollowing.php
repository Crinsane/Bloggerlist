<?php

namespace App\Events\Users;

use App\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class UserStartedFollowing extends Event
{
    use SerializesModels;

    /**
     * The user that started following.
     *
     * @var \App\User
     */
    public $user;

    /**
     * The user that will now be followed.
     *
     * @var \App\User
     */
    public $following;

    /**
     * Create a new event instance.
     *
     * @param \App\User $user
     * @param \App\User $following
     */
    public function __construct(User $user, User $following)
    {
        $this->user = $user;
        $this->following = $following;
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
