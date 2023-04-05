    <div class="container mt-4">
      @push('page_specified_css')
      <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
      @endpush
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Input data analisa</h4>
            </div>
            <div class="card-body">
              <form wire:submit.prevent="storeAnalisa">
                <div class="row">
                  <div class="col-sm-4">
                      <div class="form-group">
                          <label for="tanggal_pembiayaan">Tanggal Analisa Keuangan</label>
                          <input type="date" class="form-control" wire:model.lazy="laporanKeuangan.tanggal_analisa_keuangan"/>
                      </div>
                  </div>
                  <div class="col-sm-8">                         
                      <div class="form-group" wire:ignore>
                          <label>Nama Factsheet</label>
                          <select class="js-example-basic-single w-100" id="noFactsheet">
                              <option>-- Pilih Factsheet --</option>
                              @forelse($lendings as $item)
                                  <option value="{{$item->no_factsheet}}">{{"(".$item->jml_factsheet." factsheet) - ".$item->tanggal_pembiayaan." - ".$item->nama_fintech." - ".$item->nama}}</option>
                              @empty
                                  <option>Tidak ada pilihan di database!</option>
                              @endforelse
                          </select>
                      </div> 
                  </div>
                </div>

                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Total Nominal Invoice</label>
                      <input wire:model="laporanKeuangan.nominal_invoice" class="form-control" type="number">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <fieldset>
                      <table class="table table-bordered table-sm" id="tabelFactsheet">
                        <thead class="thead-light">
                          <tr align="center" class="bg-primary text-white">
                            <td>No</td>
                            <td>No Factsheet</td>
                            <td>Nama Borrower</td>
                            <td>Jangka Waktu</td>
                            <td>Sifat Pembiayaan</td>
                            <td>Payor</td>
                            <td>Plafon Penawaran</td>
                          </tr>
                        </thead>
                        @forelse($selectedLendingData as $item)
                            <tr>
                              <td>{{$loop->index+1}}</td>
                              <td>{{$item->no_factsheet}}</td>
                              <td>{{$item->nama_borrower}}</td>
                              <td>{{$item->jangka_waktu}}</td>
                              <td>{{$item->sifat_pembiayaan}}</td>
                              <td>
                                <ul>
                                  <?php $dataPayor = $this->getPayorNameByFactsheet($item->no_factsheet)?>
                                  @foreach ($dataPayor as $itemPayor)
                                      <li>{{$itemPayor->nama}}</li>
                                  @endforeach
                                </ul>
                              </td>
                              <td align="right">{{number_format($item->plafon_penawaran,2,',','.')}}</td>
                            </tr>
                        @empty
                            <tr>
                              <td colspan="7" align="center">Silahkan Pilih Factsheet</td>
                            </tr>
                        @endforelse
                        <tfoot>
                          <tr>
                            <td align="center" colspan="6">Total Penawaran</td>
                            <td align="right">{{number_format($selectedLendingData->sum('plafon_penawaran'),'2',',','.')}}</td>
                          </tr>
                        </tfoot>
                      </table>
                    </fieldset>
                  </div>
                </div>
              
                <hr>
              
                <!-- ID Score Pefindo Credit -->
                <div class="row">
                  <div class="col-sm-12 mt-2">
                    <fieldset class="border px-4">
                      <legend class="w-auto" style="font-size: 12pt;">ID Score Pefindo Credit</legend>
                      <div class="row">
                        <div class="col-2">
                          <div class="form-group">
                            <label>ID Score</label>
                            <select wire:model="laporanKeuangan.pefindo_data.nama">
                              <option>Pilih Score</option>
                              @forelse ($ratingPefindo as $item)
                                  <option value="{{$item->nama}}">{{$item->nama}}</option>
                              @empty
                                  <option> Tidak Ada Item </option>
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="form-group">
                            <label>Nilai</label>
                            <input type="number" wire:model="laporanKeuangan.pefindo_data.nilai" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="form-group">
                            <label>Usia tunggakan</label>
                            <input type="number" wire:model="laporanKeuangan.pefindo_data.usia_tunggakan" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                          </div>
                        </div>
                        <div class="col-2">
                          <div class="form-group">
                            <label>Tren</label>
                            <select name="" id="" wire:model="laporanKeuangan.pefindo_data.pefindo_tren">
                              <option>Pilih Tren</option>
                              @forelse ($trenPefindo as $item)
                                <option value="{{$item->nama}}">{{$item->nama}}</option>
                              @empty
                                <option>Tidak Ada Item</option>
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Nominal Tunggakan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model="laporanKeuangan.pefindo_data.nominal_tunggakan" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                      </div>
                    </fieldset>  
                  </div>

                  {{-- SLIK --}}
                  <div class="col-sm-12 mt-2">
                    <fieldset class="border px-4">
                      <legend class="w-auto" style="font-size: 12pt;">SLIK</legend>
                      <div class="row">
                        <div class="col-4">
                          <div class="form-group">
                            <label>Kolektibilitas terkini</label>
                            <select  wire:model="laporanKeuangan.slik_data.kualitas_terkini">
                                <option>-- Pilih --</option>
                              @forelse ($kualitasKredit as $item)
                                  <option value="{{$item->kode}}">{{$item->kode." - ".$item->nama}}</option>
                              @empty
                                  <option>Tidak Ada Item!</option>
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Riwayat kolektibilitas(12 Bulan terakhir)</label>
                            <select wire:model="laporanKeuangan.slik_data.riwayat_kualitas">
                              <option>-- Pilih --</option>
                              @forelse ($kualitasKredit as $item)
                                  <option value="{{$item->kode}}">{{$item->kode." - ".$item->nama}}</option>
                              @empty
                                  <option>Tidak Ada Item!</option>
                              @endforelse
                            </select>
                          </div>
                        </div>
                        <div class="col-4">
                          <div class="form-group">
                            <label>Outstanding Aktif</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model="slikData.outstanding_aktif" class="form-control" aria-label="Masukan Nominal" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                      </div>
                    </fieldset>  
                  </div>
                </div>

                <hr>

                <h6 class="mb-3">Laporan Keuangan</h6>
                {{-- Tanggal Laporan Keuangan --}}
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label for="">Tanggal Laporan Keuangan</label>
                      <input type="date" class="form-control" wire:model="laporanKeuangan.tanggal_laporan_keuangan">
                    </div>
                  </div>
                </div>
                <!-- kekayaan  -->
                <div class="row">
                  <div class="col-sm-6">
                    <fieldset class="border p-2">
                      <legend class="w-auto" style="font-size: 12pt;">Kekayaan</legend>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Kas dan Bank</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model.lazy='laporanKeuangan.aset.current_asset.kas' class="form-control" aria-label="Masukan Nominal" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Piutang usaha</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model='laporanKeuangan.aset.current_asset.piutang_usaha' class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Persediaan Barang</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model='laporanKeuangan.aset.current_asset.persediaan_barang' class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Aset Lancar lainnya</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model='laporanKeuangan.aset.current_asset.piutang_lain_lain' class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Tanah dan Bangunan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model='laporanKeuangan.aset.fixed_asset.tanah_dan_bangunan' class="form-control" aria-label="Masukan Nominal" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Kendaraan/Mesin/Inventaris</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model='laporanKeuangan.aset.fixed_asset.kendaraan_mesin_inv' class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label>Lain-lain</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model='laporanKeuangan.aset.fixed_asset.aset_lain' class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <table class="table table-bordered table-sm">
                            <tr align="center">
                              <td>Total Fixed Asset</td>
                              <td>Total Current Asset</td>
                            </tr>
                            <tr align="right">
                              <td>{{number_format($laporanKeuangan['total_fixed_asset'],2,',','.')}}</td>
                              <td>{{number_format($laporanKeuangan['total_current_asset'],2,',','.')}}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </fieldset>  
                  </div>

                  <!-- hutang -->
                  <div class="col-sm-6">
                    <fieldset class="border p-2">
                      <legend class="w-auto" style="font-size: 12pt;">Kewajiban</legend>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Hutang dagang</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.kewajiban.hutang_jangka_pendek.hutang_dagang" aria-label="Masukan Nominal" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Hutang bank</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.kewajiban.hutang_jangka_pendek.hutang_bank" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Hutang leasing</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.kewajiban.hutang_jangka_pendek.hutang_leasing" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Hutang pajak</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.kewajiban.hutang_jangka_pendek.hutang_pajak" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Hutang Lainnya</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.kewajiban.hutang_jangka_pendek.hutang_lainnya" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Hutang jangka panjang</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.kewajiban.hutang_jangka_panjang.hutang_jangka_panjang" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>Ekuitas</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" class="form-control" wire:model="laporanKeuangan.ekuitas.ekuitas" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <table class="table table-bordered table-sm">
                            <tr align="center">
                              <td>Total Kewajiban</td>
                              <td>Total Ekuitas</td>
                              <td>Total Kewajiban + Ekuitas</td>
                            </tr>
                            <tr align="right">
                              <td>{{number_format($laporanKeuangan['total_kewajiban'],2,',','.')}}</td>
                              <td>{{number_format($laporanKeuangan['total_ekuitas'],2,',','.')}}</td>
                              <td>{{number_format($laporanKeuangan['total_kewajiban_dan_ekuitas'],2,',','.')}}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </fieldset>  
                  </div>
                </div>

                <div class="row mt-3 mb-3">
                  <div class="col">
                    <table class="table table-bordered table-md">
                      <thead>
                        <tr align="center">
                          <td>Total Aset</td>
                          <td>Total Kewajiban</td>
                          <td>Keterangan</td>
                        </tr>
                      </thead>
                      <tr>
                        <td align="right">{{number_format($laporanKeuangan['total_aset'],2,',','.')}}</td>
                        <td align="right">{{number_format($laporanKeuangan['total_kewajiban_dan_ekuitas'],2,',','.')}}</td>
                        @if($laporanKeuangan['is_balance'])
                          <td class="text-white bg-success" align="center">Neraca Balance</td>
                        @else
                          <td class="text-white bg-danger" align="center">Neraca Tidak Balance</td>
                        @endif
                      </tr>
                    </table>
                  </div>
                </div>

                <!-- laporan keuangan -->
                <div class="row">
                  <div class="col-sm-6 mt-2">
                    <fieldset class="border px-4">
                      <legend class="w-auto" style="font-size: 12pt;">Pendapatan</legend>
                      <div class="row">
                        <div class="col-6">
                          <div class="form-group">
                            <label>Sales/Pendapatan</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model="laporanKeuangan.pendapatan.sales_pendapatan" class="form-control" aria-label="Masukan Nominal" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="form-group">
                            <label>HPP</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model="laporanKeuangan.biaya.hpp" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <div class="form-group">
                            <label>Biaya Usaha</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <div class="input-group-text" id="btnGroupAddon">Rp.</div>
                              </div>
                              <input type="number" wire:model="laporanKeuangan.biaya.biaya_usaha" class="form-control" aria-label="Input group example" aria-describedby="btnGroupAddon">
                            </div>
                          </div>
                        </div>
                        <div class="col-12">
                          <table class="table-sm" style="width:100%">
                              <tr>
                                <td width="50%">Gross Profit</td>
                                <td width="50%" align="right">{{number_format($laporanKeuangan['gross_profit'],2,',','.')}}</td>
                              </tr>
                              <tr>
                                <td>GPM</td>
                                <td align="right">{{number_format($laporanKeuangan['gpm']*100,2,',','.')}} %</td>
                              </tr>
                              <tr>
                                <td>Nett Income</td>
                                <td align="right">{{number_format($laporanKeuangan['nett_income'],2,',','.')}}</td>
                              </tr>
                          </table>
                        </div>
                      </div>
                    </fieldset>  
                  </div>
                  <div class="col-sm-6 mt-2">
                    <fieldset class="border px-4">
                      <legend class="w-auto" style="font-size: 12pt;">Kewajiban</legend>
                      <div class="row">
                        <div class="col-12">
                          <table class="table-sm" style="width:100%">                        
                            <tr>
                              <td width="50%">Hutang Jangka Pendek</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['total_hutang_jangka_pendek'],2,',','.')}}</td>
                            </tr>                        
                            <tr style="border-bottom:1px solid black;">
                              <td width="50%">Hutang Jangka Panjang</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['total_hutang_jangka_panjang'],2,',','.')}}</td>
                            </tr>                        
                            <tr>
                              <td width="50%">Total Kewajiban</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['total_kewajiban'],2,',','.')}}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-12">                        
                          <table class="table-sm" style="width:100%">                        
                            <tr>
                              <td width="50%">Inventory</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['aset']['current_asset']['persediaan_barang'],2,',','.')}}</td>
                            </tr>                        
                            <tr>
                              <td width="50%">A/R</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['aset']['current_asset']['piutang_usaha'],2,',','.')}}</td>
                            </tr>                        
                            <tr>
                              <td width="50%">A/P</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['kewajiban']['hutang_jangka_pendek']['hutang_dagang'],2,',','.')}}</td>
                            </tr>                     
                            <tr>
                              <td width="50%">Pembiayaan MK Bank</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['pembiayaan_mk_bank'],2,',','.')}}</td>
                            </tr>                   
                            <tr>
                              <td width="50%">WI Need</td>
                              <td width="50%" align="right">{{number_format($laporanKeuangan['wi_need'],2,',','.')}}</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-12">
                          <table class="table-sm" style="width:100%">                        
                            <tr>
                              <td width="50%">Inventory DoH</td>
                              <td width="50%" align="right">{{$laporanKeuangan['inventory_doh']}} hari</td>
                            </tr>                        
                            <tr>
                              <td width="50%">A/R DoH</td>
                              <td width="50%" align="right">{{$laporanKeuangan['account_receivable_doh']}} hari</td>
                            </tr>                        
                            <tr>
                              <td width="50%">A/P DoH</td>
                              <td width="50%" align="right">{{$laporanKeuangan['account_payable_doh']}} hari</td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </fieldset>  
                  </div>
                </div>

                {{-- Rasio Rasio --}}
                <div class="row mt-3">
                  <div class="col-6">
                    <fieldset class="border p-4">
                      <legend class="w-auto" style="font-size: 12pt;">Rasio</legend>
                      <table class="table table-bordered table-sm">
                        <thead>
                          <tr align="center">
                            <td>Jenis Rasio</td>
                            <td>Laporan Keuangan Factsheet</td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Cash Ratio</td>
                            <td align="center">{{number_format($laporanKeuangan['rasio']['cash_ratio'],2,',','.')}}</td>
                          </tr>
                          <tr>
                            <td>Current Ratio</td>
                            <td align="center">{{number_format($laporanKeuangan['rasio']['current_ratio'],2,',','.')}}</td>
                          </tr>
                          <tr>
                            <td>Quick Ratio</td>
                            <td align="center">{{number_format($laporanKeuangan['rasio']['quick_ratio'],2,',','.')}}</td>
                          </tr>
                        </tbody>
                      </table>
                    </fieldset>
                  </div>
                  <div class="col-6">
                    <fieldset class="border p-2">
                      <legend class="w-auto" style="font-size: 12pt;">Rekomendasi Pendanaan</legend>
                      <table class="table no-border table-md">
                        <tbody>
                          <tr>
                            <td width="30%">Maksimal Rekomendasi Pendanaan</td>
                            <td width="70%" align="center">{{number_format($laporanKeuangan['maksimal_rekomendasi_pendanaan'],2,',','.')}}</td>
                          </tr>
                          <tr>
                            <td>Nilai Invoice</td>
                            <td align="center">{{number_format($laporanKeuangan['nominal_invoice'],2,',','.')}}</td>
                          </tr>
                          <tr>
                            <td>Persentase</td>
                            <td align="center">{{number_format($laporanKeuangan['persentase_invoice']*100,2,',','.')}} %</td>
                          </tr>
                        </tbody>
                      </table>
                    </fieldset>
                  </div>
                </div>

                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <div class="label">Riwayat Recurring</div>
                      <input type="text" class="form-control" wire:model="laporanKeuangan.riwayat_recurring">
                    </div>
                  </div>
                </div>
                {{-- deskripsi tujuan usulan kredit --}}
                <div class="row" wire:ignore>
                  <div class="col-sm">
                    <fieldset class="border px-4 mt-4">
                      <legend class="w-auto" style="font-size: 12pt;"> Deskripsi Usulan Kredit</legend>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                                <label>Deskripsi Mitigasi Risiko</label>
                                <textarea type="text" class="form-control" id="deskripsiMitigasiRisiko">
                                </textarea>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                                <label>Deskripsi Keterangan</label>
                                <textarea type="text" class="form-control" id="deskripsiKeterangan">
                                </textarea>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                                <label>Tujuan Usulan</label>
                                <textarea type="text" class="form-control" id="deskripsiTujuan">
                                </textarea>
                            </div>
                          </div>
                          <div class="col-sm-12">
                            <div class="form-group">
                                <label>Latar Belakang Usulan</label>
                                <textarea type="text" class="form-control" id="deskripsiLatarBelakang">
                                </textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Sumber Pembayaran</label>
                                    <textarea type="text" class="form-control" id="deskripsiSumberPembayaran">
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Deskripsi Kualitatif</label>
                                    <textarea type="text" class="form-control" id="deskripsiKualitatif">
                                    </textarea>
                                </div>
                            </div>
                        </div>
                      </fieldset>
                  </div>
                </div>

                {{-- kesimpulan komite kredit --}}
                <div class="row" wire:ignore>
                    <div class="col-sm-12">
                        <fieldset class="border px-4 mt-4">
                            <legend class="w-auto" style="font-size: 12pt;">Rekomendasi dan Kesimpulan</legend>
                            <div class="form-group">
                                <label>Kesimpulan Komite Kredit</label>
                                <textarea type="text" class="form-control" id="kesimpulanKomite">
                                </textarea>
                            </div>
                        </fieldset>
                    </div>
                </div>

                {{-- usulan plafon didanai --}}
                <div class="row mt-4">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label>Usulan Plafond di Danai</label>
                            <input wire:model="laporanKeuangan.usulan_plafon_didanai" type="number" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row">
                  <div class="col-12 d-flex flex-row-reverse">
                    <button type="submit" class="btn btn-md btn-success">Simpan Analisa</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      @push('page_specified_js')
      <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
      <script>
        $('#deskripsiMitigasiRisiko').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.deskripsi_tujuan', contents);
            }
          }
        });
        $('#deskripsiKeterangan').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.deskripsi_tujuan', contents);
            }
          }
        });
        $('#deskripsiTujuan').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.deskripsi_tujuan', contents);
            }
          }
        });
        $('#deskripsiLatarBelakang').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.deskripsi_latar_belakang', contents);
            }
          }
        });
        $('#deskripsiSumberPembayaran').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.deskripsi_sumber_pembayaran', contents);
            }
          }
        });
        $('#deskripsiKualitatif').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.deskripsi_sumber_kualitatif', contents);
            }
          }
        });
        $('#kesimpulanKomite').summernote({
          placeholder: 'Masukan Deskripsi',
          tabsize: 2,
          height: 120,
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
          ],
          callbacks:{
              onChange: function(contents, $editable) {
              @this.set('laporanKeuangan.kesimpulan_komite', contents);
            }
          }
        });
      </script>
      <script>
          $(document).ready(function(){
              $('#fintech_id').change(function(e){
                  var value = $(this).val();
                  @this.fintechId=value;
              });
              $('#noFactsheet').change(function(e){
                  var value = $(this).val();
                  @this.selectedNoFactsheet=value;

                  Livewire.emit('getSelectedFactsheetDetail',value);
              });
          });
          
      </script>
      @endpush
    </div>