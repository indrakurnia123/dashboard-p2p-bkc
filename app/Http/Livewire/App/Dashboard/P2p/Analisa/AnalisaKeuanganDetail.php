<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Analisa;

use Livewire\Component;

class AnalisaKeuanganDetail extends Component
{
    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa.analisa-keuangan-detail')->extends('layouts.report');
    }
}
