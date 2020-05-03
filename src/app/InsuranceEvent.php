<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceEvent extends Model
{
    protected $table = 'events';

    public $timestamps = false;

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function getDriversAttribute()
    {
        $driverA = Driver::whereId($this->driverA_id)->get();
        $driverB = Driver::whereId($this->driverB_id)->get();
        return $driverA->merge($driverB);
    }

    public function getEmployeeAttribute()
    {
        return User::where('id',$this->employee_id)->first();
    }
}
