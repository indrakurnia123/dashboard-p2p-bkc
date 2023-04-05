<?php

namespace App\Http\Livewire\App\Dashboard\P2p\DataBorrower;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Borrower;

class Detail extends Component
{
    public $borrower;
    public $borrowerByStatus;
    public $borrowerByPayor;
    public function mount($id)
    {
        $this->borrower=Borrower::find($id);
        $this->borrowerByStatus=DB::select('SELECT
        finteches.name AS nama_fintech,
        status_pembiayaan.nama AS `status`,
        COUNT(lending.id) AS noa,
        SUM(lending.nominal_pembiayaan) AS nominal
        FROM
        lending JOIN finteches ON lending.fintech_id=finteches.id
        JOIN status_pembiayaan ON lending.status_pembiayaan=status_pembiayaan.id
        WHERE
        lending.borrower='.$id.'
        GROUP BY nama_fintech, status');
        $this->borrowerByStatus=collect($this->borrowerByStatus);

        $this->borrowerByPayor=DB::select('SELECT
        payor.nama AS nama_payor,
        status_pembiayaan.nama AS `status`,
        COUNT(factsheet_payor.no_factsheet) AS jml_factsheet,
        SUM(lending.nominal_pembiayaan) AS nominal
        FROM
        factsheet_payor
        JOIN payor ON factsheet_payor.payor_id=payor.id
        JOIN lending ON factsheet_payor.no_factsheet=lending.no_factsheet
        JOIN status_pembiayaan ON lending.status_pembiayaan=status_pembiayaan.id
        WHERE
        factsheet_payor.no_factsheet IN (SELECT no_factsheet FROM lending WHERE borrower='.$id.')
        GROUP BY nama_payor,STATUS
        ORDER BY nama_payor,STATUS');
        $this->borrowerByPayor=collect($this->borrowerByPayor);
        // dd($this->borrower[0]->lending->groupBy('status_pembiayaan'));
    }
    public function render()
    {
        return view('livewire.app.dashboard.p2p.data-borrower.detail')->extends('layouts.master');
    }
}
