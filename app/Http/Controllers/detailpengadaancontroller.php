<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\detail_trans_pengadaan;
use App\trans_pengadaan;
use App\sparepart;

class detailpengadaancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $detailTransPengadaan = detail_trans_pengadaan::with('trans_pengadaan','sparepart')->paginate(10);

        return response()->json($detailTransPengadaan, 200);
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
        $transpengadaan = trans_pengadaan::where('id', $request->id_trans_pengadaan)->first();

        if(is_null($transpengadaan)) {
            return response()->json('Transaksi Pengadaan not found', 404);
        }

        $sparepart = sparepart::where('id', $request->id_sparepart)->first();

        if(is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }

        $detailTransPengadaan = new detail_trans_pengadaan;
        $detailTransPengadaan->id_trans_pengadaan = $request->id_trans_pengadaan;
        $detailTransPengadaan->id_sparepart = $request->id_sparepart;
        $detailTransPengadaan->jumlah_pengadaan = $request->jumlah_pengadaan;
        
        $transpengadaan->total_harga_pengadaan = 
        $transpengadaan->total_harga_pengadaan + ($detailTransPengadaan->jumlah_pengadaan * $sparepart->harga_beli_sparepart);

        $success_trans = $transpengadaan->save();
        $success_detail = $detailTransPengadaan->save();

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
        $result = detail_trans_pengadaan::find($id);

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
        $detailTransPengadaan = detail_trans_pengadaan::find($id);

        if(is_null($detailTransPengadaan)) {
            return response()->json('Detail Transaksi Pengadaan Not Found', 404);
        }
        
        else {
            $success = $detailTransPengadaan->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
