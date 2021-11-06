<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('thingspeak', 'AmbilController@index'); //ambil seluruh data di thingspeak
Route::get('suhu', 'AmbilController@indexsuhu'); //ambil suhu di thingspeak
Route::get('saturasi', 'AmbilController@indexsaturasi'); //amnil saturasi di thingspeak
Route::get('maxsuhu', 'AmbilController@getmaxsuhu'); //ambil nilai tertinggi dari suhu
Route::get('minsuhu', 'AmbilController@getminsuhu'); //ambil nilai terendah dari suhu
Route::get('maxsaturasi', 'AmbilController@getmaxsaturasi'); //ambil nilai tertinggi dari suhu
Route::get('minsaturasi', 'AmbilController@getminsaturasi'); //ambil nilai terendah dari suhu
Route::get('meansuhu', 'AmbilController@meansuhu'); //ambil rata-rata suhu
Route::get('meansaturasi', 'AmbilController@meansaturasi'); //ambil rata-rata saturasi
Route::get('bydate', 'AmbilController@bydate'); //ambil by tanggal
