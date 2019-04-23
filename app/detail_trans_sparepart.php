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
}
