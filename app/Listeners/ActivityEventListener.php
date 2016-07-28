<?php

namespace App\Listeners;

use App\Contracts\ActivityRepository;
use App\Events\Users\UserStartedFollowing;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivityEventListener
{
    /**
     * Instance of the activity repository.
     *
     * @var \App\Contracts\ActivityRepository
     */
    private $activities;

    /**
     * Create the event listener.
     *
     * @param \App\Contracts\ActivityRepository $activities
     */
    public function __construct(ActivityRepository $activities)
    {
        $this->activities = $activities;
    }

    /**
     * Log the user subscription activity.
     *
     * @param mixed $event
     */
    public function logUserSubscriptionActivity($event)
    {
        $title = '<strong>%s</strong> has signed up for project <strong><a href="%s">%s</a></strong>.';

        $this->activities->create($event->user, [
            'title' => sprintf($title, $event->user->name, route('projects.show', $event->project), $event->project->title)
        ]);
    }

    /**
     * Log the user favorite activity.
     *
     * @param mixed $event
     */
    public function logUserFavoritedActivity($event)
    {
        $title = '<strong>%s</strong> has favorited the project <strong><a href="%s">%s</a></strong>.';

        $this->activities->create($event->user, [
            'title' => sprintf($title, $event->user->name, route('projects.show', $event->project), $event->project->title)
        ]);
    }

    /**
     * Log the user following activity.
     *
     * @param mixed $event
     */
    public function logUserFollowingActivity($event)
    {
        $title = $event instanceof UserStartedFollowing
            ? '<strong>%s</strong> started following <strong>%s</strong>.'
            : '<strong>%s</strong> stopped following <strong>%s</strong>.';

        $user = $event->user->isCompany() ? $event->user->title : $event->user->name;
        $following = $event->following->isCompany() ? $event->following->title : $event->following->name;

        $this->activities->create($event->user, [
            'target' => $event->following->id,
            'title' => sprintf($title, $user, $following)
        ]);
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'App\Events\Projects\UserHasSubscribed',
            'App\Listeners\ActivityEventListener@logUserSubscriptionActivity'
        );

        $events->listen(
            'App\Events\Projects\UserHasFavorited',
            'App\Listeners\ActivityEventListener@logUserFavoritedActivity'
        );

        $events->listen(
            'App\Events\Users\UserStartedFollowing',
            'App\Listeners\ActivityEventListener@logUserFollowingActivity'
        );

        $events->listen(
            'App\Events\Users\UserStoppedFollowing',
            'App\Listeners\ActivityEventListener@logUserFollowingActivity'
        );
    }
}
