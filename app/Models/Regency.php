<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    public $timestamps = false;

    public function districts()
    {
    	return $this->hasMany(District::class,'regency_code','code');
    }
}
