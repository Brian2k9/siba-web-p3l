<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class kendaraan extends Model
{
    protected $table = 'kendaraans';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['merk_kendaraan',
                            'tipe_kendaraan'];


    public function detailTransJasa(){
        return $this->hasMany(detail_trans_jasa::class);
    }
}
