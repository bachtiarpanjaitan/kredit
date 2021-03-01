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

    public  static function  boot()
    {
    	parent::boot();
    	static::deleting(function($credit){
    		$credit->details()->delete();
    	});

    }

    public function details(){
    	return $this->hasMany(CreditDetail::class,'credit_id')->orderBy('installment','asc');
    }
}
