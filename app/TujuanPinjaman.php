<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TujuanPinjaman extends Model
{
    use HasFactory;
    protected $table = 'tujuan_pinjaman';
    protected $guarded=[];
    protected $primaryKey = 'id';
}
