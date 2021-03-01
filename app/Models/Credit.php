<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    public function customer()
    {
    	return $this->hasOne(Customer::class,'id','customer_id');
    }

     public function vehicle()
    {
    	return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
}
