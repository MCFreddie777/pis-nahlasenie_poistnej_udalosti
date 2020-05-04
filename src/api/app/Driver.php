<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public $timestamps = false;
    protected $guarded = ['phone'];

    public function licence()
    {
        return $this->belongsTo('App\DrivingLicence', 'licence_id');
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['tel'] = $value;
    }
}
