<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmissionFactor extends Model
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
        'category',
        'subcategory',
        'factor',
        'unit',
        'sources',
        'type',
        'project_id'
    ];

    public static $keysToBeFilledByUser = [
        'category',
        'subcategory',
        'factor',
        'unit',
        'sources'
    ];
}
