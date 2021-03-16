<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class GuestController extends Controller
{
    
    public function product()
    {
    	$vehicles = Vehicle::orderBy('name', 'asc')->get();
    	return view('product',compact('vehicles'));
    }

    public function product_detail(Request $request)
    {
    	if(empty($request->id)) return redirect()->back();
    	$vehicle = Vehicle::find($request->id);
    	return view('product_detail', compact('vehicle'));
    }
}
