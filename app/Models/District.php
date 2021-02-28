<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false;

    public function villages()
    {
    	return $this->hasMany(Village::class,'district_code','code');
    }
}
