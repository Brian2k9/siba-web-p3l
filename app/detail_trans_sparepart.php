<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_trans_sparepart extends Model
{
    protected $table = 'detail_transsparepart';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_trans_penjualan',
                            'id_sparepart',
                            'jumlah_barang',
                            'total_harga_spare'];

    public function trans_penjualan(){
        return $this->belongsTo(trans_penjualan::class, 'id_trans_penjualan');
    }
                                                                        
    public function sparepart(){
        return $this->belongsTo(Sparepart::class, 'id_sparepart');
    }
}
