<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeywordItem extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'keyword_id',
        'name',
        'value'
    ];
}
