<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingFintech extends Model
{
    use HasFactory;
    protected $table = 'rating_fintech';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
