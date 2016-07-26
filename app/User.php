<?php

namespace App;

use App\Projects\Project;
use Laravel\Spark\User as SparkUser;

class User extends SparkUser
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email',
        'title', 'website',
        'branch_id', 'description',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'authy_id',
        'country_code',
        'phone',
        'card_brand',
        'card_last_four',
        'card_country',
        'billing_address',
        'billing_address_line_2',
        'billing_city',
        'billing_zip',
        'billing_country',
        'extra_billing_information',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'trial_ends_at' => 'date',
        'uses_two_factor_auth' => 'boolean',
        'branch_id' => 'integer',
    ];

    /**
     * A User has many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * A user can favorite one or many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(Project::class, 'user_project_favorites');
    }

    /**
     * A user can be subscribed to many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribedProjects()
    {
        return $this->belongsToMany(Project::class, 'user_project_subscriptions')
            ->withPivot('message', 'chosen_at')
            ->withTimestamps();
    }

    /**
     * Helper method to check if a user is of the type company.
     *
     * @return bool
     */
    public function isCompany()
    {
        return $this->type == 'company';
    }

    /**
     * Subscribe for the given project and add the given message.
     *
     * @param \App\Projects\Project $project
     * @param string                $message
     * @return void
     */
    public function subscribeForProjectWithMessage(Project $project, $message)
    {
        $this->subscribedProjects()->attach($project, ['message' => $message]);
    }

    /**
     * Unsubscribe from the given project.
     *
     * @param \App\Projects\Project $project
     * @return void
     */
    public function unsubscribeFromProject(Project $project)
    {
        $this->subscribedProjects()->detach($project);
    }

    /**
     * Add a project to the users favorites.
     *
     * @param mixed $project
     * @return void
     */
    public function favorite($project)
    {
        $this->favorites()->attach($project);
    }

    /**
     * Remove the project from the users favorites.
     *
     * @param mixed $project
     * @return void
     */
    public function unfavorite($project)
    {
        $this->favorites()->detach($project);
    }
}
