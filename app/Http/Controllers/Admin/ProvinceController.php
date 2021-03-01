<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\Regency;

class ProvinceController extends Controller
{
    public function __construct()
    {

    }

    public function regency(Request $request)
    {
    	$regencies = Province::with('regencies')->where('code',$request->id)->first();
    	return json_return_data($regencies->regencies,'success','');
    }
}
