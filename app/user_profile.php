<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_profile extends Model
{
  	protected $fillable = [
        'id','userid','type','nama','alamat','no_telp','nik','email_1','npwp','foto'
    ];

    // relasi ke user
    public function user()
    {
        return $this->hasOne('App\User', 'id', 'userid');
    }
}
