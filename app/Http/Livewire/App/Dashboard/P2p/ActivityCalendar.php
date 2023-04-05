<?php

namespace App\Http\Livewire\App\Dashboard\P2p;

use Livewire\Component;
use App\Fintech;
use App\Lending;
use Illuminate\Support\Facades\DB;

class ActivityCalendar extends Component
{
    public $jatuhTempoPinjamanEvents=Array(
        'id'=>1,
        'backgroundColor'=>'#FFFBF2',
        'borderColor'=>'#FBBC06',
        'events'=>[],
    );
    public $lewatJatuhTempoPinjamanEvents=Array(
        'id'=>1,
        'backgroundColor'=>'#FFF0F4',
        'borderColor'=>'#FF3366',
        'events'=>[],
    );
    
    public function mount()
    {
        $now = time();
        // dd($now-strtotime("2022-11-12"));
        $iJtp=0;
        $jatuhTempoPinjaman=Lending::whereIn('status_pembiayaan',[1])->where('jatuh_tempo','>=',date('Y-m-d'))->get();
        foreach($jatuhTempoPinjaman as $event)
        {
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['id']=$event->id;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['start']=$event->jatuh_tempo;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['end']=$event->jatuh_tempo;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['title']=$event->borrowerData->nama;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_borrower']=$event->borrowerData->nama;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_no_factsheet']=$event->no_factsheet;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_nominal']=number_format($event->nominal_pembiayaan,2,',','.');
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_tanggal_pembiayaan']=$event->tanggal_pembiayaan;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_jangka_waktu']=$event->jangka_waktu." ".$event->typeJangkaWaktuData->nama;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_sifat_pembiayaan']=$event->sifat_pembiayaan;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_jatuh_tempo']=$event->jatuh_tempo;
            $this->jatuhTempoPinjamanEvents['events'][$iJtp]['description_tunggakan_hari']=round(($now-strtotime($event->jatuh_tempo))/(60*60*24))." hari";
            $iJtp++;
        }
        $lIjtp=0;
        $lewatJatuhTempoPinjaman=Lending::whereIn('status_pembiayaan',[1])->where('jatuh_tempo',"<",date('Y-m-d'))->get();
        foreach($lewatJatuhTempoPinjaman as $event)
        {
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['id']=$event->id;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['start']=$event->jatuh_tempo;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['end']=$event->jatuh_tempo;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['title']=$event->borrowerData->nama;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_borrower']=$event->borrowerData->nama;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_no_factsheet']=$event->no_factsheet;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_nominal']=number_format($event->nominal_pembiayaan,2,',','.');
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_tanggal_pembiayaan']=$event->tanggal_pembiayaan;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_jangka_waktu']=$event->jangka_waktu." ".$event->typeJangkaWaktuData->nama;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_sifat_pembiayaan']=$event->sifat_pembiayaan;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_jatuh_tempo']=$event->jatuh_tempo;
            $this->lewatJatuhTempoPinjamanEvents['events'][$lIjtp]['description_tunggakan_hari']=round(($now-strtotime($event->jatuh_tempo))/(60*60*24))." hari";
            $lIjtp++;
        }
    }
    public function render()
    {
        return view('livewire.app.dashboard.p2p.activity-calendar')->extends('layouts.master');
    }
}
