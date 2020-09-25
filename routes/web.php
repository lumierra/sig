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

Route::get('/guest', 'HomeController@index')->name('guest');
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return redirect()->route('admin.dashboard.index');
});

Route::namespace('Admin')
    ->prefix('admin')
    ->name('admin.')
    ->middleware('can:show-admin')
    ->group(function (){

        Route::resource('users', 'Users\UserController');
        Route::resource('management-user', 'Management\ManagementController');
        Route::resource('dashboard', 'Dashboard\DashboardController')->only('index');
        Route::post('change-password', 'Management\ManagementController@changePassword')->name('management-user.change-password');
        Route::get('keluar', 'Management\ManagementController@keluar')->name('keluar');

        Route::resource('kepala-gizi', 'Head\HeadController');
//    Route::get('users/data', 'Users\UserController@getUser')->name('user.data');

        Route::resource('makanan', 'Makanan\MakananController');
        Route::resource('bahan-makanan', 'Bahan\BahanController');
        Route::resource('jenis-makanan', 'Jenis\JenisController');
        Route::resource('kategori', 'Kategori\KategoriController');
        Route::resource('satuan-makanan', 'Satuan\SatuanController');
        Route::get('bahan-makanan/{id}/show', 'Bahan\BahanController@show');
        Route::resource('detail-makanan', 'Detail\DetailBahanMakananController');
        Route::get('detail-makanan/{id}/show', 'Detail\DetailBahanMakananController@show');
        Route::get('detail-makanan/{id}/create2', 'Detail\DetailBahanMakananController@create2');
        Route::delete('detail-makanan/{id}/destroy', 'Detail\DetailBahanMakananController@destroy');
        Route::resource('dashboard-makanan', 'Dashboard\DashboardMakanan')->only('index');


        Route::resource('vendor', 'Vendor\VendorController');
        Route::resource('permintaan', 'Permintaan\PermintaanController');
        Route::resource('penerimaan', 'Penerimaan\PenerimaanController');
        Route::resource('dashboard-pengadaan', 'Dashboard\DashboardPengadaan')->only('index');
        Route::get('permintaan/{id}/delete', 'Permintaan\PermintaanController@delete')->name('permintaan.delete');
        Route::get('penerimaan/{id}/delete', 'Penerimaan\PenerimaanController@delete')->name('penerimaan.delete');
        Route::get('penerimaan/{id}/create2', 'Permintaan\PermintaanController@create2')->name('penerimaan.create2');
        Route::get('permintaan/{material}/cekBahan', 'Permintaan\PermintaanController@cekBahan')->name('permintaan.cekBahan');
        Route::get('permintaan/{id}/showDemand', 'Permintaan\PermintaanController@showDemand')->name('permintaan.showDemand');
        Route::get('penerimaan/{id}/findDemand', 'Penerimaan\PenerimaanController@findDemand')->name('penerimmaan.findDemand');
        Route::get('penerimaan/{id}/showReceipt', 'Penerimaan\PenerimaanController@showReceipt')->name('penerimaan.showReceipt');

        Route::resource('retur', 'Retur\ReturController');
        Route::resource('stok-bahan', 'Stok\StokController');
        Route::get('retur/{id}/delete', 'Retur\ReturController@delete');
        Route::resource('pengeluaran', 'Pengeluaran\PengeluaranController');
        Route::get('pengeluaran/{material}/cekStok', 'Pengeluaran\PengeluaranController@cekStok');
        Route::get('pengeluaran/{material}/cekBahan', 'Pengeluaran\PengeluaranController@cekBahan');
        Route::get('pengeluaran/{material}/kalkulasi', 'Pengeluaran\PengeluaranController@kalkulasi');
        Route::get('retur/{id}/showRetur', 'Retur\ReturController@showRetur')->name('retur.showRetur');
        Route::get('retur/{id}/findSpend', 'Retur\ReturController@findSpend')->name('retur.findDemand');
        Route::resource('dashboard-operasional', 'Dashboard\DashboardOperasional')->only('index');
        Route::get('pengeluaran/{material}/cekPengeluaran', 'Pengeluaran\PengeluaranController@cekPengeluaran');
        Route::get('pengeluaran/{id}/delete', 'Pengeluaran\PengeluaranController@delete')->name('pengeluaran.delete');
        Route::get('pengeluaran/{id}/showSpend', 'Pengeluaran\PengeluaranController@showSpend')->name('pengeluaran.showSpend');

        Route::resource('ahli-gizi', 'AhliGizi\AhliGiziController');
        Route::get('ahli-gizi/ruangan', 'AhliGizi\AhliGiziController@ruangan')->name('ahli-gizi.ruangan');

        Route::resource('room', 'Room\RoomController');
        Route::get('management-user/create2', 'Management\ManagementController@create2')->name('management-user.create2');
        Route::get('managament/{id}/showRoom', 'Management\ManagementController@showRoom')->name('management.showRoom');
        Route::post('management/updateRoom', 'Management\ManagementController@updateRoom')->name('management.updateRoom');

        Route::resource('products', 'ProductController');
        Route::get('/asd', function (){
            return view('admin.permintaan.test');
        });
   Route::get('/test', 'Vendor\VendorController@test');
});

//Route::resource('products', 'ProductController');
