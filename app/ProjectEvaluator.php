<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectEvaluator extends Model
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
        'project_id',
        'evaluator_id',
        'approver'
    ];

    /**
     * Get the evaluator that owns the project.
     */
    public function evaluator() 
    {
        return $this->belongsTo('App\Evaluator', 'evaluator_id');
    }
    public function user()
    {
        return $this->belongsTo(User::Class, 'evaluator_id');
    }

    public function projects()
    {
        return $this->belongsTo(Project::class,'project_id');
    }
}
