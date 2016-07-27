<?php

namespace App\Projects;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMediaConversions;

class Project extends Model implements HasMediaConversions
{
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'category_id', 'reward', 'location'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];

    /**
     * A project belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A project has many steps.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function steps()
    {
        return $this->hasMany(Step::class);
    }

    /**
     * A project belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A project has one or more subscribers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'user_project_subscriptions')
            ->withPivot(['message', 'chosen_at'])
            ->withTimestamps();
    }

    /**
     * A project can favorited one or many users.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favorites()
    {
        return $this->belongsToMany(User::class, 'user_project_favorites');
    }

    /**
     * Create a new project for the given user with the given attributes.
     *
     * @param \App\User $user
     * @param array     $attributes
     * @return \App\Projects\Project
     */
    public static function createProjectForUser(User $user, $attributes)
    {
        return $user->projects()->create($attributes);
    }

    /**
     * Scope the query to only include projects for the given user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\User                             $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id);
    }

    /**
     * Check if a project is owned by a user.
     *
     * @param \App\User $user
     * @return bool
     */
    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * Add an image to the images collection.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return \Spatie\MediaLibrary\Media
     */
    public function addImage(UploadedFile $file)
    {
        return $this->addMedia($file)->toCollection('images');
    }

    /**
     * Add a step to the collection of steps.
     *
     * @param array $step
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addStep($step)
    {
        $order = $this->steps()->count() + 1;

        return $this->steps()->create([
            'order' => $order,
            'title' => $step['title'],
            'description' => $step['description'],
        ]);
    }

    /**
     * Add images to the images media collection.
     *
     * @param array $files
     */
    public function addImages($files)
    {
        foreach ($files as $file) {
            $this->addImage($file);
        }
    }

    /**
     * Add steps to the project steps collection.
     *
     * @param array $steps
     */
    public function addSteps($steps)
    {
        foreach ($steps as $step) {
            $this->addStep($step);
        }
    }

    /**
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumbnail')
            ->setManipulations(['w' => 120, 'h' => 120, 'fit' => 'crop'])
            ->performOnCollections('images');

        $this->addMediaConversion('big')
            ->setManipulations(['w' => 1140, 'h' => 500, 'fit' => 'crop'])
            ->performOnCollections('images');
    }
}
