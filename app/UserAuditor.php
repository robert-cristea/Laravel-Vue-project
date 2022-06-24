<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAuditor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_auditors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status'
    ];
}
