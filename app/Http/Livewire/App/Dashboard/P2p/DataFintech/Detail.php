<?php

namespace App\Http\Livewire\App\Dashboard\P2p\DataFintech;

use Livewire\Component;
use App\Fintech;
use App\Lending;
use Illuminate\Support\Facades\DB;

class Detail extends Component
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
    
    public $infoPembiayaan;

    public function mount($id)
    {
        $this->fintech_id = $id;
        $now = time();
        // dd($now-strtotime("2022-11-12"));
        $iJtp=0;
        $jatuhTempoPinjaman=Lending::where('fintech_id',$id)->whereIn('status_pembiayaan',[1])->where('jatuh_tempo','>=',date('Y-m-d'))->get();
        
        $this->infoPembiayaan=collect(DB::select('select finteches.name as nama_fintech, status_pembiayaan.nama as `status`,count(lending.id) as noa, sum(nominal_pembiayaan) as nominal 
        from 
        lending join finteches on lending.fintech_id=finteches.id
        join status_pembiayaan on lending.status_pembiayaan=status_pembiayaan.id
        where
        lending.fintech_id='.$id.'
        group by status
        '));

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
        $lewatJatuhTempoPinjaman=Lending::where('fintech_id',$id)->whereIn('status_pembiayaan',[1])->where('jatuh_tempo',"<",date('Y-m-d'))->get();
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
        return view('livewire.app.dashboard.p2p.data-fintech.detail',[
            'data'=>Fintech::find($this->fintech_id),
            'outstanding'=>Lending::where('fintech_id',$this->fintech_id)->whereIn('status_pembiayaan',[1])->get()->sum('nominal_pembiayaan'),
            'info_pembiayaan'=>collect(DB::select('select finteches.name as `nama_fintech`, status_pembiayaan.nama as `status`, sum(lending.nominal_pembiayaan) as nominal, count(lending.id) as noa
            from 
            lending join finteches on lending.fintech_id=finteches.id
            join status_pembiayaan on lending.status_pembiayaan=status_pembiayaan.id
            where
            lending.fintech_id='.$this->fintech_id.'
            group by status'))
        ])->extends('layouts.master');
    }
}
