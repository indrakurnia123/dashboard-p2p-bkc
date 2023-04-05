<?php

namespace App\Http\Livewire\App\Dashboard\P2p\AnalisaKeuangan;

use Livewire\Component;
use App\AnalisaKeuangan;
use App\Lending;
use App\Fintech;
use App\Borrower;
use App\ReportTtd;
use PDF;

class Detail extends Component
{
    public $analisaId;
    public $lendingData;
    public function mount($id)
    {
        $this->dataTtd1 = ReportTtd::find(4);
        $this->dataTtd2 = ReportTtd::find(3);
        $this->dataTtd3 = ReportTtd::find(2);
        $this->dataTtd4 = ReportTtd::find(1);
        $this->analisaId=$id;
        $this->lendingData=Lending::where('analisa_keuangan_id',$id)->limit(1)->get();
        $this->lendingDataAll=Lending::where('analisa_keuangan_id',$id)->get();
    }

    public function printReport($id)
    {
        $analysis = AnalisaKeuangan::find($id);
        
        $kodeAnalisa = $analysis->kode_analisa;
        $helper = new Helper;
        $random = $helper->getRandomString(10);
        $filename= $noRegistrasi."-".$random.".pdf";
        $waktu_analisa = $helper->getWaktuAnalisa($analysis->tanggal);
        
        $logo = $helper->toBase64("img/img/logo-png.png");
        $ttd = $helper->toBase64("img/img/ttd.png");
        
        $pdf = PDF::loadView('livewire.app.dashboard.p2p.analisa.keuangan.detail',[
            'analisa-keuangan'=>$analisa,
            'waktu_analysis'=>$waktu_rapat,
            'logo'=>$logo,
            'ttd'=>$ttd,
            ])->output();
        return response()->streamDownload(
            fn()=>print($pdf),
            $filename
        );
    }

    // public function printReport()
    // {
    //     $pdf = PDF::loadView('detail');
    //     return $pdf->download('report.pdf');
    // }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa-keuangan.detail',[
            'data'=>AnalisaKeuangan::find($this->analisaId)
        ])->extends('layouts.report');
    }
}
