<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_trans_jasa extends Model
{
    protected $table = 'detail_transjasa';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_trans_penjualan',
                            'id_jasa',
                            'id_pegawai',
                            'id_kendaraan',
                            'jumlah_jasa',
                            'total_harga_jasa'];

    public function trans_penjualan(){
        return $this->belongsTo(trans_penjualan::class, 'id_trans_penjualan');
    }
                                                
    public function jasa_service(){
        return $this->belongsTo(jasa_service::class, 'id_jasa');
    }
    public function pegawai(){
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
    public function kendaraan(){
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }
}
