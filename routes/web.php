<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return redirect()->route('login');
});

Route::get('/home', function () {
    return redirect()->route('admin.dashboard.index');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:show-admin')->group(function (){
    Route::resource('dashboard', 'Dashboard\DashboardController')->only('index');
    Route::resource('users', 'Users\UserController');

    Route::resource('kepala-gizi', 'Head\HeadController')->except('craete', 'show', 'update');
//    Route::get('users/data', 'Users\UserController@getUser')->name('user.data');

    Route::resource('dashboard-makanan', 'Dashboard\DashboardMakanan')->only('index');
    Route::resource('makanan', 'Makanan\MakananController')->except('create', 'show', 'update');
    Route::resource('bahan-makanan', 'Bahan\BahanController')->except('create', 'show', 'update');
    Route::resource('jenis-makanan', 'Jenis\JenisController')->except('create', 'show', 'update');;
    Route::resource('satuan-makanan', 'Satuan\SatuanController')->except('create', 'show', 'update');
    Route::resource('detail-makanan', 'Detail\DetailBahanMakananController')->except('create', 'show', 'update');

    Route::resource('dashboard-pengadaan', 'Dashboard\DashboardPengadaan')->only('index');
    Route::resource('vendor', 'Vendor\VendorController')->except('create', 'show', 'update');
    Route::resource('permintaan', 'Permintaan\PermintaanController')->except('create', 'show', 'update');
    Route::resource('penerimaan', 'Penerimaan\PenerimaanController')->except('create', 'show', 'update');

    Route::resource('products', 'ProductController');

    Route::get('/test', 'Makanan\MakananController@test');
});

//Route::resource('products', 'ProductController');

