<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lending;
use App\LokasiPerusahaan;
use App\SektorUsaha;

class Payor extends Model
{
    use HasFactory;
    protected $connection='mysql';
    protected $table = 'payor';
    protected $guarded = [];
    protected $primaryKey = 'id';

    
    public function lending()
    {
        return $this->belongsToMany(Landing::class,'factsheet_payor','payor_id','no_factsheet');
    }

    public function lokasi_perusahaan()
    {
        return $this->belongsTo(LokasiPerusahaan::class,'lokasi_perusahaan_id','id');
    }

    public function sektor_usaha()
    {
        return $this->belongsTo(SektorUsaha::class,'sektor_usaha_id','id');
    }
}
