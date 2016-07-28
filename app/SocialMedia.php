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
     * Update the Facebook token.
     *
     * @param string $token
     */
    public function updateFacebookToken($token)
    {
        $this->update([
            'facebook_token' => $token,
            'facebook_token_expires_at' => Carbon::now()
        ]);
    }
}