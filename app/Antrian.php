<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    //
     protected $fillable = [
        'id_loket', 'status', 'no_antrian','id_user','id_sublayanan'
    ];

     // relasi ke user
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_user');
    }

    // relasi ke loket
    public function loket()
    {
        return $this->hasOne('App\Loket', 'id', 'id_loket');
    }
}
