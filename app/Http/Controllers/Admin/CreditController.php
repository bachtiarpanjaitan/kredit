<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\CreditDetail as CD;
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
                //Detail
                $details = CD::where('credit_id', $v->id)->get();
                foreach ($details as $key => $value) {
                    
                }

                return redirect()->route('admin.credit.list');
           }else return redirect()->back();
        }else{
        	// Tambah Data baru
            unset($data['id']);
            unset($data['_token']);
            $data['status'] = config('master.credit_status.idle.id');
            $credit = new Credit();
            $credit->customer_id = $data['customer_id'];
            $credit->interest_type = $data['interest_type'];
            $credit->interest = $data['interest'];
            $credit->down_payment = $data['down_payment'];
            $credit->tenor = $data['tenor'];
            $credit->price = $data['price'];
            $credit->vehicle_id = $data['vehicle_id'];
            $credit->status = $data['status'];
            $credit->save();
            // dd($credit,$data);
            $details = [];
            $saldo_akhir = $credit->price;

            for ($i= 1; $i <= (int) $credit->tenor ; $i++) {
                $sisa = $credit->price - $credit->down_payment;
                $pokok = $sisa / $credit->tenor;

                if($credit->interest_type == config('master.interest_type.sliding_rate.id')){

                    $bunga = ($saldo_akhir * ($credit->interest/100) / $credit->tenor);
                    $saldo_akhir -= $pokok;

                }else{
                    $bunga = ($sisa * ($credit->interest/100) / $credit->tenor);
                }

                $total_angsuran = $pokok + $bunga; 

                $detail = [
                    'credit_id' => $credit->id,
                    'installment' => $i,
                    'installment_value' => ceil($total_angsuran),
                    'status' => config('master.installment_status.open.id'),
                ];

                array_push($details, $detail);
            }

            CD::insert($details);

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

    public function detail(Request $request)
    {
        $credit = Credit::with('details')->where('id',$request->id)->first();
        $page = [
            'module' => 'Angsuran',
            'title' => 'Detail'
        ];

        $sub_total = $credit->details->sum('installment_value');

        $credit->total = $credit->down_payment + $sub_total;

        // dd($sub_total);

        if(empty($credit)) return redirect()->back();

        return view('admin.pages.credit.detail',compact('credit','page'));
    }

    public function paid(Request $request)
    {
        $credit_id = $request->credit_id;
        $id = $request->id;

        if(empty($credit_id) || empty($id)) return json_return_data(null,null,'Data tidak lengkap',500);

        $detail = CD::findOrFail($id);

        if($detail){
            $credit = Credit::findOrFail($detail->credit_id);
            if(!empty($credit)){
                $tenor = $credit->tenor;
                if(CD::where('credit_id',$credit->id)->where('status',config('master.credit_status.open.id'))->count() >= 0){
                    $credit->status = config('master.credit_status.running.id');
                    
                }elseif(CD::where('credit_id',$credit->id)->where('status',config('master.credit_status.running.id'))->count() >= $tenor ){
                    $credit->status = config('master.credit_status.done.id');
                }
                $credit->save();
            }
            
        }

        if(empty($detail)) return json_return_data(null,null,'Data tidak tersedia',500);

        $detail->status = config('master.installment_status.close.id');
        $detail->paid_date = date('Y-m-d');
        if($detail->save()){
            return json_return_data(null,null,'Data Berhasil di ubah');
        }
        
    }

}
