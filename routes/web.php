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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', 'WeatherController@getWeather')->name('weather');
Route::get('/orders', 'OrdersController@getOrders')->name('orders');
Route::get('/order-edit/{id}', ['as' => 'order.edit.id', 'uses' => 'OrdersController@orderEdit']);
Route::post('/order-save', 'OrdersController@orderSave')->name('order-save');