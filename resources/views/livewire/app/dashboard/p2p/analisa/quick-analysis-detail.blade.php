    
    {{-- <div class="btn-group">
        <a href="#" wire.click="printReport()" class="btn btn-primary">
            Cetak
        </a>
    </div> --}}

    <div class="page">
        <div class="header">
            <table>
                <tr>
                    <th style="width: 20%">
                        <img src="{{asset('storage/logo-bpr.png')}}" class="logo-bank" alt="">
                    </th>
                    <th style="text-align: center">
                        <h4>QUICK ANALYSIS<br>PEMBIAYAAN FINTECH</h4>
                    </th>
                    <th style="width: 20%; text-align: right;">
                        <img src="{{asset('storage/p2p.png')}}" alt="logo" class="logo-p2p"/>
                    </th>
                </tr>
            </table>
            <table style="text-align: center;">
                <tr>
                    <td>No. Factsheet</td>
                </tr>
                <tr>
                    <th>{{$analysis->no_factsheet}}</th>
                </tr>
            </table>
        </div>
        <div class="body">
            <div class="rows">
                <div class="col">
                    <table style="padding: 2px;">
                        <tr>
                            <td style="font-weight: bold; width: 20%;">Nama Fintech</td>
                            <td>:</td>
                            <td>{{$analysis->nama_fintech}}</td>
                        </tr>
                        <tr style="background-color: #fff">
                            <td style="font-weight: bold;">Nama Borrower</td>
                            <td>:</td>
                            <td>{{$analysis->nama_borrower}}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;">Plafon Penawaran</td>
                            <td>:</td>
                            <td>{{number_format($analysis->plafon_penawaran,0,',','.')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="rows">
                <div class="col">
                    <table>
                        <tr style="background-color: var(--bg-primary-color); color: #fff;">
                            <th>Fasilitas Aktif Fintech</th>
                        </tr>
                        <td align="right">  
                            {{number_format($analysis->fasilitas_aktif_fintech,2,',','.')}}
                        </td>
                    </table>
                </div>
            </div>
        </div>
        <div class="rows">
            <div class="col">
                <table>
                    <tr style="background-color: var(--bg-primary-color); color: #fff;">
                        <td align="left"><b>% Komitmen Pemberian Kredit</b></td>
                        <td align="center"><b>Nominal Fasilitas Aktif</b></td>
                        <td align="center"><b>NOA Fasilitas Aktif</b></td>
                    </tr>
                    <tr>
                        <td class="text-center">{{$analysis->komitmen_pemberian_kredit}}%</td>
                        <td align="right">{{number_format($analysis->nominal_fasilitas_aktif,2,',','.')}}</td>
                        <td class="text-center">{{$analysis->noa_fasilitas_aktif}}</td>
                    </tr>
                </table>
            <div class="rows">
                <div class="col">
                    <table>
                        <tr style="background-color: var(--bg-primary-color); color: #fff;">
                            <td colspan="2" align="left"> <b> A. Risk Acceptance Criteria(RAC)</b></td>
                            <td width="200" align="center"> <b> Score</b></td>
                        </tr>
                        @foreach ($score_rac_detail as $item)
                        <tr>
                            <td width="500">{{ucfirst(str_replace('_',' ',$item->parameter))}}</td>
                            <td width="400">{{$item->value}}</td>
                            <td align="center">{{$item->score}}</td>
                        </tr>                        
                        @endforeach
                        <tr>
                            <td colspan="2" style="font-weight: bold; text-align: center; background-color: var(--bg-primary-color); color: #fff;">Total Score</td>
                            <td align="center"><b>{{$score_rac[0]->score}}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="rows">
                <div class="col">
                    <table>
                        <tr style="background-color: var(--bg-primary-color); color: #fff;">
                            <td colspan="2" align="left"><b>B. Fitur Pendanaan Pinjaman</b></td>
                            <td width="200" align="center"><b>Score</b></td>
                        </tr>
                        @foreach ($score_fitur_pendanaan_detail as $item)
                            <tr>
                                <td width="500">{{ucfirst(str_replace('_',' ',$item->parameter))}}</td>
                                <td width="400">{{$item->value}}</td>
                                <td align="center">{{$item->score}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2" style="font-weight: bold; text-align: center; background-color: var(--bg-primary-color); color: #fff;">Total Score</td>
                            <td align="center"><b>{{$score_fitur_pendanaan[0]->score}}</b></td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="rows">
                <div class="col">
                    <table>
                        <tr style="background-color: var(--bg-primary-color); color: #fff;">
                            <th colspan="3">C. Payor Analisis</th>
                        </tr>
                        <tr>
                            <td width="60%">Total Payor</td>
                            <td>{{$analysis->total_payor}}</td>
                            <th rowspan="2" class="text-center @if($analysis->pefindo_status=='HIGH RISK PEFINDO') bg-danger text-white @else bg-success text-white @endif">{{$analysis->pefindo_status}}</th>
                        </tr>
                        <tr>
                            <td>Payor Scoring</td>
                            <td>{{$analysis->score_payor}}</td>
                        </tr>
                        <tr>
                            <th style="background-color: #6c7ae0; font-weight: bold; color: #fff;">RAC Scoring</th>
                            <td style="background-color: #6c7ae0; font-weight: bold; color: #fff; text-align: right;">{{$analysis->max_pembiayaan_persen}}</td>
                            <td rowspan="3" class="@if($analysis->kelayakan_payor !='Payor Layak') text-danger @endif" style="text-align: center; background-color: #D8FDDA;"><b>{{$analysis->kelayakan_payor}}</b></td>
                        </tr>
                        <tr>
                            <td style="background-color: #f8f6ff;">Rekomendasi Pembiayaan</td>
                            <td align="center" style="background-color: #f8f6ff;">{{number_format($analysis->nominal_rekomendasi,0,',','.')}}</td>
                        </tr>
                        <tr>
                            <th>Rekomendasi dari RAC</th>
                            <th style="text-align: right">80,00%</th>
                            {{-- <td rowssspan="3" class="@if($analysis->kelayakan_payor !='Payor Layak') text-danger @endif" style="text-align: center; background-color: #D8FDDA;"><b>{{$analysis->kelayakan_payor}}</b></td> --}}
                        </tr>
                        {{-- <tr>
                            <td colspan="2" style="text-align: right; background-color: #f8f6ff;"></td>
                        </tr> --}}
                    </table>
                </div>
            </div>
            <div class="rows">
                <div class="col">
                    <table>
                        <tr style="background-color: var(--bg-primary-color); color: #fff;" align="center">
                            <th>Outstanding P2PL</th>
                            <th>Baki Debet</th>
                            <th>Rasio</th>
                        </tr>
                        <tr>
                            <td align="right">{{number_format($analysis->outstanding_p2pl,2,',','.')}}</td>
                            <td align="right">{{number_format($analysis->baki_debet_p2pl,2,',','.')}}</td>
                            <td align="center">{{$analysis->rasio}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="rows">
        <div class="col">
            <button class="btn btn-primary btn-block" onclick="window.print()">Print</button>
        </div>
    </div>
</div>
