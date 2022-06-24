<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRow extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'public_id',
        'path',
        'project_id'
    ];

    /**
     * Get the project row items for the project row.
     */
    public function project_row_items() 
    {
        return $this->hasMany('App\ProjectRowItem');
    }
}
