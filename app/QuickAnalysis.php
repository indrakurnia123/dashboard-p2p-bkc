<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuickAnalysis extends Model
{
    use HasFactory;

    protected $table = 'quick_analysis';
    protected $guarded = [];
}
