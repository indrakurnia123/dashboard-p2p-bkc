<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisStakeholder extends Model
{
    use HasFactory;
    protected $table ='jenis_stakeholder';
    protected $guarded = [];
    protected $primaryKey='id';
}
