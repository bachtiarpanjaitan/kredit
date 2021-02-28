<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
   	public function __construct()
    {

    }

    public function village(Request $request)
    {
    	$villages = District::with('villages')->where('code',$request->id)->first();
    	return json_return_data($villages->villages,'success','');
    }
}
