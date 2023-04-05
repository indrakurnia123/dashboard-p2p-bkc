<?php

namespace App\Http\Livewire\App\Dashboard\P2p\DataPayor;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use App\Payor;

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
        $this->paginate=15;
        $this->querySearch="";
    }
    public function render()
    {
        return view('livewire.app.dashboard.p2p.data-payor.index')->extends('layouts.master');
    }
}
