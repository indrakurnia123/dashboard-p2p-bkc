<?php

namespace App\Http\Livewire\App\Dashboard\P2p\DataBorrower;

use Livewire\Component;
use Livewire\WithPagination;
use App\Borrower;

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
        return view('livewire.app.dashboard.p2p.data-borrower.index',[
            'data'=>$this->querySearch===""?
            Borrower::orderByDesc('id')->paginate($this->paginate):
            Borrower::where('nama','LIKE','%'.$this->querySearch.'%')->paginate($this->paginate)
        ])->extends('layouts.master');
    }
}
