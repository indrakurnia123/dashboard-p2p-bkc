<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class LewatJatuhTempo extends Component
{
    public function mount()
    {        

        $this->LewatJatuhTempo=DB::table('lending')
        ->join('finteches','lending.fintech_id','=','finteches.id')
        ->join('borrower','lending.borrower','=','borrower.id')
        ->select(DB::raw('
        lending.jatuh_tempo,
        finteches.name as nama_fintech,
        borrower.nama as nama_borrower,
        lending.nominal_pembiayaan,
        datediff(date(now()),lending.jatuh_tempo) as tunggakan_hari
        '))
        ->where('lending.status_pembiayaan','=',1)
        ->where('lending.jatuh_tempo','<',date('Y-m-d   '))
        ->get();
    }
    
    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.lewat-jatuh-tempo');
    }
}
