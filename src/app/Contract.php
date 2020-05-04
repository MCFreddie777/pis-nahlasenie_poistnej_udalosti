<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function events()
    {
        return $this->hasMany('App\InsuranceEvent');
    }
}
