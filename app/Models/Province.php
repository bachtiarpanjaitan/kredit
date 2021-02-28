<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public $timestamps = false;

    public function regencies()
    {
    	return $this->hasMany(Regency::class,'province_code','code');
    }
}
