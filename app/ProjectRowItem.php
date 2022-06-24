<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectRowItem extends Model
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
        'name',
        'value',
        'project_row_id'
    ];
}
