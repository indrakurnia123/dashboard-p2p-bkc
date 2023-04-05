<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;
// use TransaksiKredit;

class JadwalAngsuran extends Component
{
    public function mount($jadwalAngsuran)
    {
        $this->jadwalAngsuran=$jadwalAngsuran;
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.jadwal-angsuran')->extends('layouts.master');
    }
}
