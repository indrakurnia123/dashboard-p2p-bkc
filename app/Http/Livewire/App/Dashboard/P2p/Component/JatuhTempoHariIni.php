<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class JatuhTempoHariIni extends Component
{
    public function mount()
    {        
        $this->jatuhTempoHariIni=DB::table('lending')
        ->join('finteches','lending.fintech_id','=','finteches.id')
        ->join('borrower','lending.borrower','=','borrower.id')
        ->select(DB::raw('
        lending.jatuh_tempo,
        finteches.name as nama_fintech,
        borrower.nama as nama_borrower,
        lending.nominal_pembiayaan,
        datediff(date(now()),lending.jatuh_tempo) as tunggakan_hari
        '))
        ->where('lending.jatuh_tempo','=',date('Y-m-d'))
        ->where('lending.status_pembiayaan',1)
        ->get();
    }
    
    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.jatuh-tempo-hari-ini');
    }
}
