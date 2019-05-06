<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sparepart extends Model
{
    protected $table = 'spareparts';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['kode_sparepart',
                            'nama_sparepart',
                            'merk_sparepart',
                            'tipe_sparepart',
                            'gambar_sparepart',
                            'jumlah_stok_sparepart',
                            'harga_beli_sparepart',
                            'harga_jual_sparepart',
                            'jumlah_minimal'];

    public function detail_trans_sparepart(){
        return $this->hasMany(detail_trans_sparepart::class);
    }

    public function detail_trans_pengadaan(){
        return $this->hasMany(detail_trans_pengadaan::class);
    }
}
