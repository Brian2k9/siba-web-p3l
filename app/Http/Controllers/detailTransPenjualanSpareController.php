<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\sparepart;
use App\detail_trans_sparepart;
use App\trans_penjualan;

class detailTransPenjualanSpareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    ////////////////////////////////////////////////////////////////////////////////

    public function indexMobile() {
        $detail_trans_spare = detail_trans_sparepart::all();

        return response()->json($detail_trans_spare, 200);
    }

    public function storeMobile(Request $request)
    {

        $transpenjualan = trans_penjualan::where('id', $request->id_trans_penjualan)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan not found', 404);
        }

        $sparepart = sparepart::where('id', $request->id_sparepart)->first();

        if(is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }

         $detailTransSpare = new detail_trans_sparepart;
         $detailTransSpare->id_trans_penjualan = $request->id_trans_penjualan;
         $detailTransSpare->id_sparepart = $request->id_sparepart;
         $detailTransSpare->jumlah_barang = $request->jumlah_barang;

         $detailTransSpare->total_harga_spare = 
         $request->jumlah_barang * $sparepart->harga_jual_sparepart;

         $transpenjualan->total_harga_trans = 
         $transpenjualan->total_harga_trans + $detailTransSpare->total_harga_spare;
         
         $success_trans = $transpenjualan->save();
         $success_detail = $detailTransSpare->save();

        if (!$success_detail && !$success_trans) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }
}
