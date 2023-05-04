<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Data;

use Livewire\Component;
use App\Repositories\DashboardP2pHelper;
use App\Lending;
use App\TransaksiKredit;

class Detail extends Component
{
    protected $listeners = [
        'refreshComponent' => '$refresh',
        'createJadwalAngsuran'
    ];
    public $jadwalAngsuran=Array();
    public function mount($id)
    {
        $lending = Lending::where('id',$id)->get();
        $this->lending = $lending[0];

        $jadwalAngsuran = TransaksiKredit::where('no_factsheet',$this->lending->no_factsheet)->get();
        if(!$jadwalAngsuran)
        {
            $this->jadwalAngsuran=Array();
        }else{
            $this->jadwalAngsuran=$jadwalAngsuran;
        }

        // dd($this->jadwalAngsuran);
    }

    public function createJadwalAngsuran($noFactsheet)
    {
        $p2phelper = new DashboardP2pHelper;
        $createJadwal = $p2phelper->createJadwalAngsuranByNoFactsheet($noFactsheet);
        
        if($createJadwal['code']=='00')
        {
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Berhasil Create Jadwal',
                'icon'=>'success',
                'text'=>$createJadwal['message']
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:fire',[
                'title'=>'Gagal Create Jadwal',
                'icon'=>'error',
                'text'=>$createJadwal['message']
            ]);
        }

        $this->emit('refreshComponent');
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.data.detail')->extends('layouts.master');
    }
}
