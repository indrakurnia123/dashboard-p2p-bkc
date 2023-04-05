<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class JenisPembiayaan extends Model
{
    use HasFactory;
    protected $table = 'jenis_pembiayaan';
    protected $guarded = [];
    protected $primaryKey='id';
}
