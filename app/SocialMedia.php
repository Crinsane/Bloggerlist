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
}