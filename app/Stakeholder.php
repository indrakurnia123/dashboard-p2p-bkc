<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;

    protected $table = 'stakeholder';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
