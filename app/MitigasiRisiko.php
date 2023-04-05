<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MitigasiRisiko extends Model
{
    use HasFactory;
    protected $table = 'mitigasi_risiko';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
