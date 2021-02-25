<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    //dd($users);

    return view('admin.home');
})->name('home');

Route::group([
	'as' => 'vehicle.',
	'prefix' => 'vehicle'
], function (Router $router) {
	$controller = "Admin\VehicleController@";
   	$router->get('list',$controller.'list')->name('list');
});

