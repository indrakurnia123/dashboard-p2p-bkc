<?php

namespace App\Http\Livewire\App\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Lending;
use App\Fintech;
use App\FactsheetPayor;

class NominatifPembiayaan extends Component
{
    use WithPagination;
    protected $listeners=['updateData'];
    public $statusPembiayaan;
    public $paginationTheme='bootstrap';
    public $filter='*';
    public $paginate;
    public $querySearch;
    
    public function mount()
    {
        $this->paginate = setting('site.app_default_pagination');
        $this->querySearch="";
        $this->statusPembiayaan = DB::table('status_pembiayaan')->get();
    }
    
    public function updatingFilter()
    {
        $this->resetPage();
    }
    public function updatingQuerySearch()
    {
        $this->resetPage();
    }

    public function selectStatus($id)
    {
        $this->filter=$id;
    }

    public function render()
    {
        return view('livewire.app.dashboard.nominatif-pembiayaan',[
            'data'=>$this->filter==="*"?
            ($this->querySearch===""?
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
                ->orderByDesc('id')->paginate($this->paginate)):
                ($this->querySearch===""?
                Lending::where('status_pembiayaan',$this->filter)->orderByDesc('id')->paginate($this->paginate):
                Lending::where('status_pembiayaan',$this->filter)->where('no_factsheet','LIKE','%'.$this->querySearch.'%')
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
                ->orderByDesc('id')->paginate($this->paginate)),
            'totalPembiayaanCount'=>DB::table('lending')->count(),
            'statuses'=>DB::select('call getPembiayaanStatusCount')
        ])->extends('layouts.master');
    }
}
