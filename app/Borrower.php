<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\BentukBadanHukum;
use App\JenisPembiayaan;
use App\SektorUsaha;
use App\Lending;
use App\RatingFintech;

class Borrower extends Model
{
    use HasFactory;
    protected $connection='mysql';
    protected $table = 'borrower';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public function lending()
    {
        return $this->hasMany(Lending::class,'borrower','id');
    }

    public function bentuk_badan_hukum()
    {
        return $this->belongsTo(BentukBadanHukum::class,'bentuk_badan_hukum_id','id');
    }

    public function jenis_pembiayaan()
    {
        return $this->belongsTo(JenisPembiayaan::class,'jenis_pembiayaan_id','id');
    }

    public function sektor_usaha()
    {
        return $this->belongsTo(SektorUsaha::class,'sektor_usaha_id','id');
    }
}
