<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Repositories\Helper;

class JumlahDisburse extends Component
{
    public $data;
    public $dataRepayment;
    public $dataBulan = Array();
    public $dataNominalDisburse = Array();
    public $dataNominalRepayment = Array();
    
    public function mount()
    {
        $helper = new Helper;
        $this->data = DB::select('call getNominalDisbursePerBulan');
        $this->dataRepayment = DB::select('call getNominalRepaymentPerBulan');
        // dd($this->data);
        foreach($this->dataRepayment as $data)
        {
            // array_push($this->dataNominalRepayment,['x'=>$helper->dateToDatetime($data->eom_day),'y'=>(float)$data->nominal]);
            array_push($this->dataNominalRepayment,['x'=>$data->month_name,'y'=>(float)$data->nominal]);
        }

        foreach($this->data as $data)
        {
            // dd($data->bulan);
            // array_push($this->dataBulan,$data->eom_day);
            // array_push($this->dataNominalDisburse,['x'=>$helper->dateToDatetime($data->eom_day),'y'=>(float)$data->nominal]);
            array_push($this->dataNominalDisburse,['x'=>$data->month_name,'y'=>(float)$data->nominal]);
        }
        // dd(json_encode($this->dataNominalDisburse,true));
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.jumlah-disburse');
    }
}
