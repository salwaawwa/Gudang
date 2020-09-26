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

/**
 * 
 * Route Auth
 * 
 */
Route::group(['middleware' => 'guest'], function() {
    Route::get('login', 'Auth\AuthController@loginView')->name('login');
    Route::post('login', 'Auth\AuthController@login')->name('login');
    
    Route::get('register', 'Auth\AuthController@registerView')->name('register');
    Route::post('register', 'Auth\AuthController@register')->name('register');
});


Route::group(['middleware' => 'auth'], function() {
    
    /**
     * 
     * Route Dashboard
     * 
     */
    Route::resource('dashboard', 'DashboardController')->middleware('auth');

    Route::group(['middleware' => 'Owner'] , function() {
         // USERS
        Route::get('users/data', 'UserController@data')->name('users.data');
        Route::get('users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
        Route::resource('users', 'UserController')->except(['destroy']);
    });
    
    // Gudang
    Route::get('gudang/data','GudangController@data')->name('gudang.data');
    Route::get('gudang/{slug}/delete','GudangController@destroy')->name('gudang.destroy');
    Route::resource('gudang', 'GudangController')->except(['destroy']);
    
    //Barang
    Route::get('barang/{slug}/delete','BarangController@destroy')->name('barang.destroy');
    Route::get('barang/{slug}/restore','BarangController@restore')->name('barang.restore');
    Route::get('barang/data','BarangController@data')->name('barang.data');
    Route::resource('barang','BarangController')->except(['destroy']);

    //Transaksi
    Route::get('transaksi','TransaksiController@index')->name('transaksi.index');
    Route::get('transaksi/create','TransaksiController@create')->name('transaksi.create');
    Route::post('transaksi/store','TransaksiController@store')->name('transaksi.store');
    Route::get('transaksi/data', 'TransaksiController@data')->name('transaksi.data');

    Route::get('logout', 'Auth\AuthController@logout')->name('logout');
});
