<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialMediaStat extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'socialmedia_stats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id'];

    /**
     * A socialmedia stats belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
