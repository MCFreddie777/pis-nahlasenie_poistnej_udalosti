<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceEvent extends Model
{
    protected $guarded = [];
    protected $table = 'events';
    public $timestamps = false;

    public function getEmployeeAttribute()
    {
        return User::where('id',$this->employee_id)->first();
    }
}
