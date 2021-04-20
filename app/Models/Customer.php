<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Customer extends Model
{

    protected $fillable = [
        'code',
        'first_name', 
        'last_name',
        'gender',
        'no_kk',
        'no_ktp',
        'address',
        'village_id',
        'district_id',
        'regency_id',
        'province_id',
        'email',
        'birth_place',
        'birth_date',
        'profession',
        'user_id',
        'npwp',
        'bank_id',
        'rekening',
        'slip_gaji'
    ];

    public function user()
    {
    	return $this->hasOne(User::class,'id','user_id');
    }

    public $timestamps = false;
}
