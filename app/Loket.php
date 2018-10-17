<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loket extends Model
{
    //
    protected $fillable = [
        'nama_layanan', 'kode', 'lantai','petugas','batas_dari_jam','batas_sampai_jam','batas_antrian','kode_antrian'
    ];

    // relasi ke user
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'petugas');
    }
}
