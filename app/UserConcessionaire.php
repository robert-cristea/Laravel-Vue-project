<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserConcessionaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_concessionaire';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'person_in_charge'
    ];

}
