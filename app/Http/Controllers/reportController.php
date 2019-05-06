<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\trans_penjualan;
use App\trans_pengadaan;
use App\sparepart;
use App\detail_trans_sparepart;
use App\detail_trans_jasa;

class reportController extends Controller
{
    public function lap_pendapatan_bul($month) {
        $results = trans_penjualan::where('status_transaksi', '=', 'sudah')
                    ->where('status_pembayaran', '=', 'sudah')
                    ->whereMonth('created_at', $month)->get();

        return response()->json($results, 200);
    }

    public function lap_pengeluaran_bul($month) {
        $results = trans_pengadaan::whereMonth('created_at', $month)->get();

        return response()->json($results, 200);
    }

    public function lap_spare_terlaris($month) {
        $results = detail_trans_sparepart::
        join('trans_penjualan', 'detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
                    ->whereMonth('trans_penjualan.created_at', $month)
                    ->where('trans_penjualan.status_transaksi', '=', 'sudah')
                    ->where('trans_penjualan.status_pembayaran', '=', 'sudah')
                    ->get();
                    //->orderBy('jumlah_barang', 'desc');

        return response()->json($results, 200);
    }

    public function lap_jumlah_jasa_perMotor($id_motor) {
        $results = detail_trans_jasa::
        join('trans_penjualan', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
        ->join('kendaraans', 'detail_transjasa.id_kendaraan', 'kendaraans.id')
        ->where('trans_penjualan.status_transaksi', '=', 'sudah')
        ->where('trans_penjualan.status_pembayaran', '=', 'sudah')
        ->where('kendaraans', '=', $id_motor)
        ->get();

        return response()->json($results, 200);
    }

    public function lap_sisa_stok_bulanan() {
        $results = sparepart::
        orderBy('jumlah_stok_sparepart', 'asc')
        ->get();

        return response()->json($results, 200);
    }

    public function lap_tahunan_perCabang($branch, $year) {
        $results = trans_penjualan::whereYear('created_at', $year)
                    ->where('id_cabang', '=', $branch)
                    ->get();

        return response()->json($results, 200);
    }
}
