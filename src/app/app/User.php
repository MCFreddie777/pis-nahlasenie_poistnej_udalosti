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

    public function contracts() {
        return $this->hasMany('App\Contract');
    }

    /**
     * @var mixed
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function getNameAttribute()
    {
        if ($this->first_name && $this->last_name)
            return $this->first_name . " " . $this->last_name;
        else return null;
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
