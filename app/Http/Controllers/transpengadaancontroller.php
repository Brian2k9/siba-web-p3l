<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\trans_pengadaan;
use App\detail_trans_pengadaan;
use App\sparepart;


class transpengadaancontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transpengadaans = trans_pengadaan::with('supplier','cabang')->paginate(100);

        return response()->json($transpengadaans, 200);
    }

    public function all()
    {
        $transpengadaans = trans_pengadaan::all();

        return response()->json($transpengadaans, 200);
    }

    public function showDetail($id)
    {
        $transpengadaans = detail_trans_pengadaan::where('id_trans_pengadaan', $id)
        ->with('trans_pengadaan','sparepart')->get();

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

        $transpengadaan = new trans_pengadaan;
        $transpengadaan->id_supplier = $request->id_supplier;
        $transpengadaan->id_cabang = $request->id_cabang;
        $transpengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
        $transpengadaan->total_harga_pengadaan = 0;
        $transpengadaan->status_pengadaan = "belum";

        // $detailTransPengadaan = new detail_trans_pengadaan;
        // $detailTransPengadaan->id_trans_pengadaan = $transpengadaan->id;
        // $detailTransPengadaan->id_sparepart = $request->id_sparepart;
        // $detailTransPengadaan->jumlah_pengadaan = $request->jumlah_pengadaan;

       

        //$success_detail = $detailTransPengadaan->save();
        $success = $transpengadaan->save();

        //$success = $transpengadaan->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 200);
        }

        // $sparepart = sparepart::where('id', $request->id_sparepart)->first();

        // if(is_null($sparepart)) {
        //     return response()->json('Sparepart not found', 404);
        // }

        // $transpengadaan = trans_pengadaan::create([            
        //     'id_supplier' => $request->id_supplier,            
        //     'id_cabang' => $request->id_cabang,
        //     'tanggal_pengadaan' => $request->tanggal_pengadaan,
        //     'total_harga_pengadaan' => $request->jumlah_pengadaan * $sparepart->harga_beli_sparepart           
        // ]);
        
        // //create detail pengadaan
        // detail_trans_pengadaan::create([
        //     'id_trans_pengadaan' => $transpengadaan->id,
        //     'id_sparepart' => $request->id_sparepart,
        //     'jumlah_pengadaan' => $request->jumlah_pengadaan
        // ]);
        // return response()->json([
        //     'status' => (bool) $transpengadaan,
        //     'data'   => $transpengadaan,
        //     'message' => $transpengadaan ? ' Pengadaan Sparepart Berhasil' : 'Pengadaan Sparepart gagal'
        // ]);
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
        $transpengadaan = trans_pengadaan::where('id', $id)->first();
        if (is_null($transpengadaan)) {
            return response()->json('Transaksi pengadaan not found', 404);
        }
        else {
            if($transpengadaan->status_pengadaan == "sudah diterima") {
                return response()->json('Transaksi pengadaan sudah selesai', 500);
            }
            else{
                $transpengadaan->id_supplier = $request->id_supplier;
                $transpengadaan->id_cabang = $request->id_cabang;
                $transpengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
                $transpengadaan->status_pengadaan = $request->status_pengadaan;
                
                $success = $transpengadaan->save();
                if (!$success) {
                    return response()->json('Error Updating', 500);
                } else {
                    return response()->json('Success Updating', 200);
                }
            }
            
        }

        
        
    }
    

    public function konfirmasiPengiriman(Request $request, $id)
    {
        $transpengadaan = trans_pengadaan::where('id', $id)->first();
        if (is_null($transpengadaan)) {
            return response()->json('Transaksi pengadaan not found', 404);
        }
        else {
            if($transpengadaan->status_pengadaan == "belum") {
                return response()->json('Barang belum dikirim', 500);
            }
            else{
               
                $transpengadaan->status_pengadaan = "sudah diterima";
                
                //function untuk penambahan stok sparepart
                $results = detail_trans_pengadaan::where('id_trans_pengadaan', $id)->get();
                foreach($results as $result) {
                    $sparepart = sparepart::find($result->id_sparepart);
                    if(is_null($sparepart)) {
                        return response()->json('Sparepart not found', 404);
                    }
                    $sparepart->jumlah_stok_sparepart = 
                    $sparepart->jumlah_stok_sparepart + $result->jumlah_pengadaan;
                    $success_sparepart = $sparepart->save();
                }
               
                $success_trans = $transpengadaan->save();
            
                
                if (!$success_sparepart && !$success_trans) {
                    return response()->json('Error Updating', 500);
                } else {
                    return response()->json('Success Updating', 200);
                }
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

    /////////////////////////////////////////////////////////////////////////MOBILE

    public function indexMobile() {
        $transpengadaans = trans_pengadaan::
        select('trans_pengadaan.*', 'suppliers.nama_supplier', 'suppliers.no_telp_supplier'
        ,'suppliers.alamat_supplier','cabangs.nama_cabang', 'cabangs.no_telp_cabang'
        ,'cabangs.alamat_cabang')
        ->join('suppliers', 'suppliers.id', 'trans_pengadaan.id_supplier')
        ->join('cabangs', 'cabangs.id', 'trans_pengadaan.id_cabang')
        ->latest('trans_pengadaan.created_at')
        ->get();

        return response()->json($transpengadaans, 200);
    }


    public function storeMobile(Request $request)
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

        $transpengadaan = new trans_pengadaan();
        $transpengadaan->id_supplier = $request->id_supplier;
        $transpengadaan->id_cabang = $request->id_cabang;
        $transpengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
        $transpengadaan->total_harga_pengadaan = 0;
        $transpengadaan->status_pengadaan = "belum";

        $success = $transpengadaan->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json($transpengadaan, 200);
        }
    }

    public function updateMobile(Request $request, $id)
    {
        $transpengadaan = trans_pengadaan::where('id', $id)->first();

        if (is_null($transpengadaan)) {
            return response()->json('Transaksi pengadaan not found', 404);
        }

        else {
            $transpengadaan->id_supplier = $request->id_supplier;
            $transpengadaan->id_cabang = $request->id_cabang;
            $transpengadaan->tanggal_pengadaan = $request->tanggal_pengadaan;
            
            $success = $transpengadaan->save();

            if (!$success) {
                return response()->json('Error Updating', 500);
            } else {
                return response()->json('Success Updating', 200);
            }
        }
    }

    public function barang_datang($id) {
        $transpengadaan = trans_pengadaan::where('id', $id)->first();

        if (is_null($transpengadaan)) {
            return response()->json('Transaksi pengadaan not found', 404);
        }

        //function untuk penambahan stok sparepart
        $results = detail_trans_pengadaan::where('id_trans_pengadaan', $id)->get();

        foreach($results as $result) {

            $sparepart = sparepart::find($result->id_sparepart);
            if(is_null($sparepart)) {
                return response()->json('Sparepart not found', 404);
            }

            $sparepart->jumlah_stok_sparepart = 
            $sparepart->jumlah_stok_sparepart + $result->jumlah_barang;
        }

        
            $transpengadaan->status_transaksi = "sudah";
            
            $success_pengadaan = $transpengadaan->save();
            $success_spare = $sparepart->save();

            if (!$success_pengadaan && !$success_spare) {
                return response()->json('Error Updating', 500);
            } else {
                return response()->json('Success Updating', 200);
            }
        
    }

    public function destroyMobile($id)
    {
        $transpengadaan = trans_pengadaan::find($id);

        if(is_null($transpengadaan)) {
            return response()->json('Transaksi Pengadaan Not Found', 404);
        }
        
        else {
            $success = $transpengadaan->delete();
            if($success)
                return response()->json('Success Delete', 200);
            else {
                return response()->json('Error Delete', 500);
            }
        }
    }
}
