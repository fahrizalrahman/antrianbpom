<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GambarUtama extends Model
{
    protected $fillable = [
        'judul_gambar','gambar','lantai'
    ];
}
