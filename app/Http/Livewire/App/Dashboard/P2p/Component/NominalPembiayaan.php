<?php

namespace App\Http\Livewire\App\Dashboard\P2p\Component;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\DatastudioData;

class NominalPembiayaan extends Component
{
    public $data;
    public $dataLimit;
    public $dataNominal2;
    public $lokasiBorrowerJawaBarat;
    public $lokasiBorrowerLuarJawaBarat;
    public function mount()
    {
        $this->data = DB::table('lending')
        ->join('finteches','lending.fintech_id','=','finteches.id')
        ->join('limit_kredit_fintech','lending.fintech_id','=','limit_kredit_fintech.fintech_id')
        ->join(DB::raw('(SELECT b.fintech_id,b.id,a.no_factsheet,sum(a.pokok) AS pokok,b.status_pembiayaan FROM angsuran a JOIN `cij_dashboard`.lending b ON a.No_Factsheet=b.no_factsheet JOIN cij_dashboard.finteches c ON b.fintech_id=c.id WHERE b.status_pembiayaan=1 GROUP BY b.fintech_id) x'),
        function($join){
            $join->on('lending.fintech_id','=','x.fintech_id');
        })
        ->select(DB::raw('
        finteches.id as fintech_id,
        finteches.name as nama_fintech,
        finteches.logo as logo,
        (select round(SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0))/limit_kredit_fintech.nominal*100,2)) as persen_limit,
        SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS plafon_aktif,
        SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0))-x.pokok AS baki_debet,
        SUM(if(lending.status_pembiayaan=2,lending.nominal_pembiayaan,0)) AS nominal_ditolak,
        SUM(if(lending.status_pembiayaan=3,lending.nominal_pembiayaan,0)) AS nominal_lunas,
        SUM(if(lending.status_pembiayaan=4,lending.nominal_pembiayaan,0)) AS nominal_new,
        SUM(if(lending.status_pembiayaan=5,lending.nominal_pembiayaan,0)) AS nominal_on_process,
        SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS outstanding,
        SUM(if(lending.status_pembiayaan=3,lending.nominal_bunga,0)) AS pendapatan_bunga,
        limit_kredit_fintech.nominal AS nominal_limit,
        limit_kredit_fintech.nominal-SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS sisa_limit,
        SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0))+SUM(if(lending.status_pembiayaan=3,lending.nominal_pembiayaan,0)) AS nominal_total,
        (SELECT limit_kredit_fintech.nominal WHERE limit_kredit_fintech.fintech_id=lending.fintech_id)-SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS sisa_limit,
        ROUND(((SELECT limit_kredit_fintech.nominal WHERE limit_kredit_fintech.fintech_id=lending.fintech_id)-SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)))/(SELECT limit_kredit_fintech.nominal WHERE limit_kredit_fintech.fintech_id=lending.fintech_id)*100,2) AS persen_limit,
        100-round(SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0))/limit_kredit_fintech.nominal*100,2) AS sisa_persen'))
        ->groupBy('nama_fintech')
        ->havingRaw('nominal_total > 0')
        ->orderByDesc('plafon_aktif')
        ->orderByDesc('outstanding')
        ->get();

        $this->pendapatan_bunga = DB::select('select getPendapatanBunga() as pendapatan_bunga');
        
        $this->dataNominal2= DB::table('lending')->select(DB::raw('
        sum(if(EXTRACT(YEAR_MONTH FROM lending.jatuh_tempo)=extract(year_month from date(NOW())) && lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS nominal_jatuh_tempo_bulan_ini,
        sum(if(EXTRACT(YEAR_MONTH FROM lending.jatuh_tempo)=extract(year_month from date(NOW())) && lending.status_pembiayaan=1,lending.nominal_bunga,0)) AS pbyad
        '))
        ->get();
        // dd($this->dataNominal2);

        $this->lokasiBorrowerJawaBarat = DB::table('lending')->select(DB::raw(' 
        COUNT(id) AS jml_borrower,
        SUM(nominal_pembiayaan) AS nominal,
        (SELECT sum(nominal_pembiayaan) FROM lending WHERE status_pembiayaan=1) total_nominal,
        round(sum(nominal_pembiayaan)/(SELECT sum(nominal_pembiayaan) FROM lending WHERE status_pembiayaan=1)*100,2) AS persen
        '))
        ->where('status_pembiayaan',1)
        ->where('lokasi_perusahaan',1)
        ->get();

        $this->lokasiBorrowerLuarJawaBarat = DB::table('lending')->select(DB::raw(' 
        COUNT(id) AS jml_borrower,
        SUM(nominal_pembiayaan) AS nominal,
        (SELECT sum(nominal_pembiayaan) FROM lending WHERE status_pembiayaan=1) total_nominal,
        round(sum(nominal_pembiayaan)/(SELECT sum(nominal_pembiayaan) FROM lending WHERE status_pembiayaan=1)*100,2) AS persen
        '))
        ->where('status_pembiayaan',1)
        ->where('lokasi_perusahaan',2)
        ->get();

        
    }

    public function getLimitFintech($fintechId)
    {
        $limitFintech = DB::table('lending')
        ->join('finteches','lending.fintech_id','=','finteches.id')
        ->join('limit_kredit_fintech','lending.fintech_id','limit_kredit_fintech.fintech_id')
        ->select(DB::raw('
        finteches.name,
        finteches.logo,
        SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS outstanding,
        round(SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0))/limit_kredit_fintech.nominal*100,2) AS persen_outstanding,
        limit_kredit_fintech.nominal AS nominal_limit,
        limit_kredit_fintech.nominal-SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0)) AS sisa_limit,
        100-round(SUM(if(lending.status_pembiayaan=1,lending.nominal_pembiayaan,0))/limit_kredit_fintech.nominal*100,2) AS sisa_persen
        '))
        ->where('fintech_id',$fintechId)
        ->groupBy('name')
        ->orderByDesc('outstanding')
        ->get();
        return $limitFintech;
    }

    public function render()
    {
        return view('livewire.app.dashboard.p2p.component.nominal-pembiayaan');
    }
}
