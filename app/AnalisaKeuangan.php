<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Fintech;
use App\Borrower;
use App\Lending;
use App\MitigasiRisiko;

class AnalisaKeuangan extends Model
{
    use HasFactory;
    protected $table = 'analisa_keuangan';
    protected $guarded = [];
    protected $primaryKey= 'id';
    
    public function fintech()
    {
        return $this->belongsTo(Fintech::class,'fintech_id','id');
    }

    public function borrowerData()
    {
        return $this->belongsTo(Borrower::class,'borrower_id','id');
    }

    public function lending()
    {
        return $this->belongsToMany(Lending::class,'analisa_keuangan_factsheet','analisa_keuangan_id','no_factsheet');
    }
    
    public function mitigasi()
    {
        return $this->belongsToMany(MitigasiRisiko::class,'analisa_keuangan_mitigasi','analisa_keuangan_id','mitigasi_risiko_id');
    }
}
