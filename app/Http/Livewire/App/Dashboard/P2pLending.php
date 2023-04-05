<?php

namespace App\Http\Livewire\App\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class P2pLending extends Component
{
    public $dataNominal1;
    public $dataNominal2;
    public $jatuhTempoHariIni;

    public function mount()
    {
        // $this->nominalAktif=DB::select("select sum(nominal_pembiayaan) from lending where status_pembiayaan=1")
        $this->totalPembiayaan=DB::select('call getTotalPembiayaanDetailByTanggal(?)',array(date('Y-m-d')));
        $this->totalNominalAktif=DB::select('call getNominalPembiayaanDetailByStatusAndTanggal(?,?)',array(date('Y-m-d'),1));
        $this->totalNominalOnProcess=DB::select('call getNominalPembiayaanDetailByStatusAndTanggal(?,?)',array(date('Y-m-d'),5));
        $this->totalNominalLunas=DB::select('call getNominalLunasDetailByTanggal(?)',array(date('Y-m-d')));

        // dd($this->dataNominal1);
        $this->jatuhTempoHariIni=DB::table('lending')
        ->join('finteches','lending.fintech_id','=','finteches.id')
        ->join('borrower','lending.borrower','=','borrower.id')
        ->select(DB::raw('
        lending.jatuh_tempo,
        finteches.name as nama_fintech,
        borrower.nama,
        lending.nominal_pembiayaan,
        lending.tunggakan_hari
        '))
        ->where('lending.jatuh_tempo','=','date(now())')
        ->where('lending.status_pembiayaan',1)
        ->get();

    }
    public function render()
    {
        return view('livewire.app.dashboard.p2p-lending')->extends('layouts.master');
    }
}
