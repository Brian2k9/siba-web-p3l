<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pegawai extends Model
{
    protected $table = 'pegawais';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = ['id_role',
                            'nama_pegawai',
                            'alamat_pegawai',
                            'no_telp_pegawai',
                            'gaji_perminggu',
                            'password_pegawai',
                            'id_cabang'];

    public function cabang(){
        return $this->belongsTo(Cabang::class, 'id_cabang');
    }

    public function role(){
        return $this->belongsTo(Role::class, 'id_role');
    }
    public function detail_trans_jasa(){
        return $this->hasMany(detail_trans_jasa::class);
    }
}
