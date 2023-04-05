<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenPks extends Model
{
    use HasFactory;

    protected $table = 'dokumen_pks';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
