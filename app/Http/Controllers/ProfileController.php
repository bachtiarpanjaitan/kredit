<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
    	 $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        return view('auth.pages.profile.form',compact('user'));
    }

    public function save(Request $request){
        $data = $request->all();
        
       if(!empty($data['password'])){
            $validations = Validator::make($request->all(), [
                'password' => 'required|confirmed|min:8',
            ]);

            if ($validations->fails()) {
                return redirect()->back()
                            ->withErrors($validations)
                            ->withInput();
            }

            $user = Auth::user();

            $user->password = bcrypt($data['password']);
            $user->save();            
       }

       return redirect()->back();
    }
}
