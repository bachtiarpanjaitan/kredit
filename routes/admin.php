<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('admin')->user();

    $page = [
    		'module' => '',
    		'title' => 'Beranda'
    	];

    return view('admin.home',compact('page'));
})->name('home');

Route::group([
	'as' => 'vehicle.',
	'prefix' => 'vehicle'
], function (Router $router) {
	$controller = "Admin\VehicleController@";
    $router->get('list',$controller.'list')->name('list');
    $router->post('delete',$controller.'delete')->name('delete');
    $router->get('add',$controller.'add')->name('add');
    $router->post('save',$controller.'save')->name('save');
   	$router->get('edit/{id}',$controller.'edit')->name('edit');
});

