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
                            'total_harga_pengadaan',
                            'status_pengadaan'];


    public function supplier(){
        return $this->belongsTo(supplier::class, 'id_supplier');
    }
                                                                                                
    public function cabang(){
        return $this->belongsTo(cabang::class, 'id_cabang');
    }

    public function detail_trans_pengadaan(){
        return $this->hasMany(detail_trans_pengadaan::class);
    }
}
