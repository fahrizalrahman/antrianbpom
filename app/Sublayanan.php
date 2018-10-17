<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sublayanan extends Model
{
    //
        protected $fillable = [
        'id_loket', 'nama_sublayanan','kode_loket','batas_dari_jam','batas_sampai_jam','batas_antrian','petugas'
    ];



    // relasi ke loket
    public function loket()
    {
        return $this->hasOne('App\Loket', 'id', 'id_loket');
    }
}
