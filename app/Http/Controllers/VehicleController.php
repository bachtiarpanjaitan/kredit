<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
 	public function __construct()
    {
    	 $this->middleware('auth');
    }

    public function list(){

    	$vehicles = Vehicle::orderBy('name', 'asc')->get();
    	return view('auth.pages.vehicle.list',compact('vehicles'));
    }
}