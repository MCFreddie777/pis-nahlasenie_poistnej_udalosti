<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $timestamps = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * @var mixed
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function contracts()
    {
        return $this->hasMany('App\Contract');
    }

    public function getNameAttribute()
    {
        return $this->first_name . " " . $this->last_name;
    }

    /**
     * Checks if user has role in the parameter
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return $this->role->name === $role;
    }
}
