<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiKredit extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kredit';
    protected $guarded = [];
}
