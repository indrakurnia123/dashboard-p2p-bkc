<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SektorUsaha extends Model
{
    use HasFactory;
    protected $table = 'sektor_usaha';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
