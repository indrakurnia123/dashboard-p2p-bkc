<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FintechSektorBisnis extends Model
{
    use HasFactory;
    protected $table = 'fintech_sektor_bisnis';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
