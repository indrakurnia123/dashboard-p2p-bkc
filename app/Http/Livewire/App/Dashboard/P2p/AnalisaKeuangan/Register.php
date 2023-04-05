<?php

namespace App\Http\Livewire\App\Dashboard\P2p\AnalisaKeuangan;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Repositories\Helper;
use App\AnalisaKeuangan;
use App\Lending;
use App\Fintech;
use App\Perkiraan;
use App\RatingPefindo;
use App\TrenPefindo;
use App\KualitasKredit;
use App\FactsheetPayor;
use App\LaporanKeuangan;
use App\AnalisaKeuanganFactsheet;
use App\Payor;
use App\MitigasiRisiko;

class Register extends Component
{
    use WithPagination;

    protected $listeners=['getSelectedFactsheetDetail','refreshComponent'=>'$refresh'];
    public $finteches=null;
    public $tanggalAnalisaKeuangan;
    public $fintechId=null;
    public $newAnalisaKeuanganFactsheet;
    public $selectedNoFactsheet;
    public $selectedLendingData;
    public $dataTtd;

    public $ratingPefindo;
    public $trenPefindo;
    public $laporanKeuangan=Array();
    public $pefindoData=Array();
    public $slikData=Array();
    public $selectedFactsheets=Array();
    
    public function mount()
    {
        $this->selectedNoFactsheet="";
        $this->finteches=Fintech::all();
        $this->ratingPefindo=RatingPefindo::all();
        $this->trenPefindo=TrenPefindo::all();
        $this->kualitasKredit=KualitasKredit::all();
        $this->slikData=[
            'kolektibilitas_terkini'=>null,
            'riwayat_kolektibilitas'=>null,
            'outstanding_aktif'=>0,
        ];
        $this->pefindoData=[
            'score'=>null,
            'nilai'=>0,
            'usia_tunggakan'=>null,
            'tren'=>null,
            'nominal_tunggakan'=>null
        ];
        $this->laporanKeuangan=[
            'tanggal_analisa_keuangan'=>null,
            'tanggal_laporan_keuangan'=>null,
            'fintech_id'=>null,
            'borrower_id'=>null,
            'aset'=>[
                'current_asset'=>[
                    'kas'=>0,
                    'piutang_usaha'=>0,
                    'persediaan_barang'=>0,
                    'piutang_lain_lain'=>0
                ],
                'fixed_asset'=>[
                    'tanah_dan_bangunan'=>0,
                    'kendaraan_mesin_inv'=>0,
                    'aset_lain'=>0
                ],
            ],
            'kewajiban'=>[
                'hutang_jangka_pendek'=>[
                    'hutang_dagang'=>0,
                    'hutang_bank'=>0,
                    'hutang_leasing'=>0,
                    'hutang_pajak'=>0,
                    'biaya_lainnya'=>0,
                    'hutang_lainnya'=>0,
                ],
                'hutang_jangka_panjang'=>[
                    'hutang_jangka_panjang'=>0,
                ]
            ],
            'ekuitas'=>[
                'ekuitas'=>0,
            ],
            'pendapatan'=>[
                'sales_pendapatan'=>0,
            ],
            'biaya'=>[
                'hpp'=>0,
                'biaya_usaha'=>0,
            ],

            'total_current_asset'=>0,
            'total_fixed_asset'=>0,
            'total_aset'=>0,

            'total_hutang_jangka_pendek'=>0,
            'total_hutang_jangka_panjang'=>0,
            'total_kewajiban'=>0,
            'total_ekuitas'=>0,
            'total_kewajiban_dan_ekuitas'=>0,
            
            'gross_profit'=>0,
            'gpm'=>0,
            'nett_income'=>0,
            'total_kewajiban'=>0,
            'account_receivable'=>0,
            'account_payable'=>0,
            'pembiayaan_mk_bank'=>0,
            'wi_need'=>0,
            'inventory_doh'=>0,
            'account_receivable_doh'=>0,
            'account_payable_doh'=>0,
            
            'nilai_invoice'=>0,
            'total_plafon_penawaran'=>0,
            'rasio'=>[
                'cash_ratio'=>0,
                'current_ratio'=>0,
                'quick_ratio'=>0
            ],

            'is_balance'=>False,
            'slik_data'=>[
                'kualitas_terkini'=>null,
                'riwayat_kualitas'=>null,
                'outstanding_aktif'=>0,
                'bobot'=>0,
            ],
            'pefindo_data'=>[
                'score'=>null,
                'nilai'=>0,
                'usia_tunggakan'=>null,
                'tren'=>null,
                'nominal_tunggakan'=>0,
                'bobot'=>0,
            ],
            'maksimal_rekomendasi_pendanaan'=>0,
            'nominal_invoice'=>0,
            'persentase_invoice'=>0,

            'deskripsi_mitigasi'=>"",
            'deskripsi_keterangan'=>"",
            'deskripsi_tujuan'=>"",
            'deskripsi_latar_belakang'=>"",
            'deskripsi_sumber_pembayaran'=>"",
            'deskripsi_kualitatif'=>"",
            'kesimpulan_komite'=>"",
            'riwayat_recurring'=>"",
            'usulan_plafon_didanai'=>0,
            'ttd_1'=>null,
            'ttd_2'=>null,
            'ttd_3'=>null,
            'ttd_4'=>null,
        ];
        $this->updateDataLaporanKeuangan();
    }

    public function getPayorNameByFactsheet($noFactsheet)
    {
        $data = collect(DB::select('select nama from payor where id in (select payor_id from factsheet_payor where no_factsheet=?)',[$noFactsheet]));
        return $data;
    }

    public function getSelectedFactsheetDetail($noFactsheet)
    {
        $helper = new Helper;
        $this->selectedLendingData = collect(DB::select("SELECT a.no_factsheet,
        b.nama AS nama_borrower,
        a.plafon_penawaran,
        CONCAT(a.jangka_waktu,' ',c.nama) AS jangka_waktu,
        d.nama as sifat_pembiayaan
        FROM
        lending a,
        borrower b,
        type_jangka_waktu c,
        sifat_pembiayaan d,
        (SELECT fintech_id,borrower,tanggal_pembiayaan FROM lending WHERE no_factsheet=?) e
        WHERE
        a.borrower=b.id
        AND a.type_jangka_waktu=c.id
        AND a.sifat_pembiayaan=d.id
        AND a.fintech_id=e.fintech_id
        AND a.tanggal_pembiayaan=e.tanggal_pembiayaan
        AND a.borrower=e.borrower
        ORDER BY a.id desc",[$noFactsheet]));

        $this->laporanKeuangan['total_plafon_penawaran']=$this->selectedLendingData->sum('plafon_penawaran');
    }

    public function updatedSlikData()
    {
        $this->laporanKeuangan['pembiayaan_mk_bank']=$this->slikData['outstanding_aktif'];
    }

    public function updatedSelectedLendingData()
    {
        $this->resetPage();
    }

    public function updatedLaporanKeuangan()
    {
        $this->updateDataLaporanKeuangan();
    }

    public function updateDataLaporanKeuangan()
    {
            $helper = new Helper;
            $this->laporanKeuangan['total_current_asset']=array_sum($this->laporanKeuangan['aset']['current_asset']);
            $this->laporanKeuangan['total_fixed_asset']=array_sum($this->laporanKeuangan['aset']['fixed_asset']);
            $this->laporanKeuangan['total_aset']=$this->laporanKeuangan['total_current_asset']+$this->laporanKeuangan['total_fixed_asset'];
            
            $this->laporanKeuangan['total_hutang_jangka_pendek']=array_sum($this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']);
            $this->laporanKeuangan['total_hutang_jangka_panjang']=array_sum($this->laporanKeuangan['kewajiban']['hutang_jangka_panjang']);
            $this->laporanKeuangan['total_hutang']=$this->laporanKeuangan['total_hutang_jangka_pendek']+$this->laporanKeuangan['total_hutang_jangka_panjang'];
            $this->laporanKeuangan['total_ekuitas']=array_sum($this->laporanKeuangan['ekuitas']);
            $this->laporanKeuangan['total_kewajiban_dan_ekuitas']=$this->laporanKeuangan['total_hutang']+$this->laporanKeuangan['total_ekuitas'];

            $this->laporanKeuangan['total_kewajiban']=$this->laporanKeuangan['total_hutang_jangka_pendek']+$this->laporanKeuangan['total_hutang_jangka_panjang'];

            $this->laporanKeuangan['gross_profit']=array_sum($this->laporanKeuangan['pendapatan'])-$this->laporanKeuangan['biaya']['hpp'];
            if($this->laporanKeuangan['pendapatan']['sales_pendapatan']==0)
            {
                $this->laporanKeuangan['gpm']=0;
            }else{
                $this->laporanKeuangan['gpm']=$this->laporanKeuangan['gross_profit']/$this->laporanKeuangan['pendapatan']['sales_pendapatan'];
            }
            $this->laporanKeuangan['nett_income']=$this->laporanKeuangan['gross_profit']-$this->laporanKeuangan['biaya']['biaya_usaha'];
            
            $this->laporanKeuangan['wi_need']=($this->laporanKeuangan['aset']['current_asset']['persediaan_barang']+$this->laporanKeuangan['aset']['current_asset']['piutang_usaha'])-($this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_dagang']+$this->laporanKeuangan['pembiayaan_mk_bank']);
            
            $this->laporanKeuangan['inventory_doh']=$helper->getInventoryDoh($this->laporanKeuangan['tanggal_laporan_keuangan'],$this->laporanKeuangan['aset']['current_asset']['persediaan_barang'],$this->laporanKeuangan['biaya']['hpp']);
            
            $this->laporanKeuangan['account_receivable_doh']=$helper->getAccountReceivableDoh($this->laporanKeuangan['tanggal_laporan_keuangan'],$this->laporanKeuangan['aset']['current_asset']['piutang_usaha'],$this->laporanKeuangan['pendapatan']['sales_pendapatan']);
           
            $this->laporanKeuangan['account_payable_doh']=$helper->getAccountPayableDoh($this->laporanKeuangan['tanggal_laporan_keuangan'],$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_dagang'],$this->laporanKeuangan['biaya']['hpp']);

            $this->laporanKeuangan['is_balance']=$helper->isBalance($this->laporanKeuangan);

            $this->laporanKeuangan['rasio']['cash_ratio']=$helper->getCashRatioFactsheet($this->laporanKeuangan);
            $this->laporanKeuangan['rasio']['current_ratio']=$helper->getCurrentRatioFactsheet($this->laporanKeuangan);
            $this->laporanKeuangan['rasio']['quick_ratio']=$helper->getQuickRatioFactsheet($this->laporanKeuangan);

            $this->laporanKeuangan['maksimal_rekomendasi_pendanaan']=$helper->getMaksimalRekomendasiPendanaan($this->laporanKeuangan);
            $this->laporanKeuangan['persentase_invoice']=$helper->getPersentaseInvoice($this->laporanKeuangan);

            $this->resetPage();
    }

    public function updatingLaporanKeuangan()
    {
        $this->resetPage();
    }

    public function updatedSelectedNoFactsheet()
    {
        $helper = new Helper;
        $this->resetPage();
    }

    public function storeAnalisa()
    {
        // dd("$this->laporanKeuangan['aset']['current_asset']['persediaan_barang']");
        $helper = new Helper;
        // $this->validate([
        //     'laporanKeuangan.tanggal_analisa_keuangan'=>'required',
        // ]);
        $kodeAnalisa = $helper->getRandomString(6);
        // dd($kodeAnalisa);
        $storeAnalisa = AnalisaKeuangan::create([
            'kode_analisa'=>$kodeAnalisa,
            'tanggal_analisa'=>$this->laporanKeuangan['tanggal_analisa_keuangan'],
            'fintech_id'=>$helper->getFintechId($this->selectedNoFactsheet),
            'borrower_id'=>$helper->getBorrowerId($this->selectedNoFactsheet),
            'total_plafon_penawaran'=>$this->laporanKeuangan['total_plafon_penawaran'],
            'slik_kualitas_terkini'=>$this->laporanKeuangan['slik_data']['kualitas_terkini'],
            'slik_riwayat_kualitas'=>$this->laporanKeuangan['slik_data']['riwayat_kualitas'],
            'slik_outstanding_aktif'=>$this->laporanKeuangan['slik_data']['outstanding_aktif'],
            'pefindo_score'=>$this->laporanKeuangan['pefindo_data']['score'],
            'pefindo_nilai'=>$this->laporanKeuangan['pefindo_data']['nilai'],
            'pefindo_usia_tunggakan'=>$this->laporanKeuangan['pefindo_data']['usia_tunggakan'],
            'pefindo_tren'=>$this->laporanKeuangan['pefindo_data']['tren'],
            'pefindo_nominal_tunggakan'=>$this->laporanKeuangan['pefindo_data']['nominal_tunggakan'],
            'tanggal_laporan_keuangan'=>$this->laporanKeuangan['tanggal_laporan_keuangan'],
            'aset_current_asset_kas'=>$this->laporanKeuangan['aset']['current_asset']['kas'],
            'aset_current_asset_piutang_usaha'=>$this->laporanKeuangan['aset']['current_asset']['piutang_usaha'],
            'aset_current_asset_persediaan_barang'=>$this->laporanKeuangan['aset']['current_asset']['persediaan_barang'],
            'aset_current_asset_piutang_lain_lain'=>$this->laporanKeuangan['aset']['current_asset']['piutang_lain_lain'],
            'aset_fixed_asset_tanah_dan_bangunan'=>$this->laporanKeuangan['aset']['fixed_asset']['tanah_dan_bangunan'],
            'aset_fixed_asset_kendaraan_mesin_inv'=>$this->laporanKeuangan['aset']['fixed_asset']['kendaraan_mesin_inv'],
            'aset_fixed_asset_aset_lain'=>$this->laporanKeuangan['aset']['fixed_asset']['aset_lain'],
            'kewajiban_hutang_jangka_pendek_hutang_dagang'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_dagang'],
            'kewajiban_hutang_jangka_pendek_hutang_bank'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_bank'],
            'kewajiban_hutang_jangka_pendek_hutang_leasing'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_leasing'],
            'kewajiban_hutang_jangka_pendek_hutang_pajak'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_pajak'],
            'kewajiban_hutang_jangka_pendek_hutang_lainnya'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_lainnya'],
            'kewajiban_hutang_jangka_panjang_hutang_jangka_panjang'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_panjang']['hutang_jangka_panjang'],
            'ekuitas_ekuitas'=>$this->laporanKeuangan['ekuitas']['ekuitas'],
            'pendapatan_sales_pendapatan'=>$this->laporanKeuangan['pendapatan']['sales_pendapatan'],
            'biaya_hpp'=>$this->laporanKeuangan['biaya']['hpp'],
            'biaya_biaya_usaha'=>$this->laporanKeuangan['biaya']['biaya_usaha'],
            'total_aset'=>$this->laporanKeuangan['total_aset'],
            'total_current_asset'=>$this->laporanKeuangan['total_current_asset'],
            'total_fixed_asset'=>$this->laporanKeuangan['total_fixed_asset'],
            'total_kewajiban'=>$this->laporanKeuangan['total_kewajiban'],
            'total_ekuitas'=>$this->laporanKeuangan['total_ekuitas'],
            // 'total_pendapatan'=>$this->laporanKeuangan['total_pendapatan'],
            // 'total_biaya'=>$this->laporanKeuangan['total_biaya'],
            'gross_profit'=>$this->laporanKeuangan['gross_profit'],
            'gpm'=>$this->laporanKeuangan['gpm'],
            'nett_income'=>$this->laporanKeuangan['nett_income'],
            'total_hutang_jangka_pendek'=>$this->laporanKeuangan['total_hutang_jangka_pendek'],
            'total_hutang_jangka_panjang'=>$this->laporanKeuangan['total_hutang_jangka_panjang'],
            'inventory'=>$this->laporanKeuangan['aset']['current_asset']['persediaan_barang'],
            'account_receivable'=>$this->laporanKeuangan['aset']['current_asset']['piutang_usaha'],
            'account_payable'=>$this->laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_dagang'],
            'pembiayaan_mk_bank'=>$this->laporanKeuangan['slik_data']['outstanding_aktif'],
            'wi_need'=>$this->laporanKeuangan['wi_need'],
            'inventory_doh'=>$this->laporanKeuangan['inventory_doh'],
            'account_receivable_doh'=>$this->laporanKeuangan['account_receivable_doh'],
            'account_payable_doh'=>$this->laporanKeuangan['account_payable_doh'],
            'cash_ratio'=>$this->laporanKeuangan['rasio']['cash_ratio'],
            'current_ratio'=>$this->laporanKeuangan['rasio']['current_ratio'],
            'quick_ratio'=>$this->laporanKeuangan['rasio']['quick_ratio'],
            'maksimal_rekomendasi_pendanaan'=>$this->laporanKeuangan['maksimal_rekomendasi_pendanaan'],
            'nilai_invoice'=>$this->laporanKeuangan['nilai_invoice'],
            'persentase_invoice'=>$this->laporanKeuangan['persentase_invoice'],
            'deskripsi_keterangan'=>$this->laporanKeuangan['deskripsi_keterangan'],
            'deskripsi_tujuan'=>$this->laporanKeuangan['deskripsi_tujuan'],
            'deskripsi_latar_belakang'=>$this->laporanKeuangan['deskripsi_latar_belakang'],
            'deskripsi_sumber_pembayaran'=>$this->laporanKeuangan['deskripsi_sumber_pembayaran'],
            'deskripsi_kualitatif'=>$this->laporanKeuangan['deskripsi_kualitatif'],
            'riwayat_recurring'=>$this->laporanKeuangan['riwayat_recurring'],
            'kesimpulan_komite'=>$this->laporanKeuangan['kesimpulan_komite'],
            'usulan_plafon_didanai'=>$this->laporanKeuangan['usulan_plafon_didanai'],
        ]);

        if($storeAnalisa)
        {
            $fintechId = $helper->getFintechId($this->selectedNoFactsheet);
            $borrowerId = $helper->getBorrowerId($this->selectedNoFactsheet);
            $tanggalPembiayaan = $helper->getTanggalPembiayaan($this->selectedNoFactsheet);
            // dd($fintechId,$borrowerId,$tanggalPembiayaan);

            // $lendingId = DB::select('select id,fintech_id,borrower,tanggal_pembiayaan from lending where fintech_id in (?) and tanggal_pembiayaan in (?) and borrower=?',array($fintechId,$borrowerId,$tanggalPembiayaan));
            $lendingId = DB::table('lending')->where('fintech_id',$fintechId)->where('borrower',$borrowerId)->where('tanggal_pembiayaan',$tanggalPembiayaan)->get();

            // dd($lendingId);

            foreach($lendingId as $item)
            {
                $updateAnalisaId = Lending::where('no_factsheet',$item->no_factsheet)
                ->update([
                    'analisa_keuangan_id'=>$storeAnalisa->id,
                ]);
                if($updateAnalisaId){
                    $this->dispatchBrowserEvent('swal:mixin',[
                        'position'=>'top-right',
                        'icon'=>'success',
                        'title'=>'berhasil update data factsheet'
                    ]);
                }else{
                    $this->dispatchBrowserEvent('swal:mixin',[
                        'position'=>'top-right',
                        'icon'=>'error',
                        'title'=>'gagal update data factsheet'
                    ]);
                }
                $storeToAnalisaKeuanganFactsheet = AnalisaKeuanganFactsheet::updateOrCreate(
                    ['analisa_keuangan_id'=>$storeAnalisa->id,'no_factsheet'=>$item->no_factsheet],
                    ['analisa_keuangan_id'=>$storeAnalisa->id,'no_factsheet'=>$item->no_factsheet],
                );
                if($storeToAnalisaKeuanganFactsheet){
                    $this->dispatchBrowserEvent('swal:mixin',[
                        'position'=>'top-right',
                        'icon'=>'success',
                        'title'=>'berhasil create data analisa keuangan factsheet'
                    ]);
                }else{
                    $this->dispatchBrowserEvent('swal:mixin',[
                        'position'=>'top-right',
                        'icon'=>'error',
                        'title'=>'gagal create data analisa keuangan factsheet'
                    ]);
                }
                // $
                // $kodePerkiraan = DB::table('perkiraan')->where('parent',0)->get();
                // foreach($kodePerkiraan as $perkiraan)
                // {
                //     $saldo=$perkiraan->index_array;
                //     LaporanKeuangan::create(
                //         ['analisis_id'=>$storeAnalisa->id,'tanggal'=>$storeAnalisa->tanggal_analisa,'borrower_id'=>$borrowerId,'kode_perk'=>$perkiraan->kode],
                //         ['analisis_id'=>$storeAnalisa->id,'kode_analisa'=>$kodeAnalisa,'tanggal'=>$storeAnalisa->tanggal_analisa,'borrower_id'=>$borrowerId,'kode_perk'=>$perkiraan->kode,'saldo'=>$$saldo],
                //     );
                // }
            }

            $this->dispatchBrowserEvent('swal:fire',[
                'position'=>'center',
                'icon'=>'success',
                'title'=>'berhasil',
                'text'=>'berhasil simpan data analisa keuangan'
            ]);
            return redirect()->route('analisa.keuangan');
        }else{
            $this->dispatchBrowserEvent('swal:fire',[
                'position'=>'center',
                'icon'=>'error',
                'title'=>'Gagal',
                'text'=>'Gagal simpan data analisa keuangan'
            ]);
            return redirect()->back()->withInput(Input::all());
        }

    }

    public function render()
    {
        $this->updateDataLaporanKeuangan();
        return view('livewire.app.dashboard.p2p.analisa-keuangan.register',[
            'mitigasi_risiko'=>MitigasiRisiko::all(),
            'selectedLendingData'=>$this->getSelectedFactsheetDetail($this->selectedNoFactsheet),
            'lendings'=>DB::table('lending')
            ->join('borrower','lending.borrower','=','borrower.id')
            ->join('finteches','lending.fintech_id','=','finteches.id')
            ->select(DB::raw('count(lending.id) as jml_factsheet'),'finteches.name as nama_fintech','lending.fintech_id','lending.borrower','lending.no_factsheet','borrower.nama','lending.tanggal_pembiayaan','lending.tanggal_penawaran')
            ->groupBy('lending.tanggal_pembiayaan')
            ->groupBy('lending.borrower')
            ->groupBy('lending.fintech_id')
            ->orderByDesc('tanggal_pembiayaan')->get()
        ])->extends('layouts.master');
    }
}
