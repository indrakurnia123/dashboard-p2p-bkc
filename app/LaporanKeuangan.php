<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Leding;
use App\AnalisaKeuangan;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporan_keuangan';
    protected $guarded = [];
    protected $primaryKey = 'id';

    public function lending()
    {
        return $this->belongsTo(Lending::class,'no_factsheet','no_factsheet');
    }

    public function analisa_keuangan()
    {
        return $this->belongsTo(AnalisaKeuangan::class,'analisa_keuangan_id','id');
    }
}
