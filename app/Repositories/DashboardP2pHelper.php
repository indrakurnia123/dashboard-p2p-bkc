<?php

namespace App\Repositories;
use Carbon\Carbon;
use App\Repositories\Helper;
use App\TransaksiKredit;
use App\Lending;
use Illuminate\Support\Facades\DB;

class DashboardP2pHelper
{
    
    public function deleteJadwalAngsuranByNoRekening($noRekening)
    {
        DB::table('transaksi_kredit')->where('no_rekening',$noRekening)->delete();
    }

    public function tanggalAngsuran(string $tanggal,int $increment,int $tanggal_angsuran)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d',$tanggal);
		$tahun = $tanggal->format('Y');
		$bulan = $tanggal->format('m');
		$hari = $tanggal_angsuran;
		
		$tahun += floor($increment/12);
		$increment = $increment%12;
		$bulan += $increment;

		if($bulan > 12){
			$tahun ++;
			$bulan = $bulan % 12;
			if ($bulan === 0 ){
				$bulan=12;
			}
		}

		if (!checkdate($bulan,$hari,$tahun)){
			$tanggal_angsuran=Carbon::createFromFormat("Y-m",$tahun."-".$bulan);
            $tanggal_angsuran->modify('last day of');
		}else{
			$tanggal_angsuran = Carbon::createFromFormat('Y-m-d', $tahun.'-'.$bulan.'-'.$hari);
		}
		return strval($tanggal_angsuran->format('Y-m-d'));
    }

    public function createJadwalAngsuranBallonPayment(Array $dataAngsuran)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d',$dataAngsuran['tanggal_pembiayaan']);
        $jadwalAngsuran=Array();
        $helper = new Helper;
        $kode_transaksi='200';
        $tanggal_angsuran=$tanggal->format('d');
        $tanggal_periode=$tanggal->toDateString();

        for($angsuran_ke=1;$angsuran_ke<=$dataAngsuran['jangka_waktu'];$angsuran_ke++)
        {
            if($angsuran_ke==$dataAngsuran['jangka_waktu'])
            {
                $angsuran_pokok = $dataAngsuran['nominal_pembiayaan'];
            }else{
                $angsuran_pokok = 0;
            }
            $angsuran_bunga = ceil($dataAngsuran['nominal_pembiayaan']*($dataAngsuran['suku_bunga_per_tahun']/12/100));

            // buat tanggal angsuran bulan ini
            $tanggal_angsuran_bulan_ini=$this->tanggalAngsuran($tanggal_periode,1,$tanggal_angsuran);
            $jadwalAngsuran[$angsuran_ke-1]=new TransaksiKredit([
                    'trans_id'=>date('Ymd').'-'.$helper->getRandomString(4),
                    'no_factsheet'=>$dataAngsuran['no_factsheet'],
                    'tanggal'=>$tanggal_angsuran_bulan_ini,
                    'no_rekening'=>$dataAngsuran['no_rekening'],
                    'nama_nasabah'=>$dataAngsuran['nama_nasabah'],
                    'kode'=>$kode_transaksi,
                    'pokok'=>$angsuran_pokok,
                    'bunga'=>$angsuran_bunga,
                    'pinalti'=>0,
                    'denda'=>0,
                    'titipan'=>0,
                    'total'=>$angsuran_pokok+$angsuran_bunga,
                    'T_O'=>'O',
                    'uraian'=>'Angsuran ke '.$angsuran_ke.' '.$dataAngsuran['nama_nasabah'],
                    'teller'=>'dashboard-p2p',
                    'regtime'=>date('Y-m-d H:i:s'),
                    'status_rek'=>3,
                    'status'=>1
                ]);
                $tanggal_periode=$tanggal_angsuran_bulan_ini;
        }
        // dd($jadwalAngsuran);
        return $jadwalAngsuran;
    }

    public function createJadwalAngsuranBulletPayment(Array $dataAngsuran)
    {
        $tanggal = Carbon::createFromFormat('Y-m-d',$dataAngsuran['tanggal_pembiayaan']);
        $jadwalAngsuran=Array();
        $helper = new Helper;
        $kode_transaksi='200';
        $tanggal_angsuran=$tanggal->format('d');
        $tanggal_periode=$tanggal->toDateString();

        if($dataAngsuran['type_jangka_waktu']==1)
        {
            $tanggal_angsuran_bulan_ini=$this->tanggalAngsuran($tanggal_periode,1,$tanggal_angsuran);
        }else{
            $tanggal_angsuran_bulan_ini=$this->tanggalAngsuran($tanggal_periode,$dataAngsuran['jangka_waktu'],$tanggal_angsuran);
        }
        $angsuran_pokok = $dataAngsuran['nominal_pembiayaan'];
        $angsuran_bunga = ceil(($dataAngsuran['nominal_pembiayaan']*($dataAngsuran['suku_bunga_per_tahun']/12/100))*$dataAngsuran['jangka_waktu']);
        $jadwalAngsuran[0]=new TransaksiKredit([
                'trans_id'=>date('Ymd').'-'.$helper->getRandomString(4),
                'no_factsheet'=>$dataAngsuran['no_factsheet'],
                'tanggal'=>$tanggal_angsuran_bulan_ini,
                'no_rekening'=>$dataAngsuran['no_rekening'],
                'nama_nasabah'=>$dataAngsuran['nama_nasabah'],
                'kode'=>$kode_transaksi,
                'pokok'=>$angsuran_pokok,
                'bunga'=>$angsuran_bunga,
                'pinalti'=>0,
                'denda'=>0,
                'titipan'=>0,
                'total'=>$angsuran_pokok+$angsuran_bunga,
                'T_O'=>'O',
                'uraian'=>'Angsuran ke 1 '.$dataAngsuran['nama_nasabah'],
                'teller'=>'dashboard-p2p',
                'regtime'=>date('Y-m-d H:i:s'),
                'status_rek'=>3,
                'status'=>1
            ]);
        return $jadwalAngsuran;
    }

    public function getPmtValue($nominal_pembiayaan,$suku_bunga_per_tahun,$jangka_waktu)
    {
        // PMT = P * r * (1 + r)^n / ((1 + r)^n - 1)

        // P adalah jumlah pinjaman atau nilai total hutang
        // r adalah tingkat bunga per tahun, dibagi dengan 12 untuk menghitung bunga per bulan
        // n adalah jumlah bulan pembayaran
        $suku_bunga_per_bulan=$suku_bunga_per_tahun/100/12;
        $pmt=$nominal_pembiayaan*$suku_bunga_per_bulan*pow((1 + $suku_bunga_per_bulan), $jangka_waktu) / (pow((1 + $suku_bunga_per_bulan), $jangka_waktu) - 1);
        $pmt=bcdiv($pmt,1,2);
        return ceil($pmt);
    }

    public function getPpmtValue($pmt,$nominal_pembiayaan,$suku_bunga_per_tahun,$jangka_waktu)
    {

        $suku_bunga_per_bulan=$suku_bunga_per_tahun/100/12;

        // Menghitung PPMT
        $ppmt=0;
        for ($i = 1; $i <= $jangka_waktu; $i++) {
            $ipmt = ($nominal_pembiayaan - $ppmt) * $suku_bunga_per_bulan; // Menghitung IPMT
            $ppmt = $pmt - $ipmt; // Menghitung PPMT
            return $ppmt;
        }

    }

    public function createJadwalAngsuranInstallment($dataAngsuran)
    {
        $nominal_pembiayaan = $dataAngsuran['nominal_pembiayaan'];
        $suku_bunga_per_tahun = $dataAngsuran['suku_bunga_per_tahun'];
        $jangka_waktu = $dataAngsuran['jangka_waktu'];
        $jangka_waktu_hari = $jangka_waktu*30;
        $total_repayment_per_bulan=round($this->getPmtValue($nominal_pembiayaan,$suku_bunga_per_tahun,$jangka_waktu));
        $sisa_pinjaman=$nominal_pembiayaan;

        
        $tanggal = Carbon::createFromFormat('Y-m-d',$dataAngsuran['tanggal_pembiayaan']);
        $jadwalAngsuran=Array();
        $helper = new Helper;
        $kode_transaksi='200';
        $platform_fee_cicil=4000;
        $tanggal_angsuran=$tanggal->format('d');
        $tanggal_periode=$tanggal->toDateString();
        // dd($sisa_pinjaman);
        for($angsuran_ke=1;$angsuran_ke<=$jangka_waktu;$angsuran_ke++)
        {
            $tanggal_angsuran_bulan_ini=$this->tanggalAngsuran($tanggal_periode,1,$tanggal_angsuran);
            $angsuran_pokok=round($this->getPpmtValue($total_repayment_per_bulan,$sisa_pinjaman,$suku_bunga_per_tahun,$jangka_waktu));
            $angsuran_bunga=$total_repayment_per_bulan-$angsuran_pokok;
            $jadwalAngsuran[$angsuran_ke-1]=new TransaksiKredit([
                'trans_id'=>date('Ymd').'-'.$helper->getRandomString(4),
                'no_factsheet'=>$dataAngsuran['no_factsheet'],
                'tanggal'=>$tanggal_angsuran_bulan_ini,
                'no_rekening'=>$dataAngsuran['no_rekening'],
                'nama_nasabah'=>$dataAngsuran['nama_nasabah'],
                'kode'=>$kode_transaksi,
                'pokok'=>$angsuran_pokok,
                'bunga'=>$angsuran_bunga,
                'pinalti'=>0,
                'denda'=>0,
                'titipan'=>0,
                'total'=>$angsuran_pokok+$angsuran_bunga,
                'T_O'=>'O',
                'uraian'=>'Angsuran ke '.$angsuran_ke.' '.$dataAngsuran['nama_nasabah'],
                'teller'=>'dashboard-p2p',
                'regtime'=>date('Y-m-d H:i:s'),
                'status_rek'=>3,
                'status'=>1
            ]);
            $sisa_pinjaman=$sisa_pinjaman-$angsuran_pokok;
            // dd($sisa_pinjaman);
            $tanggal_periode=$tanggal_angsuran_bulan_ini;
        }
        return $jadwalAngsuran;
    }

public function createJadwalAngsuranByNoFactsheet($noFactsheet)
    {
        $helper = new Helper;

        // cek apakah sudah ada rekening

        // cek data pembiayaan berdasarkan nomor factsheet
        $lending = Lending::where('no_factsheet',$noFactsheet)->get();
        $bakiDebet=$lending[0]->nominal_pembiayaan;
        $tanggalRealisasi = Carbon::createFromFormat('Y-m-d',$lending[0]->tanggal_pembiayaan);
        $tanggalSekarang = date('Y-m-d');

        // cek apakah sudah ada jadwal angsuran rekening tersebut
        $jadwalCreated = DB::table('transaksi_kredit')->where('no_rekening',$lending[0]->no_rekening)->where('no_factsheet',$noFactsheet)->where('kode','200')->get();

        // hapus jadwal angsuran jika sudah ada
        if(!$jadwalCreated->isEmpty())
        {
            $this->deleteJadwalAngsuranByNoRekening($lending[0]->no_rekening);
        }
        $dataAngsuran=Array(
            'no_factsheet'=>$lending[0]->no_factsheet,
            'nominal_pembiayaan'=>$lending[0]->nominal_pembiayaan,
            'jangka_waktu'=>$lending[0]->jangka_waktu,
            'suku_bunga_per_tahun'=>$lending[0]->bunga*100,
            'tanggal_pembiayaan'=>$lending[0]->tanggal_pembiayaan,
            'no_rekening'=>$lending[0]->no_rekening,
            'nama_nasabah'=>$lending[0]->borrowerData->nama,
            'type_jangka_waktu'=>$lending[0]->type_jangka_waktu
        );
        if($lending[0]->sifat_pembiayaan==2)
        {
            // buat jadwal angsuran baru Ballon Payment
            $angsuran=$this->createJadwalAngsuranBallonPayment($dataAngsuran);

            // simpan jadwal angsuran ke database tabel transaksi kredit
            foreach($angsuran as $item)
            {
                $save = $item->save();
                if(!$save)
                {
                    $status = ['code'=>'01','message'=>'Gagal Create Jadwal Angsuran'];
                    return $status;
                }
            }
        }elseif($lending[0]->sifat_pembiayaan==3)
        {
            // buat jadwal angsuran baru Bullet Payment
            $angsuran=$this->createJadwalAngsuranBulletPayment($dataAngsuran);

            // simpan jadwal angsuran ke database tabel transaksi kredit
            foreach($angsuran as $item)
            {
                $save = $item->save();
                if(!$save)
                {
                    $status = ['code'=>'01','message'=>'Gagal Create Jadwal Angsuran'];
                    return $status;
                }
            }

        }else{
            
            // buat jadwal angsuran baru Bullet Payment
            $angsuran=$this->createJadwalAngsuranInstallment($dataAngsuran);

            // simpan jadwal angsuran ke database tabel transaksi kredit
            foreach($angsuran as $item)
            {
                $save = $item->save();
                if(!$save)
                {
                    $status = ['code'=>'01','message'=>'Gagal Create Jadwal Angsuran'];
                    return $status;
                }
            }
        }
        $status = ['code'=>'00','message'=>'Berhasil create jadwal angsuran'];
        return $status;
    }
}