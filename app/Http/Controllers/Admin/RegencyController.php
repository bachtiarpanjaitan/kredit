<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Regency;

class RegencyController extends Controller
{
    public function __construct()
    {

    }

    public function district(Request $request)
    {
    	$districts = Regency::with('districts')->where('code',$request->id)->first();
    	// dd($districts);
    	return json_return_data($districts->districts,'success','');
    }
}
