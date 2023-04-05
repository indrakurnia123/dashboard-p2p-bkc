<?php

namespace App\Repositories;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Helper
{

    public function dateToDatetime($date)
    {
        $datetime = Carbon::createFromFormat('Y-m-d',$date);
        return $datetime->format('Y-m-d H:i:s');
    }

    public function getTglJatuhTempo($tglAwal,$increment,$typeIncrement)
    {

        // Type Jangka Waktu
        // 1 = Bulan
        // 2 = Hari 

        // dd($tglAwal,$increment,$typeIncrement);

        if($typeIncrement==1)
        {
            $tglJatuhTempo = Carbon::createFromFormat('Y-m-d',$tglAwal)->addMonths($increment)->format('Y-m-d');
            // dd($tglJatuhTempo);

        }elseif($typeIncrement==2)
        {
            $tglJatuhTempo = Carbon::createFromFormat('Y-m-d',$tglAwal)->addDays($increment)->format('Y-m-d');
        }
        return $tglJatuhTempo;
    }
    
    public function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    public function random_color() {
        return $this->random_color_part() . $this->random_color_part() . $this->random_color_part();
    }

    public function getRandomColorHex()
    {
        $color = $this->random_color();
        return "#".$color;
    }
    public function toDecimalFormat($nominal)
    {
        $decimalFormat = str_replace(',','.',str_replace('.','',$nominal));

        return $decimalFormat;
    }

    public function toRupiahFormat($nominal,$belakangKoma)
    {
        $rupiahFormat = number_format($nominal,$belakangKoma,',','.');
        return $rupiahFormat;
    }

    public function getRegisterNumber($lastNumber,$officeCode,$requestDate)
    {
        if(intval($lastNumber) < 100 && intval($lastNumber)>10)
        {
            $number = '0'.intval($lastNumber)+1;
        }elseif(intval($lastNumber)<10){
            $number = '00'.intval($lastNumber)+1;
        }
        $date = Carbon::createFromFormat('Y-m-d',$requestDate);
        if($officeCode!='01')
        {
            $requestNumber = $number.'/'.'Restruk/'.'KC-'.$officeCode.'/'.$date->format("m").'/'.$date->format('Y');
        }else{
            $requestNumber = $number.'/'.'Restruk/'.'KPO'.'/'.$date->format("m").'/'.$date->format('Y');
        }
        return $requestNumber;
    }

    public function createNomorAnalisa($reg_number,$analysis_count)
    {
        if(intval($analysis_count)<10)
        {
            $count = '00'.intval($analysis_count)+1;
        }
        $analysis_code = $reg_number."/ANL/".$count;

        return $analysis_code;
    }

    public function createNoRegistrasiRapat($lastNumber,$requestDate)
    {
        if(intval($lastNumber+1) <100 && intval($lastNumber+1)>=10)
        {
            $number = '0'.intval($lastNumber)+1;
        }elseif(intval($lastNumber+1)<10){
            $number = '00'.intval($lastNumber)+1;
        }else{
            $number = intval($lastNumber)+1;
        }
        $date = Carbon::createFromFormat('Y-m-d',$requestDate);
        $noRegistrasiRapat = $number.'RPTCIJ'.$date->format("m").$date->format('Y').$this->getRandomString(4).$this->getRandomString(4);
        return $noRegistrasiRapat;
    }

    public function getRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }
    
        return $randomString;
    }

    public function getDocumentCode($code)
    {
        $code = explode('-',$code);
        return $code[0];
    }


    public function bulanID($bulan)
    {
        $namaBulan=Array(
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );
        return $namaBulan[intval($bulan)-1];
    }

    public function hariID($day)
    {
        $namaHari=Array(
            'Mon'=>'Senin',
            'Tue'=>'Selasa',
            'Wed'=>'Rabu',
            'Thu'=>'Kamis',
            'Fri'=>'Jumat',
            'Sat'=>'Sabtu',
            'Sun'=>'Minggu'
        );
        return $namaHari[$day];
    }

    public function getWaktuRapat($date)
    {
        $date = Carbon::createFromFormat('Y-m-d',$date);

        $hari = $this->hariID($date->format('D'));
        $tanggal = $date->format('d');
        $bulan = $this->bulanID($date->format('m'));
        $tahun = $date->format('Y');

        return $hari.", ".$tanggal." ".$bulan." ".$tahun;
    }

    public function getBulan($date)
    {
        $date = Carbon::createFromFormat('Y-m-d',$date);

        return $date->format('m');
    }

    public static function generateImageQr($url)
    {
        $qrcode = QrCode::format('png')
                    ->merge('img/logoweb.png',0.5,true)
                    ->size(300)->errorCorrection('H')
                    ->generate($url);
    }

    public function toBase64($path)
    {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        return $base64;
    }

    public function getInventoryDoh($hpp,$inventory,$tanggal=null)
    {
        if($tanggal==null){return 0;}
        $date = Carbon::createFromFormat('Y-m-d',$tanggal);
        if($inventory==0){return 0;}
        if($hpp==0){return 0;}

        $inventoryDoh = ceil(($inventory/$hpp)*($date->format('m')*30));
        return $inventoryDoh;
    }
    
    public function getAccountReceivableDoh($tanggal=null,$accountReceivable=0,$salesPendapatan=0)
    {
        if($tanggal==null){return 0;}
        $date = Carbon::createFromFormat('Y-m-d',$tanggal);
        if($accountReceivable==0){return 0;}
        if($salesPendapatan==0){return 0;}

        $accountReceivableDoh = ceil(($accountReceivable/$salesPendapatan)*($date->format('m')*30));
        return $accountReceivableDoh;
    }

    public function getAccountPayableDoh($tanggal=null,$accountPayable=0,$hpp=0)
    {
        if($tanggal==null){return 0;}
        $date = Carbon::createFromFormat('Y-m-d',$tanggal);
        if(!$date){return 0;}
        if($accountPayable==0){return 0;}
        if($hpp==0){return 0;}

        $accountPayableDoh = ceil(($accountPayable/$hpp)*($date->format('m')*30));
        return $accountPayableDoh;
    }

    public function getFintechId($noFactsheet)
    {
        $fintechId = DB::table('lending')->where('no_factsheet',$noFactsheet)->get();
        if($fintechId)
        {
            return $fintechId[0]->fintech_id;
        }else{
            return null;
        }
    }

    public function getBorrowerId($noFactsheet)
    {
        $borrowerId = DB::table('lending')->where('no_factsheet',$noFactsheet)->get();
        if($borrowerId)
        {
            return $borrowerId[0]->borrower;
        }else{
            return null;
        }
    }

    public function getTanggalPembiayaan($noFactsheet)
    {
        $tanggalPembiayaan = DB::select('select tanggal_pembiayaan from lending where no_factsheet=?',[$noFactsheet]);
        if($tanggalPembiayaan)
        {
            return $tanggalPembiayaan[0]->tanggal_pembiayaan;
        }else{
            return null;
        }
    }

    // Rumus Rasio
    // cash ratio = Kas / (Total Hutang Jangka Pende + Total Platform Penawaran)
    // current ratio = Total Current Asset / (Total Hutang Jangka Pende + Total Platform Penawaran)
    // Quick Ratio = (Total Current Asset - Persediaan Barang) / (Total Hutang Jangka Pendek + Total Plafon Penawaran)

    public function getCashRatioFactsheet(Array $laporanKeuangan)
    {
        if(($laporanKeuangan['total_hutang_jangka_pendek']+$laporanKeuangan['total_plafon_penawaran'])==0)
        {
            return 0;
        }else{
            $cashRatio = $laporanKeuangan['aset']['current_asset']['kas']/($laporanKeuangan['total_hutang_jangka_pendek']+$laporanKeuangan['total_plafon_penawaran']);
        }
        // dd($laporanKeuangan['aset']['current_asset']['kas'],$laporanKeuangan['total_hutang_jangka_pendek'],$laporanKeuangan['total_plafon_penawaran'],$cashRatio);

        return $cashRatio;
    }

    public function getCurrentRatioFactsheet(Array $laporanKeuangan)
    {
        if($laporanKeuangan['total_hutang_jangka_pendek']+$laporanKeuangan['total_plafon_penawaran']==0)
        {
            return 0;
        }else{
            $currentRatio = $laporanKeuangan['total_current_asset']/($laporanKeuangan['total_hutang_jangka_pendek']+$laporanKeuangan['total_plafon_penawaran']);
        }

        return $currentRatio;
    }

    public function getQuickRatioFactsheet(Array $laporanKeuangan)
    {
        if($laporanKeuangan['total_hutang_jangka_pendek']+$laporanKeuangan['total_plafon_penawaran']==0)
        {
            return 0;
        }else{
            $quickRatio = ($laporanKeuangan['total_current_asset']-$laporanKeuangan['aset']['current_asset']['persediaan_barang'])/($laporanKeuangan['total_hutang_jangka_pendek']+$laporanKeuangan['total_plafon_penawaran']);
        }
        
        return $quickRatio;
    }

    public function getRataRataRasioFactsheet($laporanKeuangan)
    {
        $rataRataRasio = ($this->getCurrentRatioFactsheet($laporanKeuangan)+$this->getQuickRatioFactsheet($laporanKeuangan)/2);
        if($rataRataRasio<0.9)
        {
            return 0;
        }else{
            return 1.1;
        }
    }

    // Rumus Rekomendasi pendanaan

    public function isBalance($laporanKeuangan)
    {
        if($laporanKeuangan['total_aset']-$laporanKeuangan['total_kewajiban_dan_ekuitas']==0)
        {
            return True;
        }else{
            return False;
        }
    }

    public function getRekomendasiPembiayaanCurrentRasio($laporanKeuangan)
    {
        $rataRataRasio = $this->getRataRataRasioFactsheet($laporanKeuangan);
        // dd($laporanKeuangan['total_plafon_penawaran']);
        if($rataRataRasio!=0)
        {
            $rekomendasi = ($this->getCurrentRatioFactsheet($laporanKeuangan)/$rataRataRasio)*$laporanKeuangan['total_plafon_penawaran'];
        }else
        {
            return 0;
        }
        return $rekomendasi;
    }

    public function getRekomendasiPembiayaanQuickRasio($laporanKeuangan)
    {
        $rataRataRasio = $this->getRataRataRasioFactsheet($laporanKeuangan);
        if($rataRataRasio!=0)
        {
            $rekomendasi = $this->getQuickRatioFactsheet($laporanKeuangan)/$rataRataRasio*$laporanKeuangan['total_plafon_penawaran'];
        }else{
            return 0;
        }
        // dd($rekomendasi);
        return $rekomendasi;
    }

    public function getBobotKualitasKredit($laporanKeuangan)
    {
        // dd($laporanKeuangan['slik_data']['kualitas_terkini']);
        if($laporanKeuangan['slik_data']['kualitas_terkini']==null)
        {
            return 0;
        }
        $bobot = DB::table('kualitas_kredit')->select('bobot')->where('kode',$laporanKeuangan['slik_data']['kualitas_terkini'])->get();
        // dd($bobot[0]);
        return $bobot[0]->bobot;
    }

    public function getBobotPefindoScore($laporanKeuangan)
    {
        if($laporanKeuangan['pefindo_data']['nama']==null){return 0;}
        $bobot = DB::table('rating_pefindo')->select('bobot')->where('nama',$laporanKeuangan['pefindo_data']['nama'])->get();
        // dd($bobot[0]->bobot);
        return $bobot[0]->bobot;
    }
    public function getMaksimalRekomendasiPendanaan($laporanKeuangan)
    {
        // dd('aksdlaksd');

        // neraca harus balance baru dihiting
        if(!$this->isBalance($laporanKeuangan))
        {
            return 0;
        }else{

            // rata-rata rasio = current rasio + quick rasio dibagi 2
            $rataRataPembiayaan = ($this->getRekomendasiPembiayaanCurrentRasio($laporanKeuangan)+$this->getRekomendasiPembiayaanQuickRasio($laporanKeuangan))/2;

            if($rataRataPembiayaan>$laporanKeuangan['total_plafon_penawaran'])
            {
                $rataRataPembiayaan=$laporanKeuangan['total_plafon_penawaran'];
            }

            if($rataRataPembiayaan==0){return 0;}

            if($this->getBobotKualitasKredit($laporanKeuangan)==0){return 0;}
            
            if($this->getBobotPefindoScore($laporanKeuangan)==0){return 0;}

            $maksimalRekomendasiPendanaan = ($rataRataPembiayaan*$this->getBobotKualitasKredit($laporanKeuangan))*$this->getBobotPefindoScore($laporanKeuangan);

            return $maksimalRekomendasiPendanaan;
        }
    }
    

    public function getPersentaseInvoice($laporanKeuangan)
    {
        if($laporanKeuangan['maksimal_rekomendasi_pendanaan']==0){return 0;}
        if($laporanKeuangan['nominal_invoice']==0){return 0;}
        $persentase = $laporanKeuangan['maksimal_rekomendasi_pendanaan']/$laporanKeuangan['nominal_invoice']; 
        return $persentase;
    }

}