<?php

use Illuminate\Http\Request;
use App\Http\Controllers\pelanggancontroller;

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

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With, enctype');
header('Access-Control-Allow-Methods: GET, PATCH, POST, DELETE');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//////////////////////////////////////////////////////////////////////////////////Kelola Data
Route::get('/jasa_service','jasaservicecontroller@index');
Route::get('/jasa_service/all','jasaservicecontroller@all');
Route::get('/jasa_service/{id}','jasaservicecontroller@show');
Route::get('/jasa_service/search','jasaservicecontroller@search');
Route::post('/jasa_service/store','jasaservicecontroller@store');
Route::put('/jasa_service/update/{id}','jasaservicecontroller@update');
Route::delete('/jasa_service/{id}','jasaservicecontroller@destroy');

Route::get('/mobile/jasa_service','jasaservicecontroller@indexMobile');


Route::get('/role','rolecontroller@index');
Route::get('/role/all','rolecontroller@all');
Route::get('/role/{id}','rolecontroller@show');
Route::get('/role/showByName/{nama_role}','rolecontroller@showByName');
Route::post('/role/store','rolecontroller@store');
Route::put('/role/update/{id}','rolecontroller@update');
Route::delete('/role/{id}','rolecontroller@destroy');


Route::get('/pegawai','pegawaicontroller@index');
Route::get('/pegawai/all','pegawaicontroller@all');
Route::get('/pegawai/{id}','pegawaicontroller@show');
Route::get('/pegawai/showByName/{nama_pegawai}','pegawaicontroller@showByName');
Route::post('/pegawai/store','pegawaicontroller@store');
Route::put('/pegawai/update/{id}','pegawaicontroller@update');
Route::delete('/pegawai/{id}','pegawaicontroller@destroy');
Route::post('/pegawai/login','pegawaicontroller@login');

Route::get('/mobile/pegawai','pegawaicontroller@indexMobile');


Route::get('/cabang','cabangcontroller@index');
Route::get('/cabang/all','cabangcontroller@all');
Route::get('/cabang/{id}','cabangcontroller@show');
Route::get('/cabang/showByName/{nama_cabang}','cabangcontroller@showByName');
Route::post('/cabang/store','cabangcontroller@store');
Route::put('/cabang/update/{id}','cabangcontroller@update');
Route::delete('/cabang/{id}','cabangcontroller@destroy');


Route::get('/suppliers','suppliercontroller@index');
Route::get('/supplier/all','suppliercontroller@all');
Route::get('/supplier/{id}','suppliercontroller@show');
Route::get('/supplier/showByName/{nama_supplier}','suppliercontroller@showByName');
Route::post('/supplier/store','suppliercontroller@store');
Route::put('/supplier/update/{id}','suppliercontroller@update');
Route::delete('/supplier/{id}','suppliercontroller@destroy');

Route::get('/mobile/supplier','suppliercontroller@indexMobile');
Route::post('/mobile/supplier/store','suppliercontroller@storeMobile');
Route::put('/mobile/supplier/update/{id}','suppliercontroller@updateMobile');


Route::get('/sparepart','sparepartcontroller@index');
Route::get('/sparepart/all','sparepartcontroller@all');
Route::get('/sparepart/{id}','sparepartcontroller@show');
Route::get('/sparepart/showByName/{nama_sparepart}','sparepartcontroller@showByName');
Route::post('/sparepart/store','sparepartcontroller@store');
Route::put('/sparepart/update/{id}','sparepartcontroller@update');
Route::delete('/sparepart/{id}','sparepartcontroller@destroy');

Route::get('/mobile/sparepart/','sparepartcontroller@indexMobile');
Route::post('/mobile/sparepart/store','sparepartcontroller@storeMobile');
Route::post('/mobile/sparepart/update/{id}','sparepartcontroller@updateMobile');
Route::post('/mobile/sparepart/update_nonimg/{id}','sparepartcontroller@updateMobileNonImage');
Route::get('/mobile/sparepart/cek_stok','sparepartcontroller@cekJumlahStok');


Route::get('/pelanggan','pelanggancontroller@index');
Route::get('/pelanggan/all','pelanggancontroller@all');
Route::get('/pelanggan/{id}','pelanggancontroller@show');
Route::get('/pelanggan/showByNo/{no_telp_pelanggan}','pelanggancontroller@showByNo');
Route::get('/pelanggan/search', 'pelanggancontroller@search');
Route::post('/pelanggan/store','pelanggancontroller@store');
Route::put('/pelanggan/update/{id}','pelanggancontroller@update');
Route::delete('/pelanggan/{id}','pelanggancontroller@destroy');

Route::get('/mobile/pelanggan','pelanggancontroller@indexMobile');
Route::post('/mobile/pelanggan/login', 'pelanggancontroller@login');


Route::get('/kendaraan','kendaraancontroller@index');
Route::get('/kendaraan/all','kendaraancontroller@all');
Route::get('/kendaraan/{id}','kendaraancontroller@show');
Route::get('/kendaraan/showByMerk/{merk_kendaraan}','kendaraancontroller@showByMerk');
Route::post('/kendaraan/store','kendaraancontroller@store');
Route::put('/kendaraan/update/{id}','kendaraancontroller@update');
Route::delete('/kendaraan/{id}','kendaraancontroller@destroy');

Route::get('/mobile/kendaraan','kendaraancontroller@indexMobile');



//////////////////////////////////////////////////////////////////////////////////Trans Penjualan
Route::get('/trans_penjualan', 'transpenjualancontroller@index');
Route::get('/trans_penjualan/all','transpenjualancontroller@all');
Route::get('/trans_penjualan/showDetailJasa/{id}','transpenjualancontroller@showDetailJasa');
Route::get('/trans_penjualan/showDetailSparepart/{id}','transpenjualancontroller@showDetailSparepart');
Route::get('/trans_penjualan/SPK/{id}','transpenjualancontroller@show');
Route::post('/trans_penjualan/store','transpenjualancontroller@store');
Route::put('/trans_penjualan/update/{id}','transpenjualancontroller@update');
Route::put('/trans_penjualan/pembayaran/{id}','transpenjualancontroller@pembayaranWeb');
Route::delete('/trans_penjualan/{id}','transpenjualancontroller@destroy');

Route::get('/mobile/trans_penjualan', 'transpenjualancontroller@indexMobile');
Route::post('/mobile/trans_penjualan/pekerjaan/{id}', 'transpenjualancontroller@pekerjaanSelesai');
Route::post('/mobile/trans_penjualan/pembayaran/{id}', 'transpenjualancontroller@pembayaranSelesai');
Route::post('/mobile/trans_penjualan/store','transpenjualancontroller@storeMobile');
Route::put('/mobile/trans_penjualan/update/{id}','transpenjualancontroller@updateMobile');
Route::delete('/mobile/trans_penjualan/delete/{id}','transpenjualancontroller@destroyMobile');
Route::get('/mobile/trans_penjualan/getHistoryById/{id}', 'transpenjualancontroller@getHistoryById');
Route::get('/mobile/trans_penjualan/getStatusById/{id}', 'transpenjualancontroller@getStatusById');

//////////////////////////////////////////////////////////////////////////////////DETAIL TRANS PENJUALAN
Route::get('/trans_penjualan/detail_jasa', 'detailTransPenjualanJasaController@index');
Route::get('/trans_penjualan/detail_jasa/all','detailTransPenjualanJasaController@all');
Route::get('/trans_penjualan/detail_jasa/{id}','detailTransPenjualanJasaController@show');
Route::post('/trans_penjualan/detail_jasa/store','detailTransPenjualanJasaController@store');
Route::put('/trans_penjualan/detail_jasa/update/{id}','detailTransPenjualanJasaController@update');
Route::delete('/trans_penjualan/detail_jasa/{id}','detailTransPenjualanJasaController@destroy');

Route::get('/trans_penjualan/detail_spare', 'detailTransPenjualanSpareController@index');
Route::get('/trans_penjualan/detail_spare/all','detailTransPenjualanSpareController@all');
Route::get('/trans_penjualan/detail_spare/{id}','detailTransPenjualanSpareController@show');
Route::post('/trans_penjualan/detail_spare/store','detailTransPenjualanSpareController@store');
Route::put('/trans_penjualan/detail_spare/update/{id}','detailTransPenjualanSpareController@update');
Route::delete('/trans_penjualan/detail_spare/{id}','detailTransPenjualanSpareController@destroy');



Route::get('/mobile/trans_penjualan/detail_jasa', 'detailTransPenjualanJasaController@indexMobile');
Route::post('/mobile/trans_penjualan/detail_jasa/store', 'detailTransPenjualanJasaController@storeMobile');
Route::delete('/mobile/trans_penjualan/detail_jasa/delete/{id}', 'detailTransPenjualanJasaController@destroyMobile');
Route::put('/mobile/trans_penjualan/detail_jasa/update/{id}', 'detailTransPenjualanJasaController@updateMobile');

Route::get('/mobile/trans_penjualan/detail_spare','detailTransPenjualanSpareController@indexMobile');
Route::post('/mobile/trans_penjualan/detail_spare/store','detailTransPenjualanSpareController@storeMobile');
Route::delete('/mobile/trans_penjualan/detail_spare/delete/{id}', 'detailTransPenjualanSpareController@destroyMobile');
Route::put('/mobile/trans_penjualan/detail_spare/update/{id}', 'detailTransPenjualanSpareController@updateMobile');

/////////////////////////////////////////////////////////////////////////////////////////////Trans Pengadaan
Route::get('/trans_pengadaan', 'transpengadaancontroller@index');
Route::get('/trans_pengadaan/all','transpengadaancontroller@all');
Route::get('/trans_pengadaan/showDetail/{id}','transpengadaancontroller@showDetail');
Route::get('/trans_pengadaan/{id}','transpengadaancontroller@show');
Route::post('/trans_pengadaan/store','transpengadaancontroller@store');
Route::put('/trans_pengadaan/update/{id}','transpengadaancontroller@update');
Route::put('/trans_pengadaan/konfirmasi/{id}','transpengadaancontroller@konfirmasiPengiriman');
Route::delete('/trans_pengadaan/{id}','transpengadaancontroller@destroy');

Route::get('/mobile/trans_pengadaan', 'transpengadaancontroller@indexMobile');
Route::post('/mobile/trans_pengadaan/store','transpengadaancontroller@storeMobile');
Route::put('/mobile/trans_pengadaan/update/{id}','transpengadaancontroller@updateMobile');
Route::delete('/mobile/trans_pengadaan/{id}','transpengadaancontroller@destroyMobile');

/////////////////////////////////////////////////////////////////////////////////////////////Detail Trans Pengadaan
Route::get('/detail_trans_pengadaan', 'detailpengadaancontroller@index');
//Route::get('/detail_trans_pengadaan/all','detailpengadaancontroller@all');
Route::get('/detail_trans_pengadaan/{id}','detailpengadaancontroller@show');
Route::post('/detail_trans_pengadaan/store','detailpengadaancontroller@store');
Route::put('/detail_trans_pengadaan/update/{id}','detailpengadaancontroller@update');
Route::delete('/detail_trans_pengadaan/{id}','detailpengadaancontroller@destroy');

Route::get('/mobile/trans_pengadaan/detail', 'detailpengadaancontroller@indexMobile');
Route::post('/mobile/trans_pengadaan/detail/store','detailpengadaancontroller@storeMobile');
Route::put('/mobile/trans_pengadaan/detail/update/{id}','detailpengadaancontroller@updateMobile');
Route::delete('/mobile/trans_pengadaan/detail/{id}','detailpengadaancontroller@destroyMobile');

/////////////////////////////////////////////////////////////////////////////////////////////REPORT
Route::get('/report/pendapatan_bulanan/', 'reportController@pendapatan_bul');
Route::get('/report/pengeluaran_bulanan', 'reportController@pengeluaran_bul');
Route::get('/report/spare_terlaris/', 'reportController@spare_terlaris');
Route::get('/report/jumlah_jasa_permotor/', 'reportController@jumlah_jasa_perMotor');
Route::get('/report/sisa_stok_bulanan', 'reportController@sisa_stok_bulanan');
Route::get('/report/tahunan_percabang', 'reportController@tahunan_perCabang');