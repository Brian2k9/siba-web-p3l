<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trans_penjualan extends Model
{
    protected $table = 'trans_penjualan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_pelanggan',
                            'id_cabang',
                            'total_harga_trans',
                            'discount_penjualan',
                            'grand_total',
                            'status_transaksi',
                            'status_pembayaran',
                            'no_plat_kendaraan',
                            'tanggal_penjualan'];
}
