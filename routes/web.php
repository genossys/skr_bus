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

Route::get('/', 'Member\homeController@index');

Route::get('/jadwal', 'Member\homeController@cariJadwal');
Route::get('/prebooking', 'Member\Transaksi\pemesananController@prebooking');
Route::post('/booking', 'Member\Transaksi\pemesananController@pesan');
Route::delete('/deletebooking/{id}', 'Member\Transaksi\pemesananController@delete');
Route::post('/cekout', 'Member\Transaksi\pemesananController@cekout');
Route::get('/daftarpesanan', 'Member\Transaksi\pembayaranController@index');
Route::get('/konfirmasi', 'Member\Transaksi\pembayaranController@showFormKonfirmasi');
Route::post('/upload', 'Member\Transaksi\pembayaranController@confirm');
Route::get('/cekpesanan', 'Member\Transaksi\pembayaranController@cekPesanan');



Auth::routes();

Route::get('/login', 'Auth\Member\LoginController@showLoginForm');
Route::post('/postlogin', 'Auth\Member\LoginController@postlogin');
Route::get('/logout', 'Auth\Member\LoginController@logout')->name('logout');

//registrasi member
Route::get('/register', 'Auth\Member\RegisterController@showRegistrationForm');
Route::post('/postRegister', 'Auth\Member\RegisterController@register');

//login admin
Route::get('/adminpanel', 'Auth\Admin\LoginController@showLoginForm');
Route::post('/postloginadmin', 'Auth\Admin\LoginController@postlogin');
Route::get('/logoutadmin', 'Auth\Admin\LoginController@logout')->name('logoutadmin');

Route::group(['middleware' => 'auth:web'], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::get('/', 'Admin\dashboardController@index');

        Route::group(['prefix' => 'user'], function () {
            Route::get('/', 'Admin\Master\userController@index')->name('pageuser');
            Route::get('/view', 'Admin\Master\userController@getData');
            Route::get('/new', 'Admin\Master\userController@showForm');
            Route::post('/add', 'Admin\Master\userController@add');
            Route::get('/store', 'Admin\Master\userController@store');
            Route::post('/update', 'Admin\Master\userController@edit');
            Route::delete('/delete', 'Admin\Master\userController@delete');
        });

        Route::group(['prefix' => 'member'], function () {
            Route::get('/', 'Admin\Master\memberController@index')->name('pagemember');
            Route::get('/view', 'Admin\Master\memberController@getData');
            Route::get('/new', 'Admin\Master\memberController@showForm');
            Route::post('/add', 'Admin\Master\memberController@add');
            Route::get('/store', 'Admin\Master\memberController@store');
            Route::post('/update', 'Admin\Master\memberController@edit');
            Route::delete('/delete', 'Admin\Master\memberController@delete');
        });

        Route::group(['prefix' => 'bus'], function () {
            Route::get('/', 'Admin\Master\busController@index')->name('pagebus');
            Route::get('/view', 'Admin\Master\busController@getData');
            Route::get('/new', 'Admin\Master\busController@showForm');
            Route::post('/add', 'Admin\Master\busController@add');
            Route::get('/store', 'Admin\Master\busController@store');
            Route::post('/update', 'Admin\Master\busController@edit');
            Route::delete('/delete', 'Admin\Master\busController@delete');
        });

        Route::group(['prefix' => 'kota'], function () {
            Route::get('/', 'Admin\Master\kotaController@index')->name('pagekota');
            Route::get('/view', 'Admin\Master\kotaController@getData');
            Route::get('/new', 'Admin\Master\kotaController@showForm');
            Route::post('/add', 'Admin\Master\kotaController@add');
            Route::get('/store', 'Admin\Master\kotaController@store');
            Route::post('/update', 'Admin\Master\kotaController@edit');
            Route::delete('/delete', 'Admin\Master\kotaController@delete');
        });

        Route::group(['prefix' => 'terminal'], function () {
            Route::get('/', 'Admin\Master\terminalController@index')->name('pageterminal');
            Route::get('/view', 'Admin\Master\terminalController@getData');
            Route::get('/new', 'Admin\Master\terminalController@showForm');
            Route::post('/add', 'Admin\Master\terminalController@add');
            Route::get('/store', 'Admin\Master\terminalController@store');
            Route::post('/update', 'Admin\Master\terminalController@edit');
            Route::delete('/delete', 'Admin\Master\terminalController@delete');
        });

        Route::group(['prefix' => 'jadwal'], function () {
            Route::get('/', 'Admin\Master\jadwalController@index')->name('pagejadwal');
            Route::get('/view', 'Admin\Master\jadwalController@getData');
            Route::get('/viewbus', 'Admin\Master\jadwalController@getDataBus');
            Route::get('/new', 'Admin\Master\jadwalController@showForm');
            Route::post('/add', 'Admin\Master\jadwalController@add');
            Route::get('/store', 'Admin\Master\jadwalController@store');
            Route::post('/update', 'Admin\Master\jadwalController@edit');
            Route::delete('/delete', 'Admin\Master\jadwalController@delete');
        });

        Route::get('/pembayaran', 'Admin\Transaksi\PembayaranController@index')->name('pagepembayaran');
        Route::get('/pembayarandetail', 'Admin\Transaksi\PembayaranController@detail');
        Route::post('/confirmpembayaran', 'Admin\Transaksi\PembayaranController@confirm');

        Route::get('/laporanpemesanan', 'Admin\Laporan\LaporanPemesananController@index');
        Route::get('/laporanpemesananview', 'Admin\Laporan\LaporanPemesananController@search');
        Route::get('/transaksi', function () {
            return view('admin.transaksi.pagetransaksi');
        })->name('pagetransaksi');
        Route::get('/detail', function () {
            return view('admin.transaksi.detail');
        })->name('pagedetail');
    });
});
