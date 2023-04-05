<?php

namespace App\Http\Livewire\App\Dashboard\P2p\DataFintech;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Fintech;

class Index extends Component
{
    use WithPagination;
    protected $listeners=['updateData'];
    public $paginationTheme='bootstrap';
    public $paginate;
    public $querySearch;
    
    public function mount()
    {
        $this->paginate = setting('site.app_default_pagination');
        $this->querySearch="";
    }

    public function updatingQuerySearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.data-fintech.index',[
            'data'=>$this->querySearch===""?
            Fintech::orderByDesc('id')->paginate($this->paginate):
            Fintech::where('name','LIKE','%'.$this->querySearch.'%')->paginate($this->paginate)
        ])->extends('layouts.master');
    }
}
