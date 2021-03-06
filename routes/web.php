<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
	return view('welcome');
});


Auth::routes(['register' => false]);

Route::group(['middleware' => ['role:admin']], function () {
    //
    Route::get('/home', 'HomeController@index')->name('home');

	Route::resource('category','CategoryController');

	Route::resource('brand','BrandController'); 

	Route::resource('supplier','SupplierController'); 

	Route::resource('staff','StaffController');  

	Route::resource('item','ItemController');  

	Route::resource('stock','StockController'); 

	Route::post('getitem','StockController@getitem')->name('getitem');

});

Route::group(['middleware' => ['role:staff']], function () {
    	
    Route::get('salepage','SaleController@salepage')->name('salepage');

	Route::get('getallitem','SaleController@getallitem')->name('getallitem');

	Route::post('byBrand','SaleController@byBrand')->name('byBrand');

	Route::post('byCategory','SaleController@byCategory')->name('byCategory');

	Route::post('sale','SaleController@sale')->name('sale');
	
	Route::get('salesuccess','SaleController@salesuccess')->name('salesuccess');

});
	
