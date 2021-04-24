<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\CreditDetail as CD;

class ReportController extends Controller
{
    public function __construct()
    {

    }

    public function list(){
    	$page = [
    		'module' => 'Laporan',
    		'title' => 'Daftar'
    	];

    	return view('admin.pages.report.list',compact('page'));
    }

    public function unitsales(Request $request){

        
        $month = date('m');
        if(!empty($request->month)){
            $month = $request->month;
        }
        $page = [
    		'module' => 'Laporan',
    		'title' => 'Penjualan Unit'
    	];
        $sales = \DB::table('credits')
                 ->select(
                    'vehicle_id', 
                    'vehicles.name as name',
                    // 'created_at as date',
                    \DB::raw('sum(credits.down_payment) as dp_total'),
                    \DB::raw('count(*) as vehicle_total'
                 ))
                 ->join('vehicles','vehicles.id','=','credits.vehicle_id')
                 ->whereMonth('credits.created_at', '=', $month)
                 ->whereYear('credits.created_at', '=', date('Y'))
                 ->groupBy('vehicle_id')
                 ->get();
        
                //  dd($sales);
        return view('admin.pages.report.unit_sales', compact('page','sales'));
    }

    public function creditdetails(Request $request)
    {
         
        $month = date('m');
        if(!empty($request->month)){
            $month = $request->month;
        }
        $page = [
    		'module' => 'Laporan',
    		'title' => 'Detail Penerimaan Kredit'
    	];

        $details = \DB::table('credits')
                    ->select(
                    'customers.first_name as customer_first_name',
                    'credit_details.installment_value as value',
                    'credit_details.paid_date as date',
                    'vehicles.name as vehicle_name',
                    'customers.last_name as customer_last_name')
                    
                    ->join('customers','customers.id','=','credits.customer_id')
                    ->join('vehicles','vehicles.id','=','credits.vehicle_id')
                    ->join('credit_details','credit_details.id','=','credits.id')
                    ->whereMonth('credit_details.paid_date', '=', $month)
                    ->whereYear('credit_details.paid_date', '=', date('Y'))
                    ->get();
        // dd(date('Y'));
        return view('admin.pages.report.credit_detail', compact('page','details'));

    }
}
