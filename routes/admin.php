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

Route::group([
    'as' => 'customer.',
    'prefix' => 'customer'
], function (Router $router) {
    $controller = "Admin\CustomerController@";
    $router->get('list',$controller.'list')->name('list');
    $router->post('delete',$controller.'delete')->name('delete');
    $router->get('add',$controller.'add')->name('add');
    $router->post('save',$controller.'save')->name('save');
    $router->get('edit/{id}',$controller.'edit')->name('edit');
});

Route::group([
    'as' => 'province.',
    'prefix' => 'province'
], function (Router $router) {
    $controller = "Admin\ProvinceController@";
    $router->get('province',$controller.'regency')->name('get_regency');
});

Route::group([
    'as' => 'regency.',
    'prefix' => 'regency'
], function (Router $router) {
    $controller = "Admin\RegencyController@";
    $router->get('regency',$controller.'district')->name('get_district');
});

Route::group([
    'as' => 'district.',
    'prefix' => 'district'
], function (Router $router) {
    $controller = "Admin\DistrictController@";
    $router->get('district',$controller.'village')->name('get_village');
});



