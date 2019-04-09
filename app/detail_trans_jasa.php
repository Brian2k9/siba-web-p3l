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
}
