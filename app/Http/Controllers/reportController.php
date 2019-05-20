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
	public function pendapatan_bul() {
		$januari = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '01');
		
		$januari_grand = $januari->sum('grand_total');
		$januari_jasa = $januari->sum('total_harga_jasa');
		$januari_spare = $januari->sum('total_harga_spare');

		$februari = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '02');
		
		$februari_grand = $februari->sum('grand_total');
		$februari_jasa = $februari->sum('total_harga_jasa');
		$februari_spare = $februari->sum('total_harga_spare');

		$maret = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '03');
		
		$maret_grand = $maret->sum('grand_total');
		$maret_jasa = $maret->sum('total_harga_jasa');
		$maret_spare = $maret->sum('total_harga_spare');

		$april = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '04');
		
		$april_grand = $april->sum('grand_total');
		$april_jasa = $april->sum('total_harga_jasa');
		$april_spare = $april->sum('total_harga_spare');

		$mei = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '05');
		
		$mei_grand = $mei->sum('grand_total');
		$mei_jasa = $mei->sum('total_harga_jasa');
		$mei_spare = $mei->sum('total_harga_spare');

		$juni = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '06');
		
		$juni_grand = $juni->sum('grand_total');
		$juni_jasa = $juni->sum('total_harga_jasa');
		$juni_spare = $juni->sum('total_harga_spare');

		$juli = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '07');
		
		$juli_grand = $juli->sum('grand_total');
		$juli_jasa = $juli->sum('total_harga_jasa');
		$juli_spare = $juli->sum('total_harga_spare');

		$agustus = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '08');
		
		$agustus_grand = $agustus->sum('grand_total');
		$agustus_jasa = $agustus->sum('total_harga_jasa');
		$agustus_spare = $agustus->sum('total_harga_spare');

		$september = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '09');
		
		$september_grand = $september->sum('grand_total');
		$september_jasa = $september->sum('total_harga_jasa');
		$september_spare = $september->sum('total_harga_spare');

		$oktober = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '10');
		
		$oktober_grand = $oktober->sum('grand_total');
		$oktober_jasa = $oktober->sum('total_harga_jasa');
		$oktober_spare = $oktober->sum('total_harga_spare');

		$november = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '11');
		
		$november_grand = $november->sum('grand_total');
		$november_jasa = $november->sum('total_harga_jasa');
		$november_spare = $november->sum('total_harga_spare');

		$desember = trans_penjualan::
		join('detail_transjasa', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('detail_transsparepart','detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
		->select('trans_penjualan.grand_total', 'trans_penjualan.tanggal_penjualan'
		, 'detail_transjasa.total_harga_jasa', 'detail_transsparepart.total_harga_spare')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereMonth('trans_penjualan.tanggal_penjualan', '12');
		
		$desember_grand = $desember->sum('grand_total');
		$desember_jasa = $desember->sum('total_harga_jasa');
		$desember_spare = $desember->sum('total_harga_spare');

		$januari_json = [
			"bulan" => "Januari",
			"grand_total" => $januari_grand, 
			"total_jasa" => $januari_jasa, 
			"total_spare" => $januari_spare];

		$februari_json = [
			"bulan" => "Februari",
			"grand_total" => $februari_grand, 
			"total_jasa" => $februari_jasa, 
			"total_spare" => $februari_spare];
			
		$maret_json = [
			"bulan" => "Maret",
			"grand_total" => $maret_grand, 
			"total_jasa" => $maret_jasa, 
			"total_spare" => $maret_spare];

		$april_json = [
			"bulan" => "April",
			"grand_total" => $april_grand, 
			"total_jasa" => $april_jasa, 
			"total_spare" => $april_spare];

		$mei_json = [
			"bulan" => "Mei",
			"grand_total" => $mei_grand, 
			"total_jasa" => $mei_jasa, 
			"total_spare" => $mei_spare];

		$juni_json = [
			"bulan" => "Juni",
			"grand_total" => $juni_grand, 
			"total_jasa" => $juni_jasa, 
			"total_spare" => $juni_spare];
			
		$juli_json = [
			"bulan" => "Juli",
			"grand_total" => $juli_grand, 
			"total_jasa" => $juli_jasa, 
			"total_spare" => $juli_spare];
		$agustus_json = [
			"bulan" => "Agustus",
			"grand_total" => $agustus_grand, 
			"total_jasa" => $agustus_jasa, 
			"total_spare" => $agustus_spare];

		$september_json = [
			"bulan" => "September",
			"grand_total" => $september_grand, 
			"total_jasa" => $september_jasa, 
			"total_spare" => $september_spare];
			
		$oktober_json = [
			"bulan" => "Oktober",
			"grand_total" => $oktober_grand, 
			"total_jasa" => $oktober_jasa, 
			"total_spare" => $oktober_spare];

		$november_json = [
			"bulan" => "November",
			"grand_total" => $november_grand, 
			"total_jasa" => $november_jasa, 
			"total_spare" => $november_spare];
			
		$desember_json = [
			"bulan" => "Desember",
			"grand_total" => $desember_grand, 
			"total_jasa" => $desember_jasa, 
			"total_spare" => $desember_spare];
	

			return response()->json([
				$januari_json,
				$februari_json,
				$maret_json,
				$april_json,
				$mei_json,
				$juni_json,
				$juli_json,
				$agustus_json,
				$september_json,
				$oktober_json,
				$november_json,
				$desember_json
				]);
	}

	// public function pendapatan_bul($month) {
	//     $results = trans_penjualan::where('status_transaksi', '=', 'sudah')
	//                 ->where('status_pembayaran', '=', 'sudah')
	//                 ->whereMonth('created_at', $month)->get();

	//     return response()->json($results, 200);
	// }

	public function pengeluaran_bul() {
		// $results = trans_pengadaan::whereMonth('created_at', $month)->get();

		// return response()->json($results, 200);

		$januari = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '01');
		
		$januari_total = $januari->sum('trans_pengadaan.total_harga_pengadaan');

		$februari = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '02');
		
		$februari_total = $februari->sum('trans_pengadaan.total_harga_pengadaan');

		$maret = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '03');
		
		$maret_total = $maret->sum('trans_pengadaan.total_harga_pengadaan');

		$april = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '04');
		
		$april_total = $april->sum('trans_pengadaan.total_harga_pengadaan');

		$mei = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '05');
		
		$mei_total = $mei->sum('trans_pengadaan.total_harga_pengadaan');

		$juni = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '06');
		
		$juni_total = $juni->sum('trans_pengadaan.total_harga_pengadaan');

		$juli = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '07');
		
		$juli_total = $juli->sum('trans_pengadaan.total_harga_pengadaan');

		$agustus = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '08');
		
		$agustus_total = $agustus->sum('trans_pengadaan.total_harga_pengadaan');

		$september = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '09');
		
		$september_total = $september->sum('trans_pengadaan.total_harga_pengadaan');

		$oktober = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '10');
		
		$oktober_total = $oktober->sum('trans_pengadaan.total_harga_pengadaan');
		
		$november = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '11');
		
		$november_total = $november->sum('trans_pengadaan.total_harga_pengadaan');

		$desember = trans_pengadaan::
		select('trans_pengadaan.total_harga_pengadaan')
		->where('trans_pengadaan.status_pengadaan', '=', 'sudah diterima')
		->whereMonth('trans_pengadaan.tanggal_pengadaan', '12');
		
		$desember_total = $desember->sum('trans_pengadaan.total_harga_pengadaan');

		$januari_json = [
			'bulan' => "Januari",
			'total_harga_pengadaan' => $januari_total];

		$februari_json = [
			'bulan' => "Februari",
			'total_harga_pengadaan' => $februari_total];
			
		$maret_json = [
			'bulan' => "Maret",
			'total_harga_pengadaan' => $maret_total];

		$april_json = [
			'bulan' => "April",
			'total_harga_pengadaan' => $april_total];

		$mei_json = [
			'bulan' => "Mei",
			'total_harga_pengadaan' => $mei_total];

		$juni_json = [
			'bulan' => "Juni",
			'total_harga_pengadaan' => $juni_total];
			
		$juli_json = [
			'bulan' => "Juli",
			'total_harga_pengadaan' => $juli_total];
		$agustus_json = [
			'bulan' => "Agustus",
			'total_harga_pengadaan' => $agustus_total];

		$september_json = [
			'bulan' => "September",
			'total_harga_pengadaan' => $september_total];
			
		$oktober_json = [
			'bulan' => "Oktober",
			'total_harga_pengadaan' => $oktober_total];

		$november_json = [
			'bulan' => "November",
			'total_harga_pengadaan' => $november_total];
			
		$desember_json = [
			'bulan' => "Desember",
			'total_harga_pengadaan' => $desember_total];
	

			return response()->json([
				$januari_json,
				$februari_json,
				$maret_json,
				$april_json,
				$mei_json,
				$juni_json,
				$juli_json,
				$agustus_json,
				$september_json,
				$oktober_json,
				$november_json,
				$desember_json
				]);
	}

	public function spare_terlaris($month) {
		$results = detail_trans_sparepart::
		join('trans_penjualan', 'detail_transsparepart.id_trans_penjualan', 'trans_penjualan.id')
					->whereMonth('trans_penjualan.created_at', $month)
					->where('trans_penjualan.status_transaksi', '=', 'sudah')
					->where('trans_penjualan.status_pembayaran', '=', 'sudah')
					->get();
					//->orderBy('jumlah_barang', 'desc');

		return response()->json($results, 200);
	}

	public function jumlah_jasa_perMotor($id_motor) {
		$results = detail_trans_jasa::
		join('trans_penjualan', 'detail_transjasa.id_trans_penjualan', 'trans_penjualan.id')
		->join('kendaraans', 'detail_transjasa.id_kendaraan', 'kendaraans.id')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->where('kendaraans', '=', $id_motor)
		->get();

		return response()->json($results, 200);
	}

	public function sisa_stok_bulanan() {
		$results = sparepart::
		orderBy('jumlah_stok_sparepart', 'asc')
		->get();

		return response()->json($results, 200);
	}

	public function tahunan_perCabang() {
		// $results = trans_penjualan::whereYear('created_at', $year)
		// 			->where('id_cabang', '=', $branch)
		// 			->get();

		// return response()->json($results, 200);

		$tahun2016 = trans_penjualan::
		join('cabangs', 'cabangs.id', '=', 'trans_penjualan.id_cabang')
		->select('trans_penjualan.grand_total','trans_penjualan.id_cabang')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereYear('trans_penjualan.tanggal_penjualan', '2016');
		
		$tahun2016_total = $tahun2016->sum('trans_penjualan.grand_total');
		$tahun2016_cabang = $tahun2016->select('trans_penjualan.cabang.nama_cabang');

		$tahun2017 = trans_penjualan::
		join('cabangs', 'cabangs.id', '=', 'trans_penjualan.id_cabang')
		->select('trans_penjualan.grand_total','trans_penjualan.id_cabang')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereYear('trans_penjualan.tanggal_penjualan', '2017');
		
		$tahun2017_total = $tahun2017->sum('trans_penjualan.grand_total');
		$tahun2017_cabang = $tahun2017->select('trans_penjualan.cabang.nama_cabang');

		$tahun2018 = trans_penjualan::
		join('cabangs', 'cabangs.id', '=', 'trans_penjualan.id_cabang')
		->select('trans_penjualan.grand_total','trans_penjualan.id_cabang')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereYear('trans_penjualan.tanggal_penjualan', '2018');
		
		$tahun2018_total = $tahun2018->sum('trans_penjualan.grand_total');
		$tahun2018_cabang = $tahun2018->select('trans_penjualan.cabang.nama_cabang');

		$tahun2019 = trans_penjualan::
		join('cabangs', 'cabangs.id', '=', 'trans_penjualan.id_cabang')
		->select('trans_penjualan.grand_total','trans_penjualan.id_cabang')
		->where('trans_penjualan.status_transaksi', '=', 'sudah')
		->where('trans_penjualan.status_pembayaran', '=', 'sudah')
		->whereYear('trans_penjualan.tanggal_penjualan', '2019');
		
		$tahun2019_total = $tahun2019->sum('trans_penjualan.grand_total');
		$tahun2019_cabang = $tahun2019->select('trans_penjualan.cabang.nama_cabang');


		$tahun2016_json = [
			'tahun' => "2016",
			'cabang' => $tahun2016_cabang,
			'grand_total' => $tahun2016_total];

		$tahun2017_json = [
			'tahun' => "2017",
			'cabang' => $tahun2017_cabang,
			'grand_total' => $tahun2017_total];
			
		$tahun2018_json = [
			'tahun' => "2018",
			'cabang' => $tahun2018_cabang,
			'grand_total' => $tahun2018_total];

		$tahun2019_json = [
			'tahun' => "2019",
			'cabang' => $tahun2019_cabang,
			'grand_total' => $tahun2019_total];


			return response()->json([
				$tahun2016_json,
				$tahun2017_json,
				$tahun2018_json,
				$tahun2019_json,
				]);
	}
}
