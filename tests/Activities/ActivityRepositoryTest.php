<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class ActivityRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_create_a_new_activity_record()
    {
        $user = factory(\App\User::class)->create();

        /** @var \App\Activities\ActivityRepository $activityRepo */
        $activityRepo = $this->app->make(\App\Activities\ActivityRepository::class);

        $activityRepo->create($user, [
            'title' => 'Activity title',
        ]);

        $this->seeInDatabase('activities', ['user_id' => 1, 'title' => 'Activity title']);
    }

    /** @test */
    public function it_will_create_a_new_activity_record_with_a_given_target()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\User::class)->create();

        /** @var \App\Activities\ActivityRepository $activityRepo */
        $activityRepo = $this->app->make(\App\Activities\ActivityRepository::class);

        $activityRepo->create($user, [
            'title' => 'Activity title',
            'target' => 2
        ]);

        $this->seeInDatabase('activities', ['user_id' => 1, 'target' => 2, 'title' => 'Activity title']);
    }
}