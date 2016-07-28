<?php

namespace App\Activities;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Activity extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'target', 'title', 'body', 'action_text', 'action_url'];

    /**
     * An activity was performed by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * An activity can belong to a target user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function target()
    {
        return $this->belongsTo(User::class, 'target');
    }

    /**
     * Scope the query to only include activity from the given user.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \App\User                             $user
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeForUser(Builder $query, User $user)
    {
        return $query->where('user_id', $user->id)->orWhere('target', $user->id);
    }
}
