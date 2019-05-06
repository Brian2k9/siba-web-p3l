<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    protected $table = 'suppliers';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nama_supplier',
                            'sales_supplier',
                            'no_telp_supplier',
                            'alamat_supplier'];

    public function trans_pengadaan(){
        return $this->hasMany(trans_pengadaan::class);
    }
}
