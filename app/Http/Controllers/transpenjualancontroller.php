<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class transpenjualancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transpenjualans = trans_penjualan::paginate(10);

        return response()->json($transpenjualans, 200);
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
        $request->validate([
            'no_plat_kendaraan' => 'required|unique:trans_penjualans,no_plat_kendaraan|max:8',
            
        ]);

        $transpenjualan = new trans_penjualan;
        $transpenjualan->id_pelanggan = $request->id_pelanggan;
        $transpenjualan->id_cabang = $request->id_cabang;
        $transpenjualan->total_harga_trans = $request->total_harga_trans;
        $transpenjualan->discount_penjualan = $request->discount_penjualan;
        $transpenjualan->grand_total = $request->grand_total;
        $transpenjualan->status_transaksi = $request->status_transaksi;
        $transpenjualan->status_pembayaran = $request->status_pembayaran;
        $transpenjualan->no_plat_kendaraan = $request->no_plat_kendaraan;
        $transpenjualan->tanggal_penjualan = $request->tanggal_penjualan;

        $success = $transpenjualan->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 201);
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
        $result = trans_penjualan::find($id);

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
        $request->validate([
            'no_plat_kendaraan' => 'required|unique:trans_penjualans,no_plat_kendaraan,'.$id.'|max:8',
            ]);

        $transpenjualan = trans_penjualan::where('id', $id)->first();

        if (is_null($transpenjualan)) {
            return response()->json('Transaksi penjualan not found', 404);
        }

        else {
            $transpenjualan->id_pelanggan = $request->id_pelanggan;
            $transpenjualan->id_cabang = $request->id_cabang;
            $transpenjualan->total_harga_trans = $request->total_harga_trans;
            $transpenjualan->discount_penjualan = $request->discount_penjualan;
            $transpenjualan->grand_total = $request->grand_total;
            $transpenjualan->status_transaksi = $request->status_transaksi;
            $transpenjualan->status_pembayaran = $request->status_pembayaran;
            $transpenjualan->no_plat_kendaraan = $request->no_plat_kendaraan;
            $transpenjualan->tanggal_penjualan = $request->tanggal_penjualan;

            $success = $transpenjualan->save();

            if (!$success) {
                return response()->json('Error Updating', 500);
            } else {
                return response()->json('Success Updating', 200);
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
        $transpenjualan = trans_penjualan::find($id);

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan Not Found', 404);
        }
        
        else {
            $success = $transpenjualan->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
