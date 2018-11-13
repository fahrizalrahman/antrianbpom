<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TulisanUtama extends Model
{
    protected $fillable = [
        'judul','isi','lantai'
    ];
}
