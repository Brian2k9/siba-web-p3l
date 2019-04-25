<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nama_pelanggan',
                            'alamat_pelanggan',
                            'no_telp_pelanggan'];

    public function trans_penjualan(){
        return $this->hasMany(trans_penjualan::class);
    }   
}
