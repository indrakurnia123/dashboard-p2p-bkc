<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Repositories\Helper;

class Pie extends Component
{
    //data studio
    public $lokasiPerusahaan=Array();
    public $lokasiPerusahaanJml=Array();
    public $lokasiPayor=Array();
    public $lokasiPayorJml=Array();
    public $jenisPembiayaan=Array();
    public $jenisPenggunaan=Array();

    public function mount()
    {
        $helper = new Helper;
        $lokasi_perusahaan = DB::table('lending')->select('lokasi_perusahaan.nama',DB::raw('count(lending.id) as jml'))
        ->join('lokasi_perusahaan','lokasi_perusahaan.id','=','lending.lokasi_perusahaan')
        ->groupBy('nama')
        ->get();
        // dd($lokasi_perusahaan);
        foreach($lokasi_perusahaan as $lokasi)
        {
            array_push($this->lokasiPerusahaan,$lokasi->nama);
            array_push($this->lokasiPerusahaanJml,(float)$lokasi->jml);
        }
        // dd($this->lokasiPerusahaanJml);

        $lokasi_payor = DB::table('payor')->select('lokasi_perusahaan.nama',DB::raw('count(payor.id) as jml'))
        ->join('lokasi_perusahaan','lokasi_perusahaan.id','=','payor.lokasi_perusahaan_id')
        ->groupBy('nama')
        ->get();
        
        foreach($lokasi_payor as $lokasi)
        {
            array_push($this->lokasiPayor,$lokasi->nama);
            array_push($this->lokasiPayorJml,(float)$lokasi->jml);
        }

        
        $jenis_pembiayaan = DB::table('lending')->select('jenis_pembiayaan.nama',DB::raw('count(lending.id) as jml'))
        ->join('jenis_pembiayaan','jenis_pembiayaan.id','=','lending.jenis_pembiayaan')
        ->groupBy('nama')
        ->orderByDesc('jml')
        ->get();
        
        foreach($jenis_pembiayaan as $jenis)
        {
            array_push($this->jenisPembiayaan,['name'=>$jenis->nama,'data'=>(array)$jenis->jml]);
        }

        
        $jenis_penggunaan = DB::table('lending')->select('jenis_penggunaan.nama',DB::raw('count(lending.id) as jml'))
        ->join('jenis_penggunaan','jenis_penggunaan.id','=','lending.jenis_penggunaan')
        ->groupBy('nama')
        ->orderByDesc('jml')
        ->get();

        $this->jenisPengguaan = json_encode($jenis_penggunaan,true);
        
        foreach($jenis_penggunaan as $jenis)
        {
            array_push($this->jenisPenggunaan,['name'=>$jenis->nama,'data'=>(array)$jenis->jml]);
        }

    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.pie');
    }
}
