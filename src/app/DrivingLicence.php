<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
{
    public $timestamps = false;

    public function groups()
    {
        return $this->belongsToMany('App\DrivingLicenceGroup', 'group_licence', 'licence_id', 'group_id');
    }
}
