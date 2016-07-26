<?php

namespace App\Listeners\Projects;

use Illuminate\Queue\InteractsWithQueue;
use App\Events\Projects\UserHasSubscribed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Spark\Contracts\Repositories\NotificationRepository;

class CreateSubscriptionNotification
{
    /**
     * Instance of the notifications repository.
     *
     * @var \Laravel\Spark\Contracts\Repositories\NotificationRepository
     */
    private $notifications;

    /**
     * Create the event listener.
     *
     * @param \Laravel\Spark\Contracts\Repositories\NotificationRepository $notifications
     */
    public function __construct(NotificationRepository $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Handle the event.
     *
     * @param  UserHasSubscribed  $event
     * @return void
     */
    public function handle(UserHasSubscribed $event)
    {
        $this->notifications->create($event->project->user, [
            'icon' => 'fa-user',
            'body' => "A new blogger has signed up for your project '{$event->project->title}'",
            'action_text' => 'Go to project',
            'action_url' => route('projects.show', $event->project),
        ]);
    }
}
