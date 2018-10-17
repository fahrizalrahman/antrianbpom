<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingHariSub extends Model
{
    protected $fillable = [
        'id_sublayanan', 'hari'
    ];


            // relasi ke loket
    public function loket()
    {
        return $this->hasOne('App\Sublayanan', 'id', 'id_sublayanan');
    }
}
