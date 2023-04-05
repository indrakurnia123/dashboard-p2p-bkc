<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KualitasKredit extends Model
{
    use HasFactory;

    protected $table = 'kualitas_kredit';
    protected $guarded = [];
}
