<?php

use Illuminate\Http\Request;

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
Route::get('/jasa_service/{id}','jasaservicecontroller@show');
Route::get('/jasa_service/search','jasaservicecontroller@search');
Route::post('/jasa_service/store','jasaservicecontroller@store');
Route::put('/jasa_service/update/{id}','jasaservicecontroller@update');
Route::delete('/jasa_service/{id}','jasaservicecontroller@destroy');

Route::get('/jasa_service/mobile','jasaservicecontroller@indexMobile');


Route::get('/role','rolecontroller@index');
Route::get('/role/all','rolecontroller@all');
Route::get('/role/{id}','rolecontroller@show');
Route::get('/role/showByName/{nama_role}','rolecontroller@showByName');
Route::post('/role/store','rolecontroller@store');
Route::put('/role/update/{id}','rolecontroller@update');
Route::delete('/role/{id}','rolecontroller@destroy');


Route::get('/pegawai','pegawaicontroller@index');
Route::get('/pegawai/{id}','pegawaicontroller@show');
Route::get('/pegawai/showByName/{nama_pegawai}','pegawaicontroller@showByName');
Route::post('/pegawai/store','pegawaicontroller@store');
Route::put('/pegawai/update/{id}','pegawaicontroller@update');
Route::delete('/pegawai/{id}','pegawaicontroller@destroy');
Route::post('/pegawai/login','pegawaicontroller@login');

Route::get('/pegawai/mobile','pegawaicontroller@indexMobile');


Route::get('/cabang','cabangcontroller@index');
Route::get('/cabang/all','cabangcontroller@all');
Route::get('/cabang/{id}','cabangcontroller@show');
Route::get('/cabang/showByName/{nama_cabang}','cabangcontroller@showByName');
Route::post('/cabang/store','cabangcontroller@store');
Route::put('/cabang/update/{id}','cabangcontroller@update');
Route::delete('/cabang/{id}','cabangcontroller@destroy');


Route::get('/suppliers','suppliercontroller@index');
Route::get('/supplier/{id}','suppliercontroller@show');
Route::get('/supplier/showByName/{nama_supplier}','suppliercontroller@showByName');
Route::post('/supplier/store','suppliercontroller@store');
Route::put('/supplier/update/{id}','suppliercontroller@update');
Route::delete('/supplier/{id}','suppliercontroller@destroy');

Route::get('/suppliers/mobile','suppliercontroller@indexMobile');


Route::get('/sparepart','sparepartcontroller@index');
Route::get('/sparepart/{id}','sparepartcontroller@show');
Route::get('/sparepart/showByName/{nama_sparepart}','sparepartcontroller@showByName');
Route::post('sparepart/store','sparepartcontroller@store');
Route::put('/sparepart/update/{id}','sparepartcontroller@update');
Route::delete('/sparepart/{id}','sparepartcontroller@destroy');

Route::get('/sparepart/mobile','sparepartcontroller@indexMobile');
Route::post('/sparepart/mobile/store','sparepartcontroller@storeMobile');
Route::post('/sparepart/mobile/update/{id}','sparepartcontroller@updateMobile');


Route::get('/pelanggan','pelanggancontroller@index');
Route::get('/pelanggan/all','pelanggancontroller@all');
Route::get('/pelanggan/{id}','pelanggancontroller@show');
Route::get('/pelanggan/showByNo/{no_telp_pelanggan}','pelanggancontroller@showByNo');
Route::get('/pelanggan/search', 'pelanggancontroller@search');
Route::post('pelanggan/store','pelanggancontroller@store');
Route::put('/pelanggan/update/{id}','pelanggancontroller@update');
Route::delete('/pelanggan/{id}','pelanggancontroller@destroy');


Route::get('/kendaraan','kendaraancontroller@index');
Route::get('/kendaraan/{id}','kendaraancontroller@show');
Route::get('/kendaraan/showByMerk/{merk_kendaraan}','kendaraancontroller@showByMerk');
Route::post('kendaraan/store','kendaraancontroller@store');
Route::put('/kendaraan/update/{id}','kendaraancontroller@update');
Route::delete('/kendaraan/{id}','kendaraancontroller@destroy');

Route::get('/kendaraan/mobile','kendaraancontroller@indexMobile');



//////////////////////////////////////////////////////////////////////////////////Trans Penjualan
Route::get('/trans_penjualan', 'transpenjualancontroller@index');
Route::post('trans_penjualan/store','transpenjualancontroller@store');
Route::delete('/trans_penjualan/{id}','transpenjualancontroller@destroy');

Route::get('/trans_penjualan/mobile', 'transpenjualancontroller@indexMobile');
Route::post('/trans_penjualan/mobile/store','transpenjualancontroller@storeMobile');
Route::delete('/trans_penjualan/mobile/delete/{id}','transpenjualancontroller@destroyMobile');

//////////////////////////////////////////////////////////////////////////////////DETAIL TRANS PENJUALAN
Route::get('/trans_penjualan/detail_jasa/mobile', 'detailTransPenjualanJasaController@indexMobile');
Route::post('/trans_penjualan/detail_jasa/mobile/store', 'detailTransPenjualanJasaController@storeMobile');
Route::delete('/trans_penjualan/detail_jasa/mobile/delete/{id}', 'detailTransPenjualanJasaController@destroyMobile');
Route::put('/trans_penjualan/detail_jasa/mobile/update/{id}', 'detailTransPenjualanJasaController@updateMobile');

Route::get('trans_penjualan/detail_spare/mobile','detailTransPenjualanSpareController@indexMobile');
Route::post('/trans_penjualan/detail_spare/mobile/store','detailTransPenjualanSpareController@storeMobile');
Route::delete('/trans_penjualan/detail_spare/mobile/delete/{id}', 'detailTransPenjualanSpareController@destroyMobile');
Route::put('/trans_penjualan/detail_spare/mobile/update/{id}', 'detailTransPenjualanSpareController@updateMobile');