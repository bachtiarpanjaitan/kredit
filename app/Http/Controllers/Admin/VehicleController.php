<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
 	public function __construct()
    {

    }

    public function list(){

    	$page = [
    		'module' => 'Kendaraan',
    		'title' => 'Daftar'
    	];

    	$vehicles = Vehicle::all();

    	return view('admin.pages.vehicle.list',compact('page','vehicles'));
    }
}
