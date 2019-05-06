<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cabang extends Model
{
    protected $table = 'cabangs';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nama_cabang',
                            'alamat_cabang',
                            'no_telp_cabang'];


   public function pegawai(){
    return $this->hasMany(Pegawai::class);
    }
    
    public function trans_penjualan(){
        return $this->hasMany(trans_penjualan::class);
    }   

    public function trans_pengadaan(){
        return $this->hasMany(trans_pengadaan::class);
    }
}


