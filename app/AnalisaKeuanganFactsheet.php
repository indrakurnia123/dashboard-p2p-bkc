<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalisaKeuanganFactsheet extends Model
{
    use HasFactory;

    protected $table = 'analisa_keuangan_factsheet';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
