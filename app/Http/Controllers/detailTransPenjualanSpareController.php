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
        $detailTransSpareparts = detail_trans_sparepart::with('trans_penjualan','sparepart')->paginate(100);
        return response()->json($detailTransSpareparts, 200);
    }

    public function all()
    {
        $detailTransSpareparts = detail_trans_sparepart::all();

        return response()->json($detailTransSpareparts, 200);
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
            'jumlah_barang' => 'required|numeric|not_in:0',
            
        ]);

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
        $result = detail_trans_sparepart::find($id);

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
            'jumlah_barang' => 'required|numeric|not_in:0',
            
        ]);

        $detailTransSpare = detail_trans_sparepart::find($id);

        if(is_null($detailTransSpare)) {
            return response()->json('Detail Transaksi Sparepart Penjualan Not Found', 404);
        }
        
        else {
            $transpenjualan = trans_penjualan::where('id', $request->id_trans_penjualan)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan not found', 404);
        }

        $sparepart = sparepart::where('id', $request->id_sparepart)->first();

        if(is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }

        //pengurangan harga total harga transaksi
        $transpenjualan->total_harga_trans = 
        $transpenjualan->total_harga_trans - $detailTransSpare->total_harga_spare;

        //input data baru
         //$detailTransSpare->id_trans_penjualan = $request->id_trans_penjualan;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detailTransSpare = detail_trans_sparepart::find($id);

        if(is_null($detailTransSpare)) {
            return response()->json('Detail Transaksi Sparepart Penjualan Not Found', 404);
        }
        
        else {

            $transpenjualan = trans_penjualan::where('id', $detailTransSpare->id_trans_penjualan)->first();

            if(is_null($transpenjualan)) {
                return response()->json('Transaksi Penjualan not found', 404);
            }

            $sparepart = sparepart::where('id', $detailTransSpare->id_sparepart)->first();

            if(is_null($sparepart)) {
                return response()->json('Sparepart not found', 404);
            }

            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransSpare->total_harga_spare;
            
            $success_trans = $transpenjualan->save();

            $success_detail = $detailTransSpare->delete();

            if($success_detail && $success_trans)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }

    public function penguranganStok($id_trans) {
        $results = detail_trans_sparepart::where('id_trans_penjualan', $id_trans)->get();

        foreach($results as $result) {

            $sparepart = sparepart::find($result->id_sparepart);
            if(is_null($sparepart)) {
                return response()->json('Sparepart not found', 404);
            }

            $sparepart->jumlah_stok_sparepart = 
            $sparepart->jumlah_stok_sparepart - $result->jumlah_barang;
        }

        $success = $sparepart->save();

        if($success)
                return response()->json('Success Decrease', 200);
            else {
                return response()->json('Error Decrease', 500);
            }

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

         //perhitungan total harga
         $transpenjualan->total_harga_trans = 
         $transpenjualan->total_harga_trans + $detailTransSpare->total_harga_spare;

         //perhitungan discount
         $discount = 
         $transpenjualan->total_harga_trans * ($transpenjualan->discount_penjualan / 100);

         $transpenjualan->grand_total = 
         $transpenjualan->total_harga_trans - $discount;
         
         $success_trans = $transpenjualan->save();
         $success_detail = $detailTransSpare->save();

        if (!$success_detail && !$success_trans) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }

    public function updateMobile(Request $request, $id) 
    {
        $detailTransSpare = detail_trans_sparepart::find($id);

        if(is_null($detailTransSpare)) {
            return response()->json('Detail Transaksi Sparepart Penjualan Not Found', 404);
        }
        
        else {
            $transpenjualan = trans_penjualan::where('id', $request->id_trans_penjualan)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan not found', 404);
        }

        $sparepart = sparepart::where('id', $request->id_sparepart)->first();

        if(is_null($sparepart)) {
            return response()->json('Sparepart not found', 404);
        }

            //pengurangan harga total harga transaksi
            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransSpare->total_harga_spare;

            //input data baru
         $detailTransSpare->id_trans_penjualan = $request->id_trans_penjualan;
         $detailTransSpare->id_sparepart = $request->id_sparepart;
         $detailTransSpare->jumlah_barang = $request->jumlah_barang;

         $detailTransSpare->total_harga_spare = 
         $request->jumlah_barang * $sparepart->harga_jual_sparepart;

         //perhitungan total harga
         $transpenjualan->total_harga_trans = 
         $transpenjualan->total_harga_trans + $detailTransSpare->total_harga_spare;

         //perhitungan discount
         $discount = 
         $transpenjualan->total_harga_trans * ($transpenjualan->discount_penjualan / 100);

         $transpenjualan->grand_total = 
         $transpenjualan->total_harga_trans - $discount;
         
         $success_trans = $transpenjualan->save();
         $success_detail = $detailTransSpare->save();

        if (!$success_detail && !$success_trans) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
        }
    }

    public function destroyMobile($id)
    {
        $detailTransSpare = detail_trans_sparepart::find($id);

        if(is_null($detailTransSpare)) {
            return response()->json('Detail Transaksi Sparepart Penjualan Not Found', 404);
        }
        
        else {

            $transpenjualan = trans_penjualan::where('id', $detailTransSpare->id_trans_penjualan)->first();

            if(is_null($transpenjualan)) {
                return response()->json('Transaksi Penjualan not found', 404);
            }

            $sparepart = sparepart::where('id', $detailTransSpare->id_sparepart)->first();

            if(is_null($sparepart)) {
                return response()->json('Sparepart not found', 404);
            }

            $transpenjualan->total_harga_trans = 
            $transpenjualan->total_harga_trans - $detailTransSpare->total_harga_spare;
            
            $success_trans = $transpenjualan->save();

            $success_detail = $detailTransSpare->delete();

            if($success_detail && $success_trans)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
