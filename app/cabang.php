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
}
