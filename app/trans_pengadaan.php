<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class trans_pengadaan extends Model
{
    protected $table = 'trans_pengadaan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_supplier',
                            'id_cabang',
                            'tanggal_pengadaan',
                            'total_harga_pengadaan'];
}
