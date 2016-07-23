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
     * A projects belongs to a category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
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
     * Register the conversions that should be performed.
     *
     * @return array
     */
    public function registerMediaConversions()
    {
        $this->addMediaConversion('thumbnail')
            ->setManipulations(['w' => 120, 'h' => 120, 'fit' => 'crop'])
            ->performOnCollections('images');
    }
}
