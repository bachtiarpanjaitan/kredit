<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;
use Validator;
use App\User;
use App\Models\Bank;

class CustomerController extends Controller
{
    public function __construct()
    {

    }

    public function add(){
    	 $page = [
            'module' => 'Pelanggan',
            'title' => 'Tambah'
        ];
        $customer = null;
        $provinces = null;
        $regencies = null;
        $districts = null;
        $villages = null;
        $banks = Bank::all();
        $provinces = Province::all();

        return view('admin.pages.customer.add',compact('banks','page','provinces','customer','regencies','districts','villages'));
    }

    public function edit(Request $request){
        $page = [
            'module' => 'Pelanggan',
            'title' => 'Edit'
        ];

        $id = $request->id;
        if(empty($id)) return redirect()->back();
        $customer = Customer::findOrFail($id);

        $provinces = Province::all();

        // dd($provinces);


        $regencies = Regency::where('province_code',$customer->province_id)->get();
        $districts = District::where('regency_code',$customer->regency_id)->get();
        $villages = Village::where('district_code', $customer->district_id)->get();
        $banks = Bank::all();

        // dd($regencies);

        // dd($customer);
        if(empty($customer)) return redirect()->back();

        return view('admin.pages.customer.add', compact('banks','page','provinces','customer','regencies','districts','villages'));
    }

    public function save(Request $request){
        $data = $request->all();
        
        $validations = Validator::make($request->all(), [
            'code' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'gender' => 'required|integer',
            'no_kk' => 'required',
            'no_ktp' => 'required',
            'address' => 'required',
            'village_id' => 'required|integer',
            'district_id' => 'required|integer',
            'regency_id' => 'required|integer',
            'province_id' => 'required|integer',
            'email' => 'required|email',
            'birth_date' => 'required|date',
            'birth_place' => 'required',
            'npwp' => 'required',
            'bank_id' => 'required',
            'slip_gaji' => 'required'
        ]);

        if ($validations->fails()) {
            return redirect()->back()
                        ->withErrors($validations)
                        ->withInput();
        }

        $image = $request->file('slip_gaji');
        $file_name = $image->getClientOriginalName();
        $image->storeAs('public/img/slip',$file_name);

        if(!empty($data['id']))
        {
            // Edit Data
            $v = Customer::findOrFail($data['id']);

            if(empty($v)) return redirect()->back();

            $v->code = $data['code'];
            $v->first_name = $data['first_name'];
            $v->last_name = $data['last_name'];
            $v->gender = $data['gender'];
            $v->no_kk = $data['no_kk'];
            $v->no_ktp = $data['no_ktp'];
            $v->address = $data['address'];
            $v->village_id = $data['village_id'];
            $v->district_id = $data['district_id'];
            $v->regency_id = $data['regency_id'];
            $v->province_id = $data['province_id'];
            $v->email = $data['email'];
            $v->birth_place = $data['birth_place'];
            $v->birth_date = $data['birth_date'];
            $v->profession = $data['profession'];
            $v->npwp = $data['npwp'];
            $v->bank_id = $data['bank_id'];
            $v->rekening = $data['rekening'];
            $v->slip_gaji = $file_name;

            $user = User::find($v->user_id);
            if(empty($user)) return redirect()->back();

            $user->email = $v->email;
            $user->name = $v->first_name .' '.$v->last_name;

           if($v->save() && $user->save()){
                return redirect()->route('admin.customer.list');
           }else {
                return redirect()->back();
           }

        }else{

            $user = new User();
            $user->name = $data['first_name'].' '.$data['last_name'];
            $user->email = $data['email'];
            $user->password = bcrypt(strtolower($data['first_name'].'1234'));
            $user->save();

            // Tambah Data baru
            unset($data['id']);
            unset($data['_token']);
            $data['user_id'] = $user->id;
            Customer::insert($data);
            return redirect()->route('admin.customer.list');
        }
    }

    public function list(){
    	$page = [
    		'module' => 'Pelanggan',
    		'title' => 'Daftar'
    	];

    	$customers = Customer::with('user')->has('user')->get();

    	return view('admin.pages.customer.list',compact('page','customers'));
    }

    public function delete(Request $request){
        $data = $request->all();
        if(!empty($data['ids'])){
            foreach ($data['ids'] as $key => $value) {
                Customer::findOrFail($value)->delete();
            }

            return json_return_data(null,null,'Data pelanggan berhasil dihapus');
        }else{
            return json_return_data(null,null,'Pilih data yang dihapus', 500);
        }
    }

}
