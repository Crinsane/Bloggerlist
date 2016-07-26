<?php

namespace App\Projects;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'project_steps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['order', 'title', 'description'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['project_id', 'created_at', 'updated_at'];

    /**
     * A project step belongs to a project.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
