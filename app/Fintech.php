<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Stakeholder;
use App\SektorUsaha;
use App\DokumenPks;

class Fintech extends Model
{
    use HasFactory;
    protected $table = 'finteches';
    protected $primaryKey= 'id';
    protected $guarded = [];

    public function pengurus()
    {
        return $this->belongsToMany(Stakeholder::class,'fintech_pegurus','fintech_id','id');
    }

    public function pemilik()
    {
        return $this->belongsToMany(Stakeholder::class,'fintech_pemilik','fintech_id','id');
    }

    public function sektorBisnis()
    {
        return $this->belongsToMany(SektorUsaha::class,'fintech_sektor_bisnis','fintech_id','sektor_usaha_id');
    }

    public function dokumenPks()
    {
        return $this->belongsToMany(DokumenPks::class,'fintech_pks','fintech_id','dokumen_pks_id');
    }

    public function dokumenIjinOjk()
    {
        return $this->belongsToMany(DokumenIjinOjk::class,'fintech_ijin_ojk','fintech_id','dokumen_ijin_ojk_id');
    }
}
