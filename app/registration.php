<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
	protected $fillable = [
        'name', 'email', 'password','jabatan'
    ];
}
