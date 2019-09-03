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
    return view('umum.welcome');
});

Route::get('/jadwal', function () {
    return view('umum.jadwal');
});

Route::get('/pembayaran', function () {
    return view('umum.pembayaran');
});

Route::get('/cekpesanan', function () {
    return view('umum.cekpesanan');
});

Route::get('/prebooking', function () {
    return view('umum.prebooking');
});
