<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenIjinOjk extends Model
{
    use HasFactory;

    protected $table = 'dokumen_ijin_ojk';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
