<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrivingLicence extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function groups()
    {
        return $this->belongsToMany('App\DrivingLicenceGroup', 'group_licence', 'licence_id', 'group_id');
    }

    public function getGroupNamesAttribute()
    {
        return $this->groups()->get()->map(function($group) { return $group->name; })->toArray();
    }
}
