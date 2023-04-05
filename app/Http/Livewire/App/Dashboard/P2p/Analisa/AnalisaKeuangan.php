<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Analisa;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Lending;
use App\Fintech;

class AnalisaKeuangan extends Component
{
    use WithPagination;
    protected $listeners=['updateData'];
    public $paginationTheme='bootstrap';
    public $filter='*';
    public $paginate;
    public $querySearch;

    public function mount()
    {
        $this->paginate = 15;
        $this->querySearch="";
    }


    public function cekAnalisa($no_factsheet)
    {
        // DB::select('call getQuickAnalysisByNoFactsheet(?)',array($no_factsheet));
        // $data = Lending::where('no_factsheet',$no_factsheet)->get();
        return redirect()->route('analisa.keuangan.detail',1);
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa.analisa-keuangan',[
            
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
