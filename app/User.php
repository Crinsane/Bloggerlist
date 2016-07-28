<?php

namespace App;

use App\Projects\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Spark\User as SparkUser;

class User extends SparkUser
{
    use SoftDeletes;

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
     * A user has many projects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    /**
     * A user belongs to a branch.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * A user has one social media record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function socialMedia()
    {
        return $this->hasOne(SocialMedia::class);
    }

    /**
     * A user has many social media stats.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function socialMediaStats()
    {
        return $this->hasMany(SocialMediaStat::class);
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
     * A user can follow many other users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'user_id', 'follows');
    }

    /**
     * A user can be followed by many other users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follows', 'follows', 'user_id');
    }

    /**
     * Scope the query to only include user of the type company.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompanies(Builder $query)
    {
        return $query->where('type', 'company');
    }

    /**
     * Scope the query to only include user of the type blogger.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBloggers(Builder $query)
    {
        return $query->where('type', 'blogger');
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
     * Helper method to check if a user is of the type blogger.
     *
     * @return bool
     */
    public function isBlogger()
    {
        return $this->type == 'blogger';
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
     * @param \App\Projects\Project $project
     * @return void
     */
    public function favorite(Project $project)
    {
        $this->favorites()->attach($project);
    }

    /**
     * Remove the project from the users favorites.
     *
     * @param \App\Projects\Project $project
     * @return void
     */
    public function unfavorite(Project $project)
    {
        $this->favorites()->detach($project);
    }

    /**
     * Add a user to the list of followers.
     *
     * @param \App\User $user
     * @return void
     */
    public function follow(User $user)
    {
        $this->follows()->attach($user);
    }

    /**
     * Remove a user from the list of followers.
     *
     * @param \App\User $user
     * @return void
     */
    public function unfollow(User $user)
    {
        $this->follows()->detach($user);
    }
}
