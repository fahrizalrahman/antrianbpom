<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingHari extends Model
{
     protected $fillable = [
        'id_loket', 'hari'
    ];



        // relasi ke loket
    public function loket()
    {
        return $this->hasOne('App\Loket', 'id', 'id_loket');
    }
}
