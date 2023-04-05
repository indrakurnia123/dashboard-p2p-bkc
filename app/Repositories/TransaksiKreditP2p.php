<?php

namespace App\Repositories;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use App\Repositories\Helper;
use App\Repositories\DashboardP2pHelper;
use App\TransaksiKredit;
use App\Lending;

class TransaksiKreditP2p
{
    public function transaksiUpdateStatusFactsheet($noFactsheet,$status)
    {
        $prosesFactsheet=Lending::where('no_factsheet',$noFactsheet)->update('status_pembiayaan',$status);
        if($prosesFactsheet)
        {
            $status=['code'=>'00','message'=>'update status berhasil'];
        }else{
            $status=['code'=>'01','message'=>'update status gagal'];
        }
        return $status;
    }

    public function transaksiRealisasiFactsheet($dataTransaksi)
    {
        $helper = new Helper;
        $p2p = new DashboardP2pHelper;
        $lending = Lending::where('no_factsheet',$dataTransaksi['no_factsheet'])->get();
        $traksaksiKreditData=TransaksiKredit::where('no_factsheet',$dataTransaksi['no_factsheet'])->where('kode','42.2')->get();
        if($lending[0]->status_pembiayaan==1)
        {
            $status=['code'=>'01','message'=>'Rekening sudah aktif'];
            return $status;
        }
        if(!$traksaksiKreditData->isEmpty())
        {
            $status=['code'=>'01','message'=>'Transaksi Realisasi sudah ada !!'];
            return $status;
        }

        $transaksiKredit=TransaksiKredit::create([
            'no_factsheet'=>$dataTransaksi['no_factsheet'],
            'trans_id'=>date('Ymd').$helper->getRandomString(4),
            'tanggal'=>$dataTransaksi['tanggal'],
            'no_rekening'=>$dataTransaksi['no_rekening'],
            'nama_nasabah'=>$dataTransaksi['nama_nasabah'],
            'kode'=>'42.2',
            'pokok'=>$dataTransaksi['pokok'],
            'bunga'=>0,
            'pinalti'=>0,
            'denda'=>0,
            'titipan'=>0,
            'total'=>$dataTransaksi['pokok'],
            'T_O'=>'O',
            'uraian'=>'Realisasi P2P Lending No Factsheet '.$dataTransaksi['no_factsheet'],
            'teller'=>'dashboard-p2p',
            'regtime'=>date('Y-m-d H:i:s'),
            'status_rek'=>3,
            'status'=>1
        ]);

        if($transaksiKredit)
        {
            $status=['code'=>'00','message'=>'transaksi berhasil'];
            return $status;
        }else{
            $status=['code'=>'01','message'=>'transaksi gagal'];
            return $status;
        }
    }

    public function transaksiHapusRealisasiFactsheet($noFactsheet)
    {
        $deteteTransaksi=TransaksiKredit::where('no_factsheet',$noFactsheet)->where('kode','42.2')->delete();
        if($deteteTransaksi)
        {
            $status=['code'=>'00','message'=>'hapus transaksi berhasil'];
        }else{
            $status=['code'=>'01','message'=>'hapus transaksi gagal'];
        }
        return $status;
    }
}