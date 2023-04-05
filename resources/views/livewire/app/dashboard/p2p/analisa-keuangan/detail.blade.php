<div class="page" style="font-size: 8pt;">
    <div class="header">
        <table class="title" width="100%">
            <tr>
                <td style="width: 25%; text-align: left;">
                <img class="logo-bank" src="{{asset('storage/logo-bpr.png')}}" alt="">
                </td>
                <td style="text-align: center; font-weight: bold;">
                    ANALISA DAN KOMITE KREDIT P2P LENDING
                    <br>
                    {{setting('site.nama_bpr')}}
                </td>
                <td style="width: 25%; text-align: right;">
                <img class="logo-p2p" src="{{asset('storage/p2p.png')}}" alt="">
                </td>
            </tr> 
            <tr></tr>
        </table>
    </div>
    
    
    <div class="body">

    <!-- profile borrower -->
    <div class="rows-profile">
      <table style="font-size: 8pt; border: 1px solid #dedede;">
          <thead>
              <tr style="background-color: var(--bg-primary-color); color: #fff;">
              <th colspan="4">Profil Borrower</th>
              </tr>
          </thead>
          <tbody>
              <tr style="text-align: left;">
              <th style="width: 25%">Kode Analisa</th>
              <th style="width: 25%">Nama Fintech</th>
              <th style="width: 25%">Nama Perusahaan</th>
              <th style="width: 25%">Plafon Penawaran</th>
          </tr>
          <tr>
              <td>{{$data->kode_analisa}}</td>
              <td>{{$data->fintech->name}}</td>
              <td>{{$data->borrowerData->nama}}</td>
              <td align="center">{{number_format($data->total_plafon_penawaran,2,',','.')}}</td>
          </tr>
          <tr style="text-align: left;">
              <th>Mulai Usaha</th>
              <th>Tujuan Pinjaman</th>
              <th>Jenis Pembiayaan</th>
              <th>Sektor Usaha</th>
          </tr>
          <tr>
              {{-- {{dd($data->lending)}} --}}
              <td>{{$data->borrowerData->mulai_usaha}}</td>
              <td>{{$lendingData[0]->tujuanPinjamanData->nama}}</td>
              <td>{{$lendingData[0]->jenisPembiayaan->nama}}</td>
              <td>{{$lendingData[0]->sektorUsaha->nama}}</td>
          </tr>
          <tr style="text-align: left;">
              <th>Rating Borrower</th>
              <th>Jenis Borrower</th>
              <th>Riwayat Recurring</th>
              <th>TKB Fintech</th>
          </tr>
          <tr>
              <td>{{$lendingData[0]->ratingFintech->nama}}</td>
              <td>{{$lendingData[0]->bentukBadanHukum->nama}}</td>
              <td>{{$data->riwayat_recurring}}</td>
              <td>{{$lendingData[0]->fintech->tkb}} %</td>
          </tr>
          </tbody>
      </table>
    </div>

    {{-- tabel factsheet --}}
    <div class="factsheet">
        <table style="font-size: 8pt; border: 1px solid #dedede;">
            <thead>
                <tr style="text-align: left; background-color: var(--bg-primary-color); color: #fff;">
                    <th>No</th>
                    <th>No Factsheet</th>
                    <th>Nama Borrower</th>
                    <th>Jangka Waktu</th>
                    <th>Sifat Pembiayaan</th>
                    <th>Plafon Penawaran</th>
                </tr>
            </thead>
            @forelse($lendingDataAll as $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$item->no_factsheet}}</td>
                    <td>{{$item->borrowerData->nama}}</td>
                    <td>{{$item->jangka_waktu." ".$item->typeJangkaWaktuData->nama}}</td>
                    <td>{{$item->sifatPembiayaanData->nama}}</td>
                    <td align="right">{{number_format($item->plafon_penawaran,2,',','.')}}</td>
                </tr>
             @empty
                <tr>
                    <td colspan="5" align="center">Tidak ada item !</td>
                </tr>
            @endforelse
            <tfoot style="background-color: var(--bg-secondary-color); ">
                <tr>
                  <th style="text-align: center" colspan="5">Total Penawaran</th>
                  <th style="text-align: right">{{number_format($lendingDataAll->sum('plafon_penawaran'),2,',','.')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- kekayaan -->
    <div class="wealth-row">
      <table style="border: 1px solid #dedede; border: 1px solid #dedede;">
          <thead>
              <tr style="background-color: var(--bg-primary-color); color: #fff;">
                  <th colspan="4">
                      Kekayaan
                  </th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td width="40%">Kas</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_current_asset_kas,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Piutang Usaha</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_current_asset_piutang_usaha,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Persediaan Barang</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_current_asset_persediaan_barang,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Piutang Lain-lain</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_current_asset_piutang_lain_lain,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Total Current Asset</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->total_current_asset,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Tanah dan Bangunan</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_fixed_asset_tanah_dan_bangunan,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Kendaraan/Mesin/Inv</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_fixed_asset_kendaraan_mesin_inv,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Lain-lain</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->aset_fixed_asset_aset_lain,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Total Fixed Asset</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->total_fixed_asset,2,',','.')}}</th>
              </tr>
          </tbody>
          <tfoot style="background-color: var(--bg-secondary-color);  ">
            <tr>
              <th>Total Asset</th>
              <th>:</th>
              <th class="nominal">{{number_format($data->total_aset,2,',','.')}}</th>
            </tr>
          </tfoot>
      </table>
      <table style="border: 1px solid #dedede; border: 1px solid #dedede;">
        <thead>
            <tr style="background-color: var(--bg-primary-color); color: #fff;">
                <th colspan="4">
                    Hutang
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="40%">Hutang Dagang</td>
                <td>:</td>
                <th class="nominal" width="120px">{{number_format($data->kewajiban_hutang_jangka_pendek_hutang_dagang,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Hutang Bank</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->kewajiban_hutang_jangka_pendek_hutang_bank,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Hutang Leasing</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->kewajiban_hutang_jangka_pendek_hutang_leasing,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Hutang Pajak</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->kewajiban_hutang_jangka_pendek_hutang_pajak,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Hutang Lainnya</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->kewajiban_hutang_jangka_pendek_hutang_lainnya,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Hutang Jangka Panjang</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->kewajiban_hutang_jangka_panjang_hutang_jangka_panjang,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Total Hutang</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->total_kewajiban,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Ekuitas</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->total_ekuitas,2,',','.')}}</th>
            </tr>
        </tbody>
        <tfoot style="background-color: var(--bg-secondary-color);">
          <tr>
            <th>Total Hutang dan Ekuitas</th>
            <th>:</th>
            <th class="nominal">{{number_format($data->total_kewajiban+$data->total_ekuitas,2,',','.')}}</th>
          </tr>
        </tfoot>
      </table>
    </div>

    <!-- neraca balance -->
    <div class="row-neraca">
      <table style="background-color: var(--bg-secondary-color); border: 1px solid #dedede;">
          <thead>
              <tr>
                  @if(($data->total_kewajiban+$data->total_ekuitas)-$data->total_aset==0)
                  <th class="bg-success text-white text-center">Neraca Balance</th>
                  @else
                  <th class="bg-danger text-white">Neraca Tidak Balance</th>
                  @endif
              </tr>
          </thead>
      </table>
    </div>

    <!-- laporan keuangan -->
    <div class="rows-report">
      <table style="border: 1px solid #dedede;">
          <thead>
              <tr style="background-color: var(--bg-primary-color); color: #fff;">
                  <th colspan="2">
                      Laporan Keuangan
                  </th>
                  <th style="text-align: right">
                      30 Juni 2022
                  </th>
              </tr>
          </thead>
          <tbody> 
              <tr>
                  <td width="40%">Sales/Pendapatan</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->pendapatan_sales_pendapatan,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>HPP</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->biaya_hpp,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Biaya Usaha</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->biaya_biaya_usaha,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Gross Profit</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->gross_profit,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>GPM</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->gpm,2,',','.')}}</th>
              </tr>
              <tr>
                  <td>Nett Income</td>
                  <td>:</td>
                  <th class="nominal">{{number_format($data->nett_income,2,',','.')}}</th>
              </tr>   
          </tbody>
      </table>
      <table style="border: 1px solid #dedede;">
        <thead>
            <tr style="background-color: var(--bg-primary-color); color: #fff;">
                <th colspan="3">
                    Kewajiban
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td width="40%">Jangka Pendek</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->total_hutang_jangka_pendek,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Jangka Panjang</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->total_hutang_jangka_panjang,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Total Kewajiban</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->total_kewajiban,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Inventory</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->aset_current_asset_persediaan_barang,2,',','.')}}</th>
            </tr>
            <tr>
                <td>A/R</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->aset_current_asset_piutang_usaha,2,',','.')}}</th>
            </tr>
            <tr>
                <td>A/P</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->kewajiban_hutang_jangka_pendek_hutang_dagang,2,',','.')}}</th>
            </tr>
            <tr>
                <td>Pembiayaan MK Bank</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->slik_outstanding_aktif,2,',','.')}}</th>
            </tr> 
            <tr>
                <td>WI Need</td>
                <td>:</td>
                <th class="nominal">{{number_format($data->wi_need,2,',','.')}}</th>
            </tr>    
        </tbody>
      </table>
    </div>

    <!-- Perputaran A/R, A/P, Persediaan -->
    <div class="perputaran-row">
        <table style="border: 1px solid #dedede;">
            <thead>
                <tr style="background-color: var(--bg-primary-color); color: #fff;">
                    <th colspan="4">Perputaran A/R, A/P, Persediaan</th>
                </tr>
            </thead>
            <tbody>
            <tr align="center">
                <th width="25%">A/R DoH</th>
                <th width="25%">Inventory DoH</th>
                <th width="25%">A/P DoH</th>
                <th width="25%">Total outstanding</th>
            </tr>
            <tr style="text-align: right;">
                <td align="center">{{number_format($data->account_receivable_doh,2,',','.')}}</td>
                <td align="center">{{number_format($data->inventory_doh,2,',','.')}}</td>
                <td align="center">{{number_format($data->account_payable_doh,2,',','.')}}</td>
                <td align="right">{{number_format($data->slik_outstanding_aktif,2,',','.')}}</td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- rasio likuiditas -->
    <div class="liquidity-ratio-row">
        <table style="border: 1px solid #dedede;">
            <thead>
                <tr style="background-color: var(--bg-primary-color); color: #fff;">
                    <th colspan="4">
                        Rasio Likuiditas
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="40%">Cash Ratio</td>
                    <td width="1%">:</td>
                    <td align="right">{{number_format($data->cash_ratio,2,',','.')}} %</td>
                </tr>
                <tr>
                    <td>Current Ratio</td>
                    <td>:</td>
                    <td align="right">{{number_format($data->current_ratio,2,',','.')}} %</td>
                </tr>
                <tr>
                    <td>Quick Ratio</td>
                    <td>:</td>
                    <td align="right">{{number_format($data->quick_ratio,2,',','.')}} %</td>
                </tr>
            </tbody>
        </table>

        {{-- pefindo Kredit --}}
        <table style="border: 1px solid #dedede;">
          <thead>
              <tr>
                  <th colspan="3" style="background-color: var(--bg-primary-color); color: #fff;">ID Score Pefindo Kredit</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <th width="45%">ID Score</th>
                  <td style="text-align: right;">{{$data->pefindo_score}}</td>
              </tr>
              <tr>
                  <th>Nilai</th>
                  <td style="text-align: right;">{{$data->pefindo_nilai}}</td>
              </tr>
              <tr>
                  <th>Tren</th>
                  <td style="text-align: right;">{{$data->pefindo_tren}}</td>
              </tr>
              <tr>
                  <th>Nominal Tunggakan</th>
                  <td style="text-align: right;">{{$data->pefindo_nominal_tunggakan}}</td>
              </tr>
              <tr>
                  <th>Usia Tunggakan</th>
                  <td style="text-align: right;">{{$data->pefindo_usia_tunggakan}}</td>
              </tr>
          </tbody>
        </table>

        {{-- data slik --}}
        <table style="border: 1px solid #dedede;">
          <thead>
              <tr style="background-color: var(--bg-primary-color); color: #fff;">
                  <th colspan="3">Data SLIK</th>
              </tr>
          </thead>
          <tbody>
          <tr>
              
          </tr>
          <tr>
            <th width="50%">Kualitas</th>
            <td align="center">{{$data->slik_kualitas_terkini}}</td>
          </tr>
          <tr>
            <th width="50%">Riwayat (12 Bulan)</th>
            <td align="center">{{$data->slik_riwayat_kualitas}}</td>
          </tr>
          <tr>
            <th width="50%">Outstanding</th>
            <td align="right">{{number_format($data->slik_outstanding_aktif,2,',','.')}}</td>
          </tr>
          </tbody>
        </table>
    </div>

    <div class="desc-analysis">
        <table style="border: 1px solid #dedede;">
            <thead>
                <tr style="background-color: var(--bg-primary-color); color: #fff;">
                    <th colspan="2">  
                    Deskripsi Analisa SLIK dan Pefindo
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Keterangan
                    </td>
                    <th>
                        {{$data->deskripsi_keterangan}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="desc-goal">
        <table style="border: 1px solid #dedede;">
            <thead>
                <tr style="background-color: var(--bg-primary-color); color: #fff;">
                    <th colspan="2">
                        Deskripsi Tujuan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Tujuan usulan
                    </td>
                    <th>
                        {{strip_tags(html_entity_decode($data->deskripsi_tujuan))}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Latar Belakang Usulan
                    </td>
                    <th>
                        {{strip_tags(html_entity_decode($data->deskripsi_latar_belakang))}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Sumber Pembayaran
                    </td>
                    <th>
                        {{strip_tags(html_entity_decode($data->deskripsi_sumber_pembayaran))}}
                    </th>
                </tr>
                <tr>
                    <td>
                        Deskripsi Kualitatif
                    </td>
                    <th>
                        {{strip_tags(html_entity_decode($data->deskripsi_kualitatif))}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="mitigation">
        <table style="border: 1px solid #dedede;">
            <thead>
                <tr style="background-color: var(--bg-primary-color); color: #fff;">
                    <th colspan="2">
                        Mitigasi dari Fintech
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        {{strip_tags(html_entity_decode($data->deskripsi_mitigasi))}}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="conclusion">
        <table width="100%" style="border: 1px solid #dedede;">
            <thead>
                <tr style="background-color: var(--bg-primary-color); color: #fff;">
                    <th colspan="2">Rekomendasi dan Kesimpulan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kesimpulan Komite Kredit</td>
                    <th>{{strip_tags(html_entity_decode($data->kesimpulan_komite))}}</th>
                </tr>
            </tbody>
        </table>
    </div>
    
    <!-- funding recommendation -->
    <div class="funding-recommendation">
        <table style="background-color: var(--bg-secondary-color);">
            <thead>
                <tr class="bg-success text-white">
                    <th colspan="6">
                        Maksimal Rekomendasi Pendanaan
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: left; height: 3vw; background-color: #62a7a3; color: #fff;">
                    <td>Rp.</td>
                    <th class="nominal" style="text-align: left;">{{number_format($data->maksimal_rekomendasi_pendanaan,2,',','.')}}</th>
                    <td>Nilai Invoice</td>
                    <th class="nominal" style="text-align: left;">{{number_format($data->nilai_invoice,2,',','.')}}</th>
                    <td>Persentase </td>
                    <th class="nominal" style="text-align: left;">{{number_format($data->persentase_invoice,2,',','.')}} %</th>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- tabel factsheet --}}
    <div class="factsheet">
        <table style="border: 1px solid #dedede;">
            <thead>
                <tr style="text-align: left; background-color: var(--bg-primary-color); color: #fff;" align="center">
                    <th width="2%">No</th>
                    <th width="10%">No Factsheet</th>
                    <th width="10%">Nama Borrower</th>
                    <th width="12%">Plafon Penawaran</th>
                    <th width="12%">Nominal Pembiayaan</th>
                    <th width="12%">Status Pembiayaan</th>
                    <th width="12%">Suku Bunga</th>
                    <th width="12%">Tanggal Mulai</th>
                    <th width="12%">Jatuh Tempo</th>
                    <th width="12%">Jangka Waktu</th>
                </tr>
            </thead>
            @forelse($lendingDataAll as $item)
                <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$item->no_factsheet}}</td>
                    <td>{{$item->borrowerData->nama}}</td>
                    <td align="right">{{number_format($item->plafon_penawaran,2,',','.')}}</td>
                    <td align="right">{{number_format($item->nominal_pembiayaan,2,',','.')}}</td>
                    <td align="center">{{$item->statusPembiayaanData->nama}}</td>
                    <td align="center">{{$item->bunga*100}} %</td>
                    <td align="center">{{$item->tanggal_pembiayaan}}</td>
                    <td align="center">{{$item->jatuh_tempo}}</td>
                    <td align="center">{{$item->jangka_waktu." ".$item->typeJangkaWaktuData->nama}}</td>
                </tr>
             @empty
                <tr>
                    <td colspan="5" align="center">Tidak ada item !</td>
                </tr>
            @endforelse
            <tfoot>
                <tr>
                    <td align="center" colspan="9"><b>Total Penawaran</b></td>
                    <th style="text-align: right;">{{number_format($lendingDataAll->sum('plafon_penawaran'),2,',','.')}}</th>
                </tr>
                <tr>
                    <td align="center" colspan="9">Total Pembiayaan</td>
                    <th style="text-align: right">{{number_format($lendingDataAll->sum('nominal_pembiayaan'),2,',','.')}}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="deal-section">
        <table border="1px solid black">
            <tr>
                <th width="25%" style="border: 1px solid black;">
                    <div class="name">
                        <p>{{$dataTtd1->nama}}</p>
                    </div>
                    <div class="role">
                        <p>{{$dataTtd1->jabatan}}</p>
                    </div>
                </th>
                <th width="25%" style="border: 1px solid black;">
                    <div class="name">
                        <p>{{$dataTtd2->nama}}</p>
                    </div>
                    <div class="role">
                        <p>{{$dataTtd2->jabatan}}</p>
                    </div>
                </th>
                <th width="25%" style="border: 1px solid black;">
                    <div class="name">
                        <p>{{$dataTtd3->nama}}</p>
                    </div>
                    <div class="role">
                        <p>{{$dataTtd3->jabatan}}</p>
                    </div>
                </th>
                <th width="25%" style="border: 1px solid black;">
                    <div class="name">
                        <p>{{$dataTtd4->nama}}</p>
                    </div>
                    <div class="role">
                        <p>{{$dataTtd4->jabatan}}</p>
                    </div>
                </th>
            </tr>
            <tr style="background-color: #fff; text-align: center; height: 140px; border: 1px solid black;">
                <td style="border: 1px solid black;">
                    
                </td>
                <td style="border: 1px solid black;">
                    
                </td style="border: 1px solid black;">
                <td style="border: 1px solid black;">
                    
                </td>
                <td style="border: 1px solid black;">
                    
                </td>
            </tr>
        </table>
    </div>
    <div class="rows">
      <div class="col">
          <button class="btn btn-primary btn-block" onclick="window.print()">Print</button>
      </div>
  </div>
</div>
