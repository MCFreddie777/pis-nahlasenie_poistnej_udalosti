<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceEvent extends Model
{
    protected $table = 'events';

    public $timestamps = false;
    protected $guarded = [];
    protected $hidden = ['driverA_id', 'driverB_id'];
    protected $appends = ['drivers'];

    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }

    public function getDriversAttribute()
    {
        $driverA = Driver::with(['licence'])->whereId($this->driverA_id)->get();
        $driverB = Driver::with(['licence'])->whereId($this->driverB_id)->get();
        return $driverA->merge($driverB);
    }

    public function getEmployeeAttribute()
    {
        return User::where('id', $this->employee_id)->first();
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['note'] = $value;
    }
}
