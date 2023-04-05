<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Analisa;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Lending;
use App\Fintech;

class QuickAnalysisIndex extends Component
{
    use WithPagination;
    protected $listeners=['updateData','analisa','noDataAnalisa'=>'noDataAnalisa'];
    public $statusPembiayaan;
    public $paginationTheme='bootstrap';
    public $filter='*';
    public $paginate;
    public $querySearch;

    public function mount()
    {
        $this->paginate = 15;
        $this->querySearch="";
        // $this->data = DB::select('call getPembiayaanByTglAndStatus(?,?,?)',array('2021-11-01',date('Y-m-d'),$this->filter));
        // $this->statusPembiayaan = DB::table('status_pembiayaan')->get();
    }
    public function updatingFilter()
    {
        $this->resetPage();
    }
    public function updatingQuerySearch()
    {
        $this->resetPage();
    }

    public function noDataAnalisa()
    {      
        $this->dispatchBrowserEvent('swal:mixin',[
            'position'=>'bottom-right',
            'title'=>'Data analisa tidak ditemukan',
            'icon'=>'error'
        ]);
    }

    public function analisaConfirm($no_factsheet)
    {
        // $data = Lending::where('no_factsheet',$no_factsheet)->get();
        $this->dispatchBrowserEvent('swal:confirmAnalisa',[
            'title'=>'Analisa Ulang?',
            'text'=>'Data Quick Analysis sebelumnya akan dihapus dari sistem',
            'icon'=>'warning',
            'confirmButtonText'=>'Ya Analisa Ulang',
            'cancelButtonText'=>'Batal',
            'confirmedTitle'=>'Berhasil',
            'confirmedText'=>'Berhasil Analisa Ulang data',
            'confirmedIcon'=>'success',
            'noFactsheet'=>$no_factsheet,
            'canceledTitle'=>'Gagal'
        ]);
    }

    public function analisa($no_factsheet)
    {
        // dd($data);
        DB::select('call getQuickAnalysisByNoFactsheet(?)',array($no_factsheet));
        $data = Lending::where('no_factsheet',$no_factsheet)->get();
        return redirect()->to('/analisa/quick-analysis-detail/'.$data[0]->quick_analysis);
    }

    public function cekAnalisa($no_factsheet)
    {
        DB::select('call getQuickAnalysisByNoFactsheet(?)',array($no_factsheet));
        $data = Lending::where('no_factsheet',$no_factsheet)->get();
        return redirect()->to('/analisa/quick-analysis-detail/'.$data[0]->quick_analysis);
    }
    
    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa.quick-analysis-index',[
            'data'=>$this->querySearch===""?
                Lending::orderByDesc('id')->paginate($this->paginate):
                Lending::where('no_factsheet','LIKE','%'.$this->querySearch.'%')
                ->orWhere(
                    function ($query){
                        $query->whereIn('fintech_id',function($query){
                            $query->select('id')->from('finteches')->where('name','LIKE','%'.$this->querySearch.'%');
                        });
                    }
                )
                ->orWhere(
                    function ($query){
                        $query->whereIn('borrower',function($query){
                            $query->select('id')->from('borrower')->where('nama','LIKE','%'.$this->querySearch.'%');
                        });
                    }
                )
                ->orWhere(
                    function ($query){
                        $query->whereIn('payor_id',function($query){
                            $query->select('id')->from('payor')->where('nama','LIKE','%'.$this->querySearch.'%');
                        });
                    }
                )
                ->orderByDesc('id')->paginate($this->paginate)
        ])->extends('layouts.master');
    }
}
