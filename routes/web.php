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
    Route::get('bahan-makanan/{id}/show', 'Bahan\BahanController@show');
    Route::get('bahan-makanan/{id}/updateData', 'Bahan\BahanController@updateData')->name('bahan.update');


    Route::resource('dashboard-pengadaan', 'Dashboard\DashboardPengadaan')->only('index');
    Route::resource('vendor', 'Vendor\VendorController');
    Route::resource('permintaan', 'Permintaan\PermintaanController');
    Route::resource('penerimaan', 'Penerimaan\PenerimaanController');
    Route::get('penerimaan/{id}/showReceipt', 'Penerimaan\PenerimaanController@showReceipt')->name('penerimaan.showReceipt');
    Route::get('permintaan/{id}/showDemand', 'Permintaan\PermintaanController@showDemand')->name('permintaan.showDemand');
    Route::get('penerimaan/{id}/create2', 'Permintaan\PermintaanController@create2')->name('penerimaan.create2');
    Route::get('permintaan/{material}/cekBahan', 'Permintaan\PermintaanController@cekBahan')->name('permintaan.cekBahan');
    Route::get('permintaan/{id}/delete', 'Permintaan\PermintaanController@delete')->name('permintaan.delete');
    Route::get('penerimaan/{id}/findDemand', 'Penerimaan\PenerimaanController@findDemand')->name('penerimmaan.findDemand');
    Route::get('penerimaan/{id}/delete', 'Penerimaan\PenerimaanController@delete')->name('penerimaan.delete');

    Route::resource('dashboard-operasional', 'Dashboard\DashboardOperasional')->only('index');
    Route::resource('pengeluaran', 'Pengeluaran\PengeluaranController');
    Route::resource('retur', 'Retur\ReturController');
    Route::get('pengeluaran/{id}/showSpend', 'Pengeluaran\PengeluaranController@showSpend')->name('pengeluaran.showSpend');
    Route::get('retur/{id}/showRetur', 'Retur\ReturController@showRetur')->name('retur.showRetur');
    Route::get('pengeluaran/{material}/cekBahan', 'Pengeluaran\PengeluaranController@cekBahan');
    Route::resource('stok-bahan', 'Stok\StokController');

    Route::resource('products', 'ProductController');

//    Route::get('/test', 'Makanan\MakananController@test');
    Route::get('/asd', function (){
       return view('admin.permintaan.test');
    });
});

//Route::resource('products', 'ProductController');

