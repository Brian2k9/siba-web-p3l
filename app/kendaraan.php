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


    public function detail_trans_jasa(){
        return $this->hasMany(detail_trans_jasa::class);
    }
}
