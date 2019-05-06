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

    public function cabang(){
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }
                        
    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
    public function detail_trans_jasa(){
        return $this->hasMany(detail_trans_jasa::class);
    }

    public function detail_trans_sparepart(){
        return $this->hasMany(detail_trans_sparepart::class);
    }

}
