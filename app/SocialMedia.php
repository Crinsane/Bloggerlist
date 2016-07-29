<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'socialmedia';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'facebook_id', 'facebook_name', 'facebook_token', 'facebook_token_expires_at',
        'twitter_id', 'twitter_name', 'twitter_token', 'twitter_token_expires_at',
        'instagram_id', 'instagram_name', 'instagram_token', 'instagram_token_expires_at',
        'youtube_id', 'youtube_name', 'youtube_token', 'youtube_token_expires_at',
        'analytics_id',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'facebook_token_expires_at', 'twitter_token_expires_at', 'instagram_token_expires_at', 'youtube_token_expires_at'
    ];

    /**
     * Social media records belong to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if the token for the given platform should be updated.
     *
     * @param string $platform
     * @return bool
     */
    public function tokenShouldBeUpdated($platform)
    {
        $column = "{$platform}_token_expires_at";

        if (is_null($this->{$column})) return false;

        return abs($this->{$column}->diffInDays(Carbon::now())) < 5;
    }

    /**
     * Update the token for the given platform.
     *
     * @param string $platform
     * @param string $token
     * @param mixed  $expiresAt
     */
    public function updateToken($platform, $token, $expiresAt)
    {
        $this->update([
            "{$platform}_token" => $token,
            "{$platform}_token_expires_at" => $expiresAt,
        ]);
    }
}