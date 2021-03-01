<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\Customer;
use App\Models\Vehicle;

use Validator;

class CreditController extends Controller
{
    public function __construct()
    {

    }

    public function add(){
    	$page = [
            'module' => 'Angsuran',
            'title' => 'Tambah'
        ];
        $credit = null;
        $customers = Customer::all();
        $vehicles = Vehicle::all();
        return view('admin.pages.credit.add',compact('page','credit','customers','vehicles'));
    }

    public function edit(Request $request){
    	$page = [
            'module' => 'Angsuran',
            'title' => 'Edit'
        ];
        $customers = Customer::all();
        $vehicles = Vehicle::all();

        $id = $request->id;
        if(empty($id)) return redirect()->back();
        $credit = Credit::findOrFail($id);
        if(empty($credit)) return redirect()->back();

        return view('admin.pages.credit.add', compact('page','credit','customers','vehicles'));
    }

    public function save(Request $request){
    	$data = $request->all();

    	$data['down_payment'] = str_replace(['.',','],'',$data['down_payment']);
    	$data['price'] = str_replace(['.',','],'',$data['price']);
        
        $validations = Validator::make($request->all(), [
            'customer_id' => 'required|numeric',
            'interest_type' => 'required|numeric',
            'interest' => 'required|numeric',
            'down_payment' => 'required',
            'tenor' => 'required|integer',
            'price' => 'required',
            'vehicle_id' => 'required|numeric'
        ]);

        if ($validations->fails()) {
            return redirect()->back()
                        ->withErrors($validations)
                        ->withInput();
        }

        if(!empty($data['id']))
        {
        	$v = Credit::findOrFail($data['id']);

            if(empty($v)) return redirect()->back();

            $v->customer_id = $data['customer_id'];
            $v->interest_type = $data['interest_type'];
            $v->interest = $data['interest'];
            $v->down_payment = $data['down_payment'];
            $v->tenor = $data['tenor'];
            $v->price = $data['price'];
            $v->vehicle_id = $data['vehicle_id'];
           if( $v->save()){
                return redirect()->route('admin.credit.list');
           }else return redirect()->back();
        }else{
        	// Tambah Data baru
            unset($data['id']);
            unset($data['_token']);
            $data['status'] = config('master.credit_status.idle.id');
            Credit::insert($data);
            return redirect()->route('admin.credit.list');
        }
    }

    public function list(){
    	$page = [
    		'module' => 'Angsuran',
    		'title' => 'Daftar'
    	];

    	$credits = Credit::with('customer')->get();
    	return view('admin.pages.credit.list',compact('page','credits'));
    }

    public function delete(Request $request){
    	$data = $request->all();
        if(!empty($data['ids'])){
            foreach ($data['ids'] as $key => $value) {
                Credit::findOrFail($value)->delete();
            }

            return json_return_data(null,null,'Data angsuran berhasil dihapus');
        }else{
            return json_return_data(null,null,'Pilih data yang dihapus', 500);
        }
    }

}
