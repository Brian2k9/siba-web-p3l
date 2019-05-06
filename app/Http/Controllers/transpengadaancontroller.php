<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trans_pengadaan;
use App\detail_trans_pengadaan;


class transpengadaancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transpengadaans = trans_pengadaan::with('supplier','cabang')->paginate(10);

        return response()->json($transpengadaans, 200);
    }

    public function all()
    {
        $transpengadaans = trans_pengadaan::all();

        return response()->json($transpengadaans, 200);
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
        $v = Validator::make($request->all(),[
            'id_supplier' => 'exists:suppliers,id',
            'id_cabang' => 'exists:cabangs,id'
         ]);
 
         if($v->fails()) {
             return response()->json([
                 'status' => 'error',
                 'errors' => $v->errors()
             ], 404);
         }

        //  $request->validate([
        //     'id_trans_pengadaan' => 'nullable',
            
        // ]);

        // $transpengadaan = new trans_pengadaan;
        // $transpengadaan->id_supplier = $request->id_supplier;
        // $transpengadaan->id_cabang = $request->id_cabang;
        // $transpengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
        // $transpengadaan->total_harga_pengadaan = 0;

        // $detailTransPengadaan = new detail_trans_pengadaan;
        // $detailTransPengadaan->id_trans_pengadaan = $transpengadaan->id;
        // $detailTransPengadaan->id_sparepart = $request->id_sparepart;
        // $detailTransPengadaan->jumlah_pengadaan = $request->jumlah_pengadaan;

       

        // $success_detail = $detailTransPengadaan->save();
        // $success_trans = $transpengadaan->save();

        // //$success = $transpengadaan->save();

        // if (!$success_detail && !$success_trans ) {
        //     return response()->json('Error Saving', 500);
        // } else {
        //     return response()->json('Success', 200);
        // }

        $transpengadaan = trans_pengadaan::create([            
            'id_supplier' => $request->id_supplier,            
            'id_cabang' => $request->id_cabang,
            'tanggal_pengadaan' => $request->tanggal_pengadaan,
            'total_harga_pengadaan' => 0,           
        ]);
        
        //create detail pengadaan
        detail_trans_pengadaan::create([
            'id_trans_pengadaan' => $transpengadaan->id,
            'id_sparepart' => $request->id_sparepart,
            'jumlah_pengadaan' => $request->jumlah_pengadaan,
        ]);
        return response()->json([
            'status' => (bool) $transpengadaan,
            'data'   => $transpengadaan,
            'message' => $transpengadaan ? ' Pengadaan Sparepart Berhasil' : 'Pengadaan Sparepart gagal'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = trans_pengadaan::find($id);

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
        $transpengadaans = trans_pengadaan::find($id);

        if(is_null($transpengadaans)) {
            return response()->json('Transaksi Pengadaan Not Found', 404);
        }
        
        else {
            $success = $transpengadaans->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
