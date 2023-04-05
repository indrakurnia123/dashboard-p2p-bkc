<?php

namespace App\Http\Livewire\App\Dashboard\P2p\AnalisaKeuangan;

use Livewire\Component;
use Livewire\WithPagination;
use App\AnalisaKeuangan;

class Index extends Component
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

    public function render()
    {
        return view('livewire.app.dashboard.p2p.analisa-keuangan.index',[
            'data'=>$this->querySearch===""?
                AnalisaKeuangan::orderByDesc('id')->paginate($this->paginate):
                AnalisaKeuangan::where('no_factsheet','LIKE','%'.$this->querySearch.'%')
        ])->extends('layouts.master');
    }
}
