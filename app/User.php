<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN = 'admin';
    const CONCESSIONAIRE = 'concessionaire';
    const AUDITOR = 'auditor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id', 'google_id', 'github_id', 'phone', 'fax', 'reg_no', 'website', 'address', 'role', 'department','ad_username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the roles record associated with the user.
     */
    public function roles() 
    {
        return $this->hasOne('\App\UserRole', 'user_id', 'id');
    }
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function isAdmin()
    {
        return ($this->role == self::ADMIN);
    }


    public function isAdminRole() 
    {
        return $this->roles->role->name == self::ADMIN;
    }

    public function isConcessionaire() 
    {
        return $this->roles->role->name == self::CONCESSIONAIRE;
    }

    public function isApprover() 
    {
        // todo check if approver = auditor
        return $this->role == 'approver';
    }

    public function isAuditor() 
    {
        return $this->roles->role->name == self::AUDITOR;
    }

    public static function login($request)
    {
        $remember = $request->remember;
        $email = $request->email;
        $password = $request->password;
        
        return (\Auth::attempt(['email' => $email, 'password' => $password], $remember));
    }

    /**
     * Get the user concessionaire record associated with the user.
     */
    public function user_concessionaire()
    {
        return $this->hasOne('App\UserConcessionaire', 'user_id', 'id');
    }

    /**
     * Get the user auditor record associated with the user.
     */
    public function user_auditor()
    {
        return $this->hasOne('App\UserAuditor', 'user_id', 'id');
    }

    public function evaluators()
    {
        return $this->hasMany(ProjectEvaluator::class,'evaluator_id');
    }
}
