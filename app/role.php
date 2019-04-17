<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['nama_role'];

    public function pegawai(){
        return $this->hasMany(Pegawai::class);
    }
}
