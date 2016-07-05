<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
//    use SoftDeletes;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Get the job name record with user (one-to-one)
     */
    public function work()
    {
        return $this->hasOne('App\Work');
    }

    /**
     * Get tasks of user (one-to-many)
     */
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
