<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Credit;
use App\Models\CreditDetail as CD;
use Auth;

class CreditController extends Controller
{
    public function __construct()
    {
    	 $this->middleware('auth');
    }

    public function info()
    {
    	$credits = Credit::with(['details','vehicle'])->where('customer_id',Auth::user()->customer()->first()->id)->get();
    	return view('auth.pages.credit.info',compact('credits'));
    }
}
