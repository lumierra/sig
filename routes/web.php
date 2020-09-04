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
    Route::resource('management-user', 'Management\ManagementController');

    Route::resource('kepala-gizi', 'Head\HeadController');
//    Route::get('users/data', 'Users\UserController@getUser')->name('user.data');

    Route::resource('dashboard-makanan', 'Dashboard\DashboardMakanan')->only('index');
    Route::resource('makanan', 'Makanan\MakananController');
    Route::resource('bahan-makanan', 'Bahan\BahanController');
    Route::resource('jenis-makanan', 'Jenis\JenisController');
    Route::resource('satuan-makanan', 'Satuan\SatuanController');
    Route::resource('detail-makanan', 'Detail\DetailBahanMakananController');
    Route::resource('kategori', 'Kategori\KategoriController');
    Route::get('detail-makanan/{id}/show', 'Detail\DetailBahanMakananController@show');
    Route::delete('detail-makanan/{id}/destroy', 'Detail\DetailBahanMakananController@destroy');
    Route::get('detail-makanan/{id}/create2', 'Detail\DetailBahanMakananController@create2');

    Route::resource('dashboard-pengadaan', 'Dashboard\DashboardPengadaan')->only('index');
    Route::resource('vendor', 'Vendor\VendorController');
    Route::resource('permintaan', 'Permintaan\PermintaanController');
    Route::resource('penerimaan', 'Penerimaan\PenerimaanController');
    Route::get('penerimaan/{id}/showReceipt', 'Penerimaan\PenerimaanController@showReceipt')->name('penerimaan.showReceipt');
    Route::get('permintaan/{id}/showDemand', 'Permintaan\PermintaanController@showDemand')->name('permintaan.showDemand');

    Route::resource('dashboard-operasional', 'Dashboard\DashboardOperasional')->only('index');
    Route::resource('pengeluaran', 'Pengeluaran\PengeluaranController');
    Route::resource('retur', 'Retur\ReturController');
    Route::get('pengeluaran/{id}/showSpend', 'Pengeluaran\PengeluaranController@showSpend')->name('pengeluaran.showSpend');
    Route::get('retur/{id}/showRetur', 'Retur\ReturController@showRetur')->name('retur.showRetur');
    Route::get('pengeluaran/{material}/cekBahan', 'Pengeluaran\PengeluaranController@cekBahan');

    Route::resource('products', 'ProductController');

//    Route::get('/test', 'Makanan\MakananController@test');
    Route::get('/test', function (){
       return view('admin.test');
    });
});

//Route::resource('products', 'ProductController');

