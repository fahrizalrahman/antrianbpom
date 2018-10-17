<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tulisan extends Model
{
    protected $fillable = [
        'judul','isi','float','lantai'
    ];
}
