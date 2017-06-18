<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Auth::routes();

Route::get('/', 'OwnerController@index');

/**
* Clients/Persons
*/
Route::group(['prefix' => 'proprietarios'], function(){

	Route::get('/', ['as' => 'owners.index', 'uses' => 'OwnerController@index']);
	Route::get('new', ['as' => 'owners.create', 'uses' => 'OwnerController@create']);
	Route::get('{id}', ['as' => 'owners.show', 'uses' => 'OwnerController@show']);
	Route::post('store', ['as' => 'owners.store', 'uses' => 'OwnerController@store']);
	Route::get('{id}/edit', ['as' => 'owners.edit', 'uses' => 'OwnerController@edit']);
	Route::post('{id}/update', ['as' => 'owners.update', 'uses' => 'OwnerController@update']);
	Route::get('{id}/delete', ['as' => 'owners.destroy', 'uses' => 'OwnerController@destroy']);

});


Route::group(['prefix' => 'carros'], function(){

	Route::get('/', ['as' => 'cars.index', 'uses' => 'CarController@index']);
	Route::get('{owner}/new', ['as' => 'cars.create', 'uses' => 'CarController@create']);
	Route::get('{id}', ['as' => 'cars.show', 'uses' => 'CarController@show']);
	Route::post('store', ['as' => 'cars.store', 'uses' => 'CarController@store']);
	Route::post('add', ['as' => 'cars.add', 'uses' => 'CarController@add']);
	Route::get('{id}/edit', ['as' => 'cars.edit', 'uses' => 'CarController@edit']);
	Route::post('{id}/update', ['as' => 'cars.update', 'uses' => 'CarController@selfUpdate']);
	Route::get('{id}/{owner}/delete', ['as' => 'cars.destroy', 'uses' => 'CarController@destroy']);

});

Route::group(['prefix' => 'pagamentos'], function(){

	Route::get('/', ['as' => 'payments.index', 'uses' => 'PaymentController@index']);
	Route::get('new', ['as' => 'payments.create', 'uses' => 'PaymentController@create']);
	Route::get('{id}', ['as' => 'payments.show', 'uses' => 'PaymentController@show']);
	Route::post('store', ['as' => 'payments.store', 'uses' => 'PaymentController@store']);
	Route::get('{id}/edit', ['as' => 'payments.edit', 'uses' => 'PaymentController@edit']);
	Route::post('{id}/update', ['as' => 'payments.update', 'uses' => 'PaymentController@update']);
	Route::post('pordata', ['as' => 'payments.findDate', 'uses' => 'PaymentController@findDate']);

});

Route::group(['prefix' => 'telefones'], function(){

	Route::get('/', ['as' => 'phones.index', 'uses' => 'PhoneController@index']);
	Route::get('{owner}/new', ['as' => 'phones.create', 'uses' => 'PhoneController@create']);
	Route::get('{id}', ['as' => 'phones.show', 'uses' => 'PhoneController@show']);
	Route::post('store', ['as' => 'phones.store', 'uses' => 'PhoneController@store']);
	Route::post('add', ['as' => 'phones.add', 'uses' => 'PhoneController@add']);
	Route::get('{id}/edit', ['as' => 'phones.edit', 'uses' => 'PhoneController@edit']);
	Route::post('{id}/update', ['as' => 'phones.update', 'uses' => 'PhoneController@update']);
	Route::get('{id}/{owner}/delete', ['as' => 'phones.destroy', 'uses' => 'PhoneController@destroy']);

});