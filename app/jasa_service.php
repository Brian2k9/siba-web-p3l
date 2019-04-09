<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jasa_service extends Model
{
    protected $table = 'jasa_services';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nama_jasa',
                            'harga_jasa'];
}
