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

Route::get('login','LoginController@login')->name('login');
Route::post('login','LoginController@login_auth')->name('login.post');
Route::get('register','LoginController@register')->name('register');
Route::post('register','LoginController@register_post')->name('register.create');

Route::group(['middleware' => ['auth','checkRole:0']], function () {
Route::get('master-data/departemen','DepartemenController@index')->name('departemen.index');
Route::get('master-data/departemen/tambah','DepartemenController@tambah')->name('departemen.tambah');
Route::post('master-data/departemen/simpan','DepartemenController@create')->name('departemen.create');
Route::get('master-data/departemen/{id}','DepartemenController@edit')->name('departemen.edit');
Route::put('master-data/departemen','DepartemenController@storeEdit')->name('departemen.storeEdit');
Route::delete('master-data/departemen','DepartemenController@delete')->name('departemen.delete');
Route::post('master-data/departemen','DepartemenController@activate')->name('departemen.activate');

Route::get('master-data/dental-unit','DentalUnitController@index')->name('dentalUnit.index');
Route::get('master-data/dental-unit/tambah','DentalUnitController@tambah')->name('dentalUnit.tambah');
Route::post('master-data/dental-unit/simpan','DentalUnitController@create')->name('dentalUnit.create');
Route::get('master-data/dental-unit/{id}','DentalUnitController@edit')->name('dentalUnit.edit');
Route::put('master-data/dental-unit','DentalUnitController@storeEdit')->name('dentalUnit.storeEdit');
Route::delete('master-data/dental-unit','DentalUnitController@delete')->name('dentalUnit.delete');
Route::post('master-data/dental-unit','DentalUnitController@activate')->name('dentalUnit.activate');
Route::get('master-data/ketersediaan','DentalUnitController@ketersediaan')->name('dentalUnit.ketersediaan');

Route::get('master-data/pegawai','PegawaiController@index')->name('pegawai.index');
Route::get('master-data/pegawai/tambah','PegawaiController@tambah')->name('pegawai.tambah');
Route::post('master-data/pegawai','PegawaiController@create')->name('pegawai.create');
Route::get('master-data/pegawai/{id}','PegawaiController@edit')->name('pegawai.edit');
Route::put('master-data/pegawai','PegawaiController@storeEdit')->name('pegawai.storeEdit');
Route::delete('master-data/pegawai','PegawaiController@delete')->name('pegawai.delete');
// Route::post('master-data/pegawai','PegawaiController@activate')->name('pegawai.activate');

Route::get('master-data/koas','MhsKoasController@index')->name('koas.index');
Route::get('master-data/koas/tambah','MhsKoasController@tambah')->name('koas.tambah');
Route::post('master-data/koas/simpan','MhsKoasController@create')->name('koas.create');
Route::get('master-data/koas/{id}','MhsKoasController@edit')->name('koas.edit');
Route::put('master-data/koas','MhsKoasController@storeEdit')->name('koas.storeEdit');
Route::delete('master-data/koas','MhsKoasController@delete')->name('koas.delete');
Route::post('master-data/koas','MhsKoasController@activate')->name('koas.activate');

Route::get('master-data/pengguna','UserController@index')->name('pengguna.index');
Route::get('master-data/pengguna/tambah','UserController@tambah')->name('pengguna.tambah');
Route::post('master-data/pengguna','UserController@create')->name('pengguna.create');
Route::get('master-data/pengguna/{id}','UserController@edit')->name('pengguna.edit');
Route::put('master-data/pengguna','UserController@storeEdit')->name('pengguna.storeEdit');
Route::delete('master-data/pengguna/delete','UserController@delete')->name('pengguna.delete');
Route::post('master-data/pengguna/activate','UserController@activate')->name('pengguna.activate');

Route::get('pengaturan','PengaturnController@index')->name('pengaturan.index');
Route::post('pengaturan/jam-operasional','PengaturanController@jamOperasional');

// Auth::routes();
});

//route koas
Route::group(['middleware' => ['auth','checkRole:0,1,2']], function () {
Route::get('logout','LoginController@logout')->name('logout');
Route::get('home','HomeController@index')->name('home');

Route::get('pesan/','DentalUnitController@pesan')->name('dentalUnit.pesan');
Route::get('pesan/cari','DentalUnitController@hasil_pencarian')->name('dentalUnit.hasilPencarian');
Route::get('pesan/daftar/{id}/{tanggal}','DentalUnitController@daftar_pesan')->name('dentalUnit.daftarPesan');
Route::post('pesan/simpan/{id}','DentalUnitController@simpan_pesan')->name('dentalUnit.simpanPesan');

Route::get('transaksi','TransaksiBookingController@show')->name('transaksi.index');
Route::get('transaksi/cari','TransaksiBookingController@show')->name('transaksi.hasilPencarian');
Route::post('transaksi/verifikasi/{id}','TransaksiBookingController@verifikasi')->name('transaksi.verifikasi');
Route::post('transaksi/selesai/{id}','TransaksiBookingController@selesai')->name('transaksi.selesai');
Route::post('transaksi/batal/{id}','TransaksiBookingController@batal')->name('transaksi.batal');
Route::get('transaksi/riwayat','TransaksiBookingController@riwayat')->name('transaksi.riwayat');
});