<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_trans_pengadaan extends Model
{
    protected $table = 'detail_pengadaan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_trans_pengadaan',
                            'id_sparepart',
                            'jumlah_pengadan'];
}
