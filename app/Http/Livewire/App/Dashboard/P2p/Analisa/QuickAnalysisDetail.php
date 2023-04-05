<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Analisa;

use Livewire\Component;
use App\QuickAnalysis;
use App\Repositories\Helper;
use Illuminate\Support\Facades\DB;
use PDF;

class QuickAnalysisDetail extends Component
{

    public function mount($id)
    {
        $this->analysis = QuickAnalysis::find($id);
        if($this->analysis)
        {
            $this->score_rac = DB::select('select getScoreRAC(?) as score',array($this->analysis->no_factsheet));
            $this->score_rac_detail = DB::select('call getScoreRacDetail(?)',array($this->analysis->no_factsheet));
            $this->score_fitur_pendanaan= DB::select('select getScoreFiturPendanaan(?) as score',array($this->analysis->no_factsheet));
            $this->score_fitur_pendanaan_detail= DB::select('call getScoreFiturPendanaanDetail(?)',array($this->analysis->no_factsheet));
        }else{
            return redirect()->to('/analisa/quick-analysis');
        }
    }

    // public function printReport($id)
    // {
    //     $analysis = QuickAnalysis::find($id);
    //     $noRegistrasi = $analysis->no_registrasi;
    //     $helper = new Helper;
    //     $random = $helper->getRandomString(10);
    //     $filename= $noRegistrasi."-".$random.".pdf";
        
    //     $logo = $helper->toBase64("img/img/logo-png.png");
    //     $ttd = $helper->toBase64("img/img/ttd.png");
        
    //     $pdf = PDF::loadView('livewire.app.dashboard.p2p.analisa.quick-analysis.detail',[
    //         'analysis'=>$analysis,
    //         'logo'=>$logo,
    //         'ttd'=>$ttd,
    //         ])->output();
    //     return response()->streamDownload(
    //         fn()=>print($pdf),
    //         $filename
    //     );
    // }

    public function printReport($id)
    {
        $analysis = QuickAnalysis::find($analysisId);
        // $noRegistrasi = $analysis->no_registrasi;
        // $helper = new Helper;
        // $random = $helper->getRandomString(10);
        $filename= $analysis->no_factsheet."-quick-analysis.pdf";
        // $waktu_analysis = $helper->getWaktuRapat($rapat->tanggal);
        
        // $logo = $helper->toBase64("img/img/logo-png.png");
        // $ttd = $helper->toBase64("img/img/ttd.png");
        
        $pdf = PDF::loadView('livewire.app.dashboard.p2p.analisa.quick-analysis-detail',[
            'analysis'=>$analysis,
            'score_rac' => DB::select('select getScoreRAC(?) as score',array($this->analysis->no_factsheet)),
            'score_rac_detail' => DB::select('call getScoreRacDetail(?)',array($this->analysis->no_factsheet)),
            'score_fitur_pendanaan'=> DB::select('select getScoreFiturPendanaan(?) as score',array($this->analysis->no_factsheet)),
            'score_fitur_pendanaan_detail'=> DB::select('call getScoreFiturPendanaanDetail(?)',array($this->analysis->no_factsheet)),
            ]);
            // $pdf = PDF::loadView('livewire.app.dashboard.p2p.analisa.test');
            return $pdf->download($filename);
        // return response()->streamDownload(
        //     fn()=>print($pdf),
        //     $filename
        // );
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa.quick-analysis-detail')->extends('layouts.report');
    }
}
