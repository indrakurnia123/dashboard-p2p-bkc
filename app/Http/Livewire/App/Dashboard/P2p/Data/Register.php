<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Data;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Repositories\Helper;
use App\Fintech;
use App\Borrower;
use App\LokasiPerusahaan;
use App\LokasiProject;
use App\SektorUsaha;
use App\JenisPembiayaan;
use App\AddPk;
use App\TypeJangkaWaktu;
use App\TujuanPinjaman;
use App\SifatPembiayaan;
use App\RatingFintech;
use App\StatusPembiayaan;
use App\RatingPefindo;
use App\AgunanUtama;
use App\Payor;
use App\Bonafiditas;
use App\RepeatOrder;
use App\Asuransi;
use App\Lending;
use App\KriteriaBorrower;
use App\JenisPenggunaan;
use App\BentukBadanHukum;
use App\FactsheetPayor;

class Register extends Component
{
    public 
    $no_factsheet,
    $fintech_id,
    $borrower,
    $lokasi_perusahaan,
    $sektor_usaha,
    $lokasi_project,
    $jenis_pembiayaan,
    $add_pk,
    $plafon_penawaran,
    $nominal_pembiayaan,
    $jangka_waktu,$type_jangka_waktu,
    $tanggal_pembiayaan,
    $asuransi,
    $persen_asuransi,
    $nominal_asuransi,
    $suku_bunga,
    $tujuan_pinjaman,
    $sifat_pembiayaan,
    $payor_id,
    $agunan_utama,
    $repeat_order,
    $rating_fintech,
    $rating_pefindo,
    $bonafiditas,
    $baki_debet,
    $status_pembiayaan,
    $nominal_admin,
    $persen_admin,
    $provisi,
    $bulan_pembiayaan,
    $tanggal_penawaran,
    $no_rekening,
    $kriteria_borrower,
    $jenis_penggunaan,
    $link_dokumen,
    $bentuk_badan_hukum;

    public $newFactsheetPayor;

    public function mount()
    {
        $this->finteches = Fintech::select('id','name')->get();
        $this->borrowerData = Borrower::select('id','nama')->get();
        $this->lokasiPerusahaanData = LokasiPerusahaan::select('id','nama')->get();
        $this->lokasiProjectData = LokasiProject::select('id','nama')->get();
        $this->sektorUsahaData = SektorUsaha::select('id','nama')->get();
        $this->jenisPembiayaanData = JenisPembiayaan::select('id','nama')->get();
        $this->addPkData = AddPk::select('id','nama')->get();
        $this->typeJangkaWaktuData = TypeJangkaWaktu::select('id','nama')->get();
        $this->tujuanPinjamanData = TujuanPinjaman::select('id','nama')->get();
        $this->sifatPembiayaanData = SifatPembiayaan::select('id','nama')->get();
        $this->ratingFintechData = RatingFintech::select('id','nama')->get();
        $this->statusPembiayaanData = StatusPembiayaan::select('id','nama')->get();
        $this->ratingPefindoData = RatingPefindo::select('id','nama')->get();
        $this->agunanUtamaData = AgunanUtama::select('id','nama')->get();
        $this->payorData = Payor::select('id','nama')->get();
        $this->bonafiditasData = Bonafiditas::select('id','status')->get();
        $this->repeatOrderData = RepeatOrder::select('id','nama')->get();
        $this->asuransiData = Asuransi::select('id','nama')->get();
        $this->kriteriaBorrowerData = KriteriaBorrower::select('id','nama')->get();
        $this->jenisPenggunaanData = JenisPenggunaan::select('id','nama')->get();
        $this->bentukBadanHukum = BentukBadanHukum::select('id','nama')->get();
        
        $this->status_pembiayaan=4;
    }
    
    public function store()
    {   
        $this->validate([
            'no_factsheet'=>['required','unique:lending'],
            'fintech_id'=>'required',
            'borrower'=>'required',
            'jenis_pembiayaan'=>'required',
            'plafon_penawaran'=>'required',
            'jangka_waktu'=>'required',
            'type_jangka_waktu'=>'required'
        ]);
        // dd($this->jangka_waktu,$this->type_jangka_waktu);
        $helper = new Helper;
        // $tgl_jatuh_tempo = $helper->getTglJatuhTempo($this->tanggal_pembiayaan,$this->jangka_waktu,$this->type_jangka_waktu);

        $lending = Lending::create([
            'no_factsheet'=>$this->no_factsheet,
            'fintech_id'=>$this->fintech_id,
            'borrower'=>$this->borrower,
            'lokasi_perusahaan'=>$this->lokasi_perusahaan,
            'lokasi_project'=>$this->lokasi_project,
            'sektor_usaha'=>$this->sektor_usaha,
            'jenis_pembiayaan'=>$this->jenis_pembiayaan,
            'add_pk'=>$this->add_pk,
            'plafon_penawaran'=>$this->plafon_penawaran,
            'jangka_waktu'=>$this->jangka_waktu,
            'type_jangka_waktu'=>$this->type_jangka_waktu,
            'bunga'=>$this->suku_bunga/100,#=============================================>beda nama field
            'tujuan_pinjaman'=>$this->tujuan_pinjaman,
            'sifat_pembiayaan'=>$this->sifat_pembiayaan,
            'rating_fintech'=>$this->rating_fintech,
            'status_pembiayaan'=>$this->status_pembiayaan,
            'tanggal_pembiayaan'=>$this->tanggal_penawaran, #pas register diisi dulu dengan tanggal penawaran
            'payor_id'=>$this->payor_id,
            'tanggal_penawaran'=>$this->tanggal_penawaran,
            'agunan_utama'=>$this->agunan_utama,
            'repeat_order'=>$this->repeat_order,
            'rating_pefindo'=>$this->rating_pefindo,
            'bonafiditas'=>$this->bonafiditas,
            'baki_debet'=>$this->baki_debet,
            'asuransi'=>$this->asuransi,
            'persen_asuransi'=>$this->persen_asuransi,
            'persen_admin'=>$this->persen_admin,
            'kriteria_borrower'=>$this->kriteria_borrower,
            'jenis_penggunaan'=>$this->jenis_penggunaan,
            'bentuk_badan_hukum_id'=>$this->bentuk_badan_hukum,
        ]);

        if($lending){
            foreach($this->newFactsheetPayor as $payor){
                FactsheetPayor::firstOrCreate([
                    'payor_id'=>$payor,
                    'no_factsheet'=>$this->no_factsheet,
                    'lending_id'=>$lending->id,
                ]);
            }
            $this->dispatchBrowserEvent('swal:fire',[
                'icon'=>'success',
                'title'=>'Berhasil',
                'text'=>'Berhasil tambah data',
                'position'=>'center'
            ]);
        }else{
            $this->dispatchBrowserEvent('swal:fire',[
                'icon'=>'success',
                'title'=>'Gagal',
                'text'=>'Gagal tambah data',
                'position'=>'center'
            ]);
        }
    }
    public function render()
    {
        return view('livewire.app.dashboard.p2p.data.register')->extends('layouts.master');
    }
}
