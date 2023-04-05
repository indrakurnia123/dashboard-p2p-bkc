<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Fintech;

class DatastudioData extends Model
{
    use HasFactory;

    protected $table = 'datastudio_data';
    
    public function fintech()
    {
        return $this->belongsTo(Fintech::class,'fintech_id','id');
    }
}
