<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BentukBadanHukum extends Model
{
    use HasFactory;
    protected $table = 'bentuk_badan_hukum';
    protected $guarded = [];
}
