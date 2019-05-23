<?php

namespace App\Http\Controllers;

use App\trans_penjualan;
use App\sparepart;
use App\detail_trans_sparepart;
use App\detail_trans_jasa;
use Illuminate\Support\Facades\Validator;
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
        $transpenjualans = trans_penjualan::with('pelanggan','cabang')->paginate(100);

        return response()->json($transpenjualans, 200);
    }

    public function all()
    {
        $transpenjualans = trans_penjualan::all();

        return response()->json($transpenjualans, 200);
    }

    public function showDetailJasa($id)
    {
        $transpenjualans = detail_trans_jasa::where('id_trans_penjualan', $id)
        ->with('trans_penjualan','jasa_service','pegawai','kendaraan')->get();

        return response()->json($transpenjualans, 200);
    }

    public function showDetailSparepart($id)
    {
        $transpenjualans = detail_trans_sparepart::where('id_trans_penjualan', $id)
        ->with('trans_penjualan','sparepart')->get();

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
            'no_plat_kendaraan' => 'required|unique:trans_penjualan,no_plat_kendaraan|max:8',
            
        ]);

        $v = Validator::make($request->all(),[
            'id_pelanggan' => 'exists:pelanggans,id',
            'id_cabang' => 'exists:cabangs,id'
         ]);
 
         if($v->fails()) {
             return response()->json([
                 'status' => 'error',
                 'errors' => $v->errors()
             ], 404);
         }

        $transpenjualan = new trans_penjualan;
        $transpenjualan->id_pelanggan = $request->id_pelanggan;
        $transpenjualan->id_cabang = $request->id_cabang;
        $transpenjualan->total_harga_trans = 0;
        $transpenjualan->discount_penjualan = 0;
        $transpenjualan->grand_total = 0;
        $transpenjualan->status_transaksi = "belum";
        $transpenjualan->status_pembayaran = "belum";
        $transpenjualan->no_plat_kendaraan = $request->no_plat_kendaraan;
        $transpenjualan->tanggal_penjualan = $request->tanggal_penjualan;

        $success = $transpenjualan->save();

        if (!$success) {
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
            'no_plat_kendaraan' => 'required|unique:trans_penjualan,no_plat_kendaraan,'.$id.'|max:8',
            ]);

        $transpenjualan = trans_penjualan::where('id', $id)->first();

        if (is_null($transpenjualan)) {
            return response()->json('Transaksi penjualan not found', 404);
        }

        else {
            if($transpenjualan->status_pembayaran == "sudah") {
                return response()->json('Transaksi sudah selesai', 500);
            }
            else{
                $transpenjualan->id_pelanggan = $request->id_pelanggan;
                $transpenjualan->id_cabang = $request->id_cabang;
                //$transpenjualan->total_harga_trans = 0;
                //$transpenjualan->discount_penjualan = 0;
                //$transpenjualan->grand_total = 0;
                $transpenjualan->status_transaksi = $request->status_transaksi;
                //$transpenjualan->status_pembayaran = "belum";
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
    }

    public function pembayaranWeb(Request $request, $id)
    {
        $transpenjualan = trans_penjualan::where('id', $id)->first();

        if (is_null($transpenjualan)) {
            return response()->json('Transaksi penjualan not found', 404);
        }

        else {
            if($transpenjualan->status_transaksi == "belum") {
                return response()->json('Transaksi belum selesai', 500);
            }
            else{
                $transpenjualan->total_harga_trans;
                $transpenjualan->discount_penjualan = $request->discount_penjualan;

                //perhitungan discount
                $discount = 
                $transpenjualan->total_harga_trans * ($transpenjualan->discount_penjualan / 100);

                $transpenjualan->grand_total = 
                $transpenjualan->total_harga_trans - $discount;
                //$transpenjualan->grand_total = $transpenjualan->total_harga_trans - $transpenjualan->discount_penjualan ;
                //$transpenjualan->status_transaksi = $transpenjualan->status_transaksi;
                $transpenjualan->status_pembayaran = "sudah";

                //function untuk pengurangan stok sparepart
                $results = detail_trans_sparepart::where('id_trans_penjualan', $id)->get();

                foreach($results as $result) {

                    $sparepart = sparepart::find($result->id_sparepart);
                    if(is_null($sparepart)) {
                        return response()->json('Sparepart not found', 404);
                    }

                    $sparepart->jumlah_stok_sparepart = 
                    $sparepart->jumlah_stok_sparepart - $result->jumlah_barang;

                    $success_sparepart = $sparepart->save();
                }

               
                $success_trans = $transpenjualan->save();
            

                //$success = $transpenjualan->save();

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

    /////////////////////////////////////////////////////////////////////////////////////////MOBILE

    public function indexMobile()
    {
        $transpenjualans = trans_penjualan::
        select('trans_penjualan.*'
        , 'pelanggans.nama_pelanggan', 'pelanggans.alamat_pelanggan', 'pelanggans.no_telp_pelanggan'
        , 'cabangs.nama_cabang', 'cabangs.alamat_cabang', 'cabangs.no_telp_cabang')
        ->join('pelanggans', 'pelanggans.id', 'trans_penjualan.id_pelanggan')
        ->join('cabangs', 'cabangs.id', 'trans_penjualan.id_cabang')
        ->latest('trans_penjualan.created_at')
        ->get();

        return response()->json($transpenjualans, 200);
    }

    public function getHistoryById($id) {
        $transpenjualan = trans_penjualan::select('trans_penjualan.*'
        , 'pelanggans.nama_pelanggan', 'pelanggans.alamat_pelanggan', 'pelanggans.no_telp_pelanggan'
        , 'cabangs.nama_cabang', 'cabangs.alamat_cabang', 'cabangs.no_telp_cabang')
        ->join('pelanggans', 'pelanggans.id', 'trans_penjualan.id_pelanggan')
        ->join('cabangs', 'cabangs.id', 'trans_penjualan.id_cabang')
        ->latest('trans_penjualan.created_at')
        ->where('trans_penjualan.status_penjualan', 'sudah')
        ->where('trans_penjualan.status_pembayaran', 'sudah')
        ->where('pelanggans.id', $id)
        ->get();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan Not Found', 404);
        }
        
        else {
            return response()->json($transpenjualan, 200);
        }
    }

    public function getStatusById($id) {
        $transpenjualan = trans_penjualan::select('trans_penjualan.*'
        , 'pelanggans.nama_pelanggan', 'pelanggans.alamat_pelanggan', 'pelanggans.no_telp_pelanggan'
        , 'cabangs.nama_cabang', 'cabangs.alamat_cabang', 'cabangs.no_telp_cabang')
        ->join('pelanggans', 'pelanggans.id', 'trans_penjualan.id_pelanggan')
        ->join('cabangs', 'cabangs.id', 'trans_penjualan.id_cabang')
        ->latest('trans_penjualan.created_at')
        ->where('trans_penjualan.status_pembayaran', 'belum')
        ->where('pelanggans.id', $id)
        ->get();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan Not Found', 404);
        }
        
        else {
            return response()->json($transpenjualan, 200);
        }
    }

    public function storeMobile(Request $request)
    {
        $v = Validator::make($request->all(),[
            'id_pelanggan' => 'exists:pelanggans,id',
            'id_cabang' => 'exists:cabangs,id'
         ]);
 
         if($v->fails()) {
             return response()->json([
                 'status' => 'error',
                 'errors' => $v->errors()
             ], 404);
         }

        $transpenjualan = new trans_penjualan;
        $transpenjualan->id_pelanggan = $request->id_pelanggan;
        $transpenjualan->id_cabang = $request->id_cabang;
        $transpenjualan->total_harga_trans = 0;
        $transpenjualan->discount_penjualan = 0;
        $transpenjualan->grand_total = 0;
        $transpenjualan->status_transaksi = 'belum';
        $transpenjualan->status_pembayaran = 'belum';
        $transpenjualan->no_plat_kendaraan = $request->no_plat_kendaraan;
        $transpenjualan->tanggal_penjualan = $request->tanggal_penjualan;

        $success = $transpenjualan->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }

    public function updateMobile(Request $request, $id)
    {
        $request->validate([
            'no_plat_kendaraan' => 'required|unique:trans_penjualan,no_plat_kendaraan,'.$id.'|max:8',
            ]);

        $transpenjualan = trans_penjualan::where('id', $id)->first();

        if (is_null($transpenjualan)) {
            return response()->json('Transaksi penjualan not found', 404);
        }

        else {
            $transpenjualan->id_pelanggan = $request->id_pelanggan;
            $transpenjualan->id_cabang = $request->id_cabang;
            $transpenjualan->discount_penjualan = $request->discount_penjualan;
            $transpenjualan->status_transaksi = $request->status_transaksi;
            $transpenjualan->no_plat_kendaraan = $request->no_plat_kendaraan;
            $transpenjualan->tanggal_penjualan = $request->tanggal_penjualan;
            
        //perhitungan discount
        $discount = 
        $transpenjualan->total_harga_trans * ($transpenjualan->discount_penjualan / 100);

        $transpenjualan->grand_total = 
        $transpenjualan->total_harga_trans - $discount;

            $success = $transpenjualan->save();

            if (!$success) {
                return response()->json('Error Updating', 500);
            } else {
                return response()->json('Success Updating', 200);
            }
        }
    }

    public function destroyMobile($id)
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

    public function pekerjaanSelesai($id) {
        $transpenjualan = trans_penjualan::where('id', $id)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan Not Found', 404);
        }
        
        else {
            $transpenjualan->status_transaksi = "sudah";
        }

        $success = $transpenjualan->save();

        if (!$success) {
            return response()->json('Error Saving', 500);
        } else {
            return response()->json('Success', 204);
        }
    }

    public function pembayaranSelesai($id) {
        $transpenjualan = trans_penjualan::where('id', $id)->first();

        if(is_null($transpenjualan)) {
            return response()->json('Transaksi Penjualan Not Found', 404);
        }
        
        else {
            if($transpenjualan->status_pembayaran == "sudah") {
                return response()->json('Transaksi sudah dibayar', 200);
            }

            $transpenjualan->status_transaksi = "sudah";
            $transpenjualan->status_pembayaran = "sudah";

            //function untuk pengurangan stok sparepart
            $results = detail_trans_sparepart::where('id_trans_penjualan', $id)->get();

            foreach($results as $result) {

                $sparepart = sparepart::find($result->id_sparepart);
                if(is_null($sparepart)) {
                    return response()->json('Sparepart not found', 404);
                }

                $sparepart->jumlah_stok_sparepart = 
                $sparepart->jumlah_stok_sparepart - $result->jumlah_barang;
            }

            $success_sparepart = $sparepart->save();
            $success_trans = $transpenjualan->save();

            if($success_sparepart && $success_trans) {
                return response()->json('Success Decrease', 200);
            }
            else {
                return response()->json('Error Decrease', 500);
            }

        }
        
        $success = $transpenjualan->save();

        if ($success) {
            return response()->json('Pembayaran Sukses', 204);
        } else {
            return response()->json('Pembayaran gagal', 500);
        }
    }
}
