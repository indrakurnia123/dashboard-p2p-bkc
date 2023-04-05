<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Payor;
use App\Lending;

class FactsheetPayor extends Model
{
    use HasFactory;
    protected $table = 'factsheet_payor';
    protected $guarded = [];
    protected $primaryKey='id';

    public function payor()
    {
        return $this->belongsTo(Payor::class,'payor_id','id');
    }

    public function lending()
    {
        return $this->belongsTo(Lending::class,'lending_id','id');
    }
}
