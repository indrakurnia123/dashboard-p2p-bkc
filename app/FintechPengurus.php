<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FintechPengurus extends Model
{
    use HasFactory;

    protected $table = 'fintech_pengurus';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
