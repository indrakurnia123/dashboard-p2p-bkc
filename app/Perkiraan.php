<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perkiraan extends Model
{
    use HasFactory;

    protected $table='perkiraan';
    protected $guarded=[];
}
