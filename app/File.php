<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = 
    [
    'title','lantai','filename','status','type'
    ];
}
