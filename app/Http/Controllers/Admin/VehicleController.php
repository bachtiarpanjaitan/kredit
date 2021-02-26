<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Validator;

class VehicleController extends Controller
{
 	public function __construct()
    {

    }

    public function add(){

        $page = [
            'module' => 'Kendaraan',
            'title' => 'Tambah'
        ];
        $vehicle = null;

        return view('admin.pages.vehicle.add',compact('page','vehicle'));
    }

    public function edit(Request $request){
        $page = [
            'module' => 'Kendaraan',
            'title' => 'Edit'
        ];

        $id = $request->id;
        if(empty($id)) return redirect()->back();
        $vehicle = Vehicle::findOrFail($id);
        if(empty($vehicle)) return redirect()->back();

        return view('admin.pages.vehicle.add', compact('page','vehicle'));
    }

    public function save(Request $request){
        // dd($request->all());
        
        $data = $request->all();
        
        $validations = Validator::make($request->all(), [
            'type_id' => 'required|numeric',
            'brand_id' => 'required|numeric',
            'code' => 'required',
            'name' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'color' => 'required',
            'cylinder' => 'required|integer',
        ]);

        if ($validations->fails()) {
            return redirect()->back()
                        ->withErrors($validations)
                        ->withInput();
        }

        if(!empty($data['id']))
        {
            // Edit Data
            $v = Vehicle::findOrFail($data['id']);

            if(empty($v)) return redirect()->back();

            $v->type_id = $data['type_id'];
            $v->brand_id = $data['brand_id'];
            $v->code = $data['code'];
            $v->name = $data['name'];
            $v->model = $data['model'];
            $v->year = $data['year'];
            $v->color = $data['color'];
            $v->cylinder = $data['cylinder'];

           if( $v->save()){
                return redirect()->route('admin.vehicle.list');
           }else return redirect()->back();



        }else{
            // Tambah Data baru
            unset($data['id']);
            unset($data['_token']);
            Vehicle::insert($data);
            return redirect()->route('admin.vehicle.list');
        }
    }

    public function list(){

    	$page = [
    		'module' => 'Kendaraan',
    		'title' => 'Daftar'
    	];

    	$vehicles = Vehicle::all();

    	return view('admin.pages.vehicle.list',compact('page','vehicles'));
    }

    public function delete(Request $request){
        $data = $request->all();
        if(!empty($data['ids'])){
            foreach ($data['ids'] as $key => $value) {
                Vehicle::findOrFail($value)->delete();
            }

            return json_return_data(null,null,'Data kendaraan berhasil dihapus');
        }else{
            return json_return_data(null,null,'Pilih data yang dihapus', 500);
        }
    }
}
