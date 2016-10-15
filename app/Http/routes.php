<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function() {
	// Testing goes here
});

// E-BUYad API
Route::group(['prefix'	=> 'api'], function() {
	// API v1
	Route::group(['prefix'	=> 'v1'], function() {
		Route::resource('accounts', 'Api\\AccountsController');
		Route::resource('loads', 'Api\\LoadController');
		Route::resource('members', 'Api\\MemberController');
		Route::resource('points', 'Api\\PointController');
		Route::resource('products', 'Api\\ProductController');
		Route::resource('shopping-carts', 'Api\\ShoppingCartController');
		Route::resource('transaction-histories', 'Api\\TransactionHistoryController');
	});
});
