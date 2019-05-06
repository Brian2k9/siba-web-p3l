<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\detail_trans_jasa;
use App\trans_penjualan;
use App\jasa_service;

class detailTransPenjualanJasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailTransJasas = detail_trans_jasa::with('trans_penjualan','jasa_service','pegawai','kendaraan')->paginate(10);
        return response()->json($detailTransJasas, 200);
    }

    public function all()
    {
        $detailTransJasas = detail_trans_jasa::all();

        return response()->json($detailTransJasas, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $transpenjualan = trans_penjualan::where('id', $request->id_trans_penjualan)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan not found', 404);
        }

        $jasa_service = jasa_service::where('id', $request->id_jasa)->first();

        if(is_null($jasa_service)) {
            return response()->json('Jasa Service not found', 404);
        }

        $v = Validator::make($request->all(),[
            'id_pegawai' => 'exists:pegawais,id',
            'id_kendaraan' => 'exists:kendaraans,id'
         ]);
 
         if($v->fails()) {
             return response()->json([
                 'status' => 'error',
                 'errors' => $v->errors()
             ], 404);
         }

         $detailTransJasa = new detail_trans_jasa;
         $detailTransJasa->id_trans_penjualan = $request->id_trans_penjualan;
         $detailTransJasa->id_jasa = $request->id_jasa;
         $detailTransJasa->id_pegawai = $request->id_pegawai;
         $detailTransJasa->id_kendaraan = $request->id_kendaraan;
         $detailTransJasa->jumlah_jasa = $request->jumlah_jasa;

         $detailTransJasa->total_harga_jasa = $request->jumlah_jasa * $jasa_service->harga_jasa;

         $transpenjualan->total_harga_trans = 
         $transpenjualan->total_harga_trans + $detailTransJasa->total_harga_jasa;
         
         $success_trans = $transpenjualan->save();
         $success_detail = $detailTransJasa->save();

        if (!$success_detail && !$success_trans) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = detail_trans_jasa::find($id);

        if (is_null($result)) {
            return response()->json('Not Found', 404);
        } else
            return response()->json($result, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $detailTransJasa = detail_trans_jasa::find($id);

        if(is_null($detailTransJasa)) {
            return response()->json('Detail Transaksi Jasa Penjualan Not Found', 404);
        }
        
        else {

            $transpenjualan = trans_penjualan::where('id', $detailTransJasa->id_trans_penjualan)->first();

            if(is_null($transpenjualan)) {
                return response()->json('Transaksi Penjualan not found', 404);
            }

            $jasa_service = jasa_service::where('id', $detailTransJasa->id_jasa)->first();

            if(is_null($jasa_service)) {
                return response()->json('Jasa Service not found', 404);
            }

            //pengurangan harga total harga transaksi
            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransJasa->total_harga_jasa;

            //input data baru
            $detailTransJasa->id_trans_penjualan = $request->id_trans_penjualan;
            $detailTransJasa->id_jasa = $request->id_jasa;
            $detailTransJasa->id_pegawai = $request->id_pegawai;
            $detailTransJasa->id_kendaraan = $request->id_kendaraan;
            $detailTransJasa->jumlah_jasa = $request->jumlah_jasa;

            $detailTransJasa->total_harga_jasa = $request->jumlah_jasa * $jasa_service->harga_jasa;

            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans + $detailTransJasa->total_harga_jasa;
            
            $success_trans = $transpenjualan->save();
            $success_detail = $detailTransJasa->save();

            if($success_detail && $success_trans)
                return response()->json('Success Update', 200);
            else {
                return response()->json('Error Update', 500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailTransJasa = detail_trans_jasa::find($id);

        if(is_null($detailTransJasa)) {
            return response()->json('Detail Transaksi Jasa Penjualan Not Found', 404);
        }
        
        else {

            $transpenjualan = trans_penjualan::where('id', $detailTransJasa->id_trans_penjualan)->first();

            if(is_null($transpenjualan)) {
                return response()->json('Transaksi Penjualan not found', 404);
            }

            $jasa_service = jasa_service::where('id', $detailTransJasa->id_jasa)->first();

            if(is_null($jasa_service)) {
                return response()->json('Jasa Service not found', 404);
            }

            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransJasa->total_harga_jasa;
            
            $success_trans = $transpenjualan->save();

            $success_detail = $detailTransJasa->delete();
            if($success_detail && $success_trans)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }

    //////////////////////////////////////////////////////////////MOBILE

    public function indexMobile() {
        $detail_trans_jasa = detail_trans_jasa::all();

        return response()->json($detail_trans_jasa, 200);
    }

    public function storeMobile(Request $request)
    {

        $transpenjualan = trans_penjualan::where('id', $request->id_trans_penjualan)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan not found', 404);
        }

        $jasa_service = jasa_service::where('id', $request->id_jasa)->first();

        if(is_null($jasa_service)) {
            return response()->json('Jasa Service not found', 404);
        }

        $v = Validator::make($request->all(),[
            'id_pegawai' => 'exists:pegawais,id',
            'id_kendaraan' => 'exists:kendaraans,id'
         ]);
 
         if($v->fails()) {
             return response()->json([
                 'status' => 'error',
                 'errors' => $v->errors()
             ], 404);
         }

         $detailTransJasa = new detail_trans_jasa;
         $detailTransJasa->id_trans_penjualan = $request->id_trans_penjualan;
         $detailTransJasa->id_jasa = $request->id_jasa;
         $detailTransJasa->id_pegawai = $request->id_pegawai;
         $detailTransJasa->id_kendaraan = $request->id_kendaraan;
         $detailTransJasa->jumlah_jasa = $request->jumlah_jasa;

         $detailTransJasa->total_harga_jasa = $request->jumlah_jasa * $jasa_service->harga_jasa;

         $transpenjualan->total_harga_trans = 
         $transpenjualan->total_harga_trans + $detailTransJasa->total_harga_jasa;
         
         $success_trans = $transpenjualan->save();
         $success_detail = $detailTransJasa->save();

        if (!$success_detail && !$success_trans) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }

    public function updateMobile(Request $request, $id)
    {
        $detailTransJasa = detail_trans_jasa::find($id);

        if(is_null($detailTransJasa)) {
            return response()->json('Detail Transaksi Jasa Penjualan Not Found', 404);
        }
        
        else {

            $transpenjualan = trans_penjualan::where('id', $request->id_trans_penjualan)->first();

            if(is_null($transpenjualan)) {
                return response()->json('Transaksi Penjualan not found', 404);
            }

            $jasa_service = jasa_service::where('id', $request->id_jasa)->first();

            if(is_null($jasa_service)) {
                return response()->json('Jasa Service not found', 404);
            }

            //pengurangan harga total harga transaksi
            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransJasa->total_harga_jasa;

            //input data baru
            $detailTransJasa->id_trans_penjualan = $request->id_trans_penjualan;
            $detailTransJasa->id_jasa = $request->id_jasa;
            $detailTransJasa->id_pegawai = $request->id_pegawai;
            $detailTransJasa->id_kendaraan = $request->id_kendaraan;
            $detailTransJasa->jumlah_jasa = $request->jumlah_jasa;

            $detailTransJasa->total_harga_jasa = $request->jumlah_jasa * $jasa_service->harga_jasa;

            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans + $detailTransJasa->total_harga_jasa;
            
            $success_trans = $transpenjualan->save();
            $success_detail = $detailTransJasa->save();

            if($success_detail && $success_trans)
                return response()->json('Success Update', 200);
            else {
                return response()->json('Error Update', 500);
            }
        }
    }

    public function destroyMobile($id)
    {
        $detailTransJasa = detail_trans_jasa::find($id);

        if(is_null($detailTransJasa)) {
            return response()->json('Detail Transaksi Jasa Penjualan Not Found', 404);
        }
        
        else {

            $transpenjualan = trans_penjualan::where('id', $detailTransJasa->id_trans_penjualan)->first();

            if(is_null($transpenjualan)) {
                return response()->json('Transaksi Penjualan not found', 404);
            }

            $jasa_service = jasa_service::where('id', $detailTransJasa->id_jasa)->first();

            if(is_null($jasa_service)) {
                return response()->json('Jasa Service not found', 404);
            }

            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransJasa->total_harga_jasa;
            
            $success_trans = $transpenjualan->save();

            $success_detail = $detailTransJasa->delete();
            if($success_detail && $success_trans)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
