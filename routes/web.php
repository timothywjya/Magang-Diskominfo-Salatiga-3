<?php

use GuzzleHttp\Middleware;
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
    return view('Auth/login');
});
Route::get('/iklan/cetak/{id}/{tanggal}','App\Http\Controllers\IklanController@cetakPerTransaksi')->name('cetakPerTransaksi');
Route::get('/cetak/{nomor_dokumen}/{nomor_billing}/{tanggal_setor}','App\Http\Controllers\IklanController@cetak')->name('cetak');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Auth::routes();
Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');
Route::group(['middleware' => ['auth','CekLevel:admin']], function(){
        Route::resource('users', \App\Http\Controllers\UserController::class)
        ->middleware('auth'); 
    });
    Route::group(['middleware' => ['auth','CekLevel:admin,operator']], function(){
        Route::get('/iklan/{status?}', 'App\Http\Controllers\IklanController@index')->name('iklan');
        Route::get('/iklanradio/{status?}', 'App\Http\Controllers\IklanController@getDataIklan');
        Route::get('/viewsetoran', function () {
            return view('setoran');
        });
        Route::resource('iklan2', App\Http\Controllers\IklanController::class);
        Route::get('/iklansetoran', 'App\Http\Controllers\IklanController@setoran');
        Route::get('/detail/{nomor_dokumen}/{nomor_billing}/{tanggal_setor}', 'App\Http\Controllers\IklanController@detail')->name('detail');
        Route::get('/profile', 'App\Http\Controllers\UserController@profile');
        Route::post('/IklanRadio/setor', 'App\Http\Controllers\IklanController@draftSetor');
        Route::get('/admin/setor/{id}', 'App\Http\Controllers\IklanController@draftSetor')->name('setorkan');
        Route::post('/setor', 'App\Http\Controllers\IklanController@setor')->name('setor');
        Route::post('/iklan/store','App\Http\Controllers\IklanController@store')->name('simpan');
        Route::get('/iklan/edit/{id}','App\Http\Controllers\IklanController@edit')->name('edit');
        Route::post('/iklan/update/{id}','App\Http\Controllers\IklanController@update');
        Route::get('/iklan/destroy/{id}','App\Http\Controllers\IklanController@destroy')->name('delete'); 
    });