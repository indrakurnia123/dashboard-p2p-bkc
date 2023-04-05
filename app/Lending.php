<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Fintech;
use App\Borrower;
use App\Payor;
use App\LokasiPerusahaan;
use App\LokasiProject;
use App\SifatPembiayaan;
use App\StatusPembiayaan;
use App\TypeJangkaWaktu;
use App\BentukBadanHukum;
use App\TujuanPinjaman;
use App\RatingFintech;
use App\RatingPefindo;
use App\JenisPembiayaan;
use App\SektorUsaha;
use App\AgunanUtama;

class Lending extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'lending';
    protected $guarded = [];
    // protected $primaryKey = 'no_factsheet';
    // protected $keyType = 'string';
    // public $incrementing = false;
    
    
    public function fintech()
    {
        return $this->belongsTo(Fintech::class,'fintech_id','id');
    }

    public function borrowerData()
    {
        return $this->belongsTo(Borrower::class,'borrower','id');
    }
    
    public function payor()
    {
        return $this->belongsToMany(Payor::class,'factsheet_payor','lending_id','payor_id');
    }

    public function sifatPembiayaanData()
    {
        return $this->belongsTo(SifatPembiayaan::class,'sifat_pembiayaan','id');
    }

    public function statusPembiayaanData()
    {
        return $this->belongsTo(StatusPembiayaan::class,'status_pembiayaan','id');
    }

    public function typeJangkaWaktuData()
    {
        return $this->belongsTo(TypeJangkaWaktu::class,'type_jangka_waktu','id');
    }

    public function bentukBadanHukum()
    {
        return $this->belongsTo(BentukBadanHukum::class,'bentuk_badan_hukum_id','id');
    }

    public function tujuanPinjamanData()
    {
        return $this->belongsTo(TujuanPinjaman::class,'tujuan_pinjaman','id');
    }
    
    public function ratingFintech()
    {
        return $this->belongsTo(RatingFintech::class,'rating_fintech','id');
    }

    public function jenisPembiayaan()
    {
        return $this->belongsTo(JenisPembiayaan::class,'jenis_pembiayaan','id');
    }
    
    public function sektorUsaha()
    {
        return $this->belongsTo(SektorUsaha::class,'sektor_usaha','id');
    }

    public function lokasiPerusahaan()
    {
        return $this->belongsTo(LokasiPerusahaan::class,'lokasi_perusahaan','id');
    }
    
    public function lokasiProject()
    {
        return $this->belongsTo(LokasiProject::class,'lokasi_project','id');
    }
    public function agunanUtama()
    {
        return $this->belongsTo(AgunanUtama::class,'agunan_utama','id');
    }
    public function ratingPefindo()
    {
        return $this->belongsTo(RatingPefindo::class,'rating_pefindo','id');
    }
}
