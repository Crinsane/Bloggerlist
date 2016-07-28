<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateSubscriptionNotificationTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_create_a_subscription_notification_for_a_company()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\User::class)->create();
        factory(App\Projects\Category::class)->create();
        $project = factory(\App\Projects\Project::class)->create(['user_id' => 2, 'category_id' => 1, 'title' => 'Project title']);

        $notifications = $this->app->make(\Laravel\Spark\Contracts\Repositories\NotificationRepository::class);

        $listener = new \App\Listeners\Projects\CreateSubscriptionNotification($notifications);

        $listener->handle(new \App\Events\Projects\UserHasSubscribed($user, $project));

        $this->seeInDatabase('notifications', [
            'user_id' => 2,
            'icon' => 'fa-user',
            'body' => "A new blogger has signed up for your project 'Project title'",
            'action_text' => 'Go to project',
            'action_url' => 'http://thebloggerlist.dev/projects/1',
        ]);
    }
}