<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportTtd extends Model
{
    use HasFactory;
    protected $table = 'report_ttd';
    protected $guarded = [];
    protected $primaryKey = 'id';
}
