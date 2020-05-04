<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public $timestamps = false;

    public function events()
    {
        return $this->hasMany('App\InsuranceEvent');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
}
