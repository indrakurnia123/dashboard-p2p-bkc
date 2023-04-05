<?php

namespace App\Http\Livewire\App\Dashboard\Transaksi;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Repositories\Helper;
use App\Repositories\DashboardP2pHelper;
use App\Repositories\TransaksiKreditP2p;
use App\KodeTransaksi;
use App\Fintech;
use App\Lending;
use App\TransaksiKredit;


class TransaksiAngsuran extends Component
{
    public $selected_kode_transaksi;
    public $noFactsheet;
    public $dataTransaksi=Array([
        'no_rekening'=>null,
        'kode'=>null,
        'tanggal'=>null,
        'pokok'=>0,
        'bunga'=>0,
        'diskon_bunga'=>0,
        'denda'=>0,
        'suku_bunga'=>null,
        'jkw'=>null,
    ]);

    public $lendingData=Array(
        'no_factsheet',
        'no_rekening',
        'tanggal_penawaran',
        'plafon_pendawaran',
        'jatuh_tempo',
        'bunga',
        'jangka_waktu',
        'fintech',
        'borrower',
        'type_jkw',
    );
    public $no_rekening;

    public function mount()
    {
        $this->kode_transaksi = KodeTransaksi::where('status',1)->get();
    }
    public function cekData()
    {
        // $lendingData = Lending::where('no_factsheet',$this->noFactsheet)->get();
        $lendingData = DB::table('lending')->select(
            'lending.status_pembiayaan',
            'lending.no_factsheet',
            'lending.no_rekening',
            'lending.tanggal_penawaran',
            'lending.plafon_penawaran',
            'lending.jatuh_tempo',
            'lending.bunga',
            'lending.jangka_waktu',
            'lending.type_jangka_waktu',
            'status_pembiayaan.nama as status',
            'finteches.name as fintech',
            'borrower.nama as borrower')
            ->join('finteches','lending.fintech_id','finteches.id')
            ->join('borrower','lending.borrower','borrower.id')
            ->join('status_pembiayaan','lending.status_pembiayaan','status_pembiayaan.id')
            ->where('no_factsheet',$this->noFactsheet)
            ->get();
        if(empty($lendingData[0]))
        {
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Data tidak ditemukan!',
                'icon'=>'error',
                'text'=>'mungkin nomor factsheet salah'
            ]);
            $this->lendingData=Array([]);
            return;
        }else{
            if($lendingData[0]->status_pembiayaan==3)
            {
                $this->dispatchBrowserEvent('swal:fire',[
                    'title'=>'Pinjaman Sudah LUNAS!',
                    'icon'=>'error',
                    'text'=>''
                ]);
                $this->lendingData=Array([]);
                return;
            }
            if($lendingData[0]->status_pembiayaan==2)
            {
                $this->dispatchBrowserEvent('swal:fire',[
                    'title'=>'Pinjaman Sudah DITOLAK!',
                    'icon'=>'error',
                    'text'=>''
                ]);
                $this->lendingData=Array([]);
                return;
            }
            $this->lendingData['no_factsheet']=$lendingData[0]->no_factsheet;
            $this->lendingData['no_rekening']=$lendingData[0]->no_rekening;
            $this->lendingData['tanggal_penawaran']=$lendingData[0]->tanggal_penawaran;
            $this->lendingData['plafon_penawaran']=number_format($lendingData[0]->plafon_penawaran,0,',','.');
            $this->lendingData['jatuh_tempo']=$lendingData[0]->jatuh_tempo;
            $this->lendingData['suku_bunga']=number_format($lendingData[0]->bunga*100,2,'.',',');
            $this->lendingData['jangka_waktu']=$lendingData[0]->jangka_waktu;
            $this->lendingData['fintech']=$lendingData[0]->fintech;
            $this->lendingData['borrower']=$lendingData[0]->borrower;
            $this->lendingData['status']=$lendingData[0]->status;
            $this->lendingData['type_jangka_waktu']=$lendingData[0]->type_jangka_waktu;

         }
    }

    public function storeTransaksi()
    {     
        $helper = new Helper;
        $p2pHelper = new DashboardP2pHelper;
        $transaksip2p = new TransaksiKreditP2p;

        $this->dataTransaksi['no_factsheet']=$this->lendingData['no_factsheet'];
        $this->dataTransaksi['no_rekening']=$this->lendingData['no_rekening'];
        $this->dataTransaksi['nama_nasabah']=$this->lendingData['borrower'];
        $this->dataTransaksi['kode']='42.2';
        $this->dataTransaksi['tanggal'];
        $this->dataTransaksi['pokok'];
        $this->dataTransaksi['bunga'];
        $this->dataTransaksi['diskon_bunga'];
        $this->dataTransaksi['denda'];
        $this->dataTransaksi['suku_bunga']=$this->lendingData['suku_bunga'];
        $this->dataTransaksi['jangka_waktu']=$this->lendingData['jangka_waktu'];
        $this->dataTransaksi['type_jangka_waktu']=$this->lendingData['type_jangka_waktu'];

        // Create Transaksi Realisasi Kredit
        $transaksi=$transaksip2p->transaksiRealisasiFactsheet($this->dataTransaksi);
        if(!$transaksi['code']=='00')
        {
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Transaksi Gagal',
                'icon'=>'error',
                'text'=>$transaksi['message']
            ]);
            return;
        }

        // Create Jadwal Angsuran Kredit
        $createJadwal = $p2pHelper->createJadwalAngsuranByNoFactsheet($this->dataTransaksi['no_factsheet']);
        
        if(!$createJadwal['code']=='00')
        {
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Transaksi Gagal',
                'icon'=>'error',
                'text'=>$createJadwal['message']
            ]);
                $deleteTransaksiRealisasi = $transaksip2p->deleteTransaksiRealisasiFactsheet($this->dataTransaksi['no_factsheet']);
            return;
        }
        
        // Update Data Lending
        $updateLendingData=Lending::where('no_factsheet',$this->dataTransaksi['no_factsheet'])->update([
            'status_pembiayaan'=>1,
            'nominal_pembiayaan'=>$this->dataTransaksi['pokok'],
            'tanggal_pembiayaan'=>$this->dataTransaksi['tanggal'],
            'jangka_waktu'=>$this->dataTransaksi['jangka_waktu'],
            'jatuh_tempo'=>$helper->getTglJatuhTempo($this->dataTransaksi['tanggal'],$this->dataTransaksi['jangka_waktu'],$this->dataTransaksi['type_jangka_waktu']),
        ]);

        if(!$updateLendingData)
        {
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Gagal Update Data Lending',
                'icon'=>'error',
                'text'=>''
            ]);
            $deleteTransaksiRealisasi = $transaksip2p->deleteTransaksiRealisasiFactsheet($this->dataTransaksi['no_factsheet']);
        }

        if($transaksi['code']=='00'&&$createJadwal['code']=='00'&&$updateLendingData)
        {
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Transaksi Realisasi Berhasil',
                'icon'=>'success',
                'text'=>$transaksi['message']." - ".$createJadwal['message']." - ".'Transaksi Berhasil'
            ]);
        }else{            
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Transaksi Realisasi gagal',
                'icon'=>'error',
                'text'=>$transaksi['message']." - ".$createJadwal['message']." - ".'Transaksi Gagal'
            ]);
        }
    }


    public function render()
    {
        return view('livewire.app.dashboard.transaksi.transaksi-angsuran')->extends('layouts.master');
    }
}
