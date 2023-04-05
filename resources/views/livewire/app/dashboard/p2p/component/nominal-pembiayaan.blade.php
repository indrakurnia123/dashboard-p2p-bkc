<div class="row">
    {{-- table --}}
    <div class="col-12">
        <div class="row flex-grow">
        <div class="col-12 grid-margin">
            <div class="card">
            <div class="card-body">
                <h6 class="card-title">Nominal Pembiayaan</h6>
                <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Nama Fintech</td>
                            <td align="right">Plafon</td>
                            <td align="right">Baki Debet</td>
                            <td align="right">Lunas</td>
                            <td align="right">Total Disburse</td>
                            <td>Limit Fintech</td>
                            <td>Sisa Limit</td>
                            <td>Presentase Limit</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $total_plafon_aktif=0; 
                            $total_baki_debet=0; 
                            $total_nominal_lunas=0; 
                            $total_nominal_total=0; 
                        ?>
                    @foreach($data as $dataItem)
                    <?php 
                        $total_plafon_aktif+=$dataItem->plafon_aktif;
                        $total_baki_debet+=$dataItem->baki_debet;
                        $total_nominal_lunas+=$dataItem->nominal_lunas;
                        $total_nominal_total+=$dataItem->nominal_total;
                    ?>
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <th class="py-2">
                            <a href="/data/finteches/detail/{{$dataItem->fintech_id}}" target="_blank"><img class="img"style="object-fit: scale-down; width:100px; height:50px;" src="{{asset('storage/'.$dataItem->logo)}}" alt="profile"></a>
                        </th>
                        <td align="right">{{number_format($dataItem->plafon_aktif,0,',','.')}}</td>
                        <td align="right">{{number_format($dataItem->baki_debet,0,',','.')}}</td>
                        <td align="right">{{number_format($dataItem->nominal_lunas,0,',','.')}}</td>
                        <td align="right">{{number_format($dataItem->nominal_total,0,',','.')}}</td>
                        <td>
                            {{number_format($dataItem->outstanding/1000000000,2,',','.')."M / ".number_format($dataItem->nominal_limit/1000000000,2,',','.')." M"}}
                            <div class="progress mt-1" style="width:200px;">
                                <div class="progress-bar 
                                @switch(100-$dataItem->sisa_persen)
                                    @case(100-$dataItem->sisa_persen>50 && 100-$dataItem->sisa_persen<80)
                                    bg-warning
                                    @break
                                    @case(100-$dataItem->sisa_persen>80)
                                    bg-danger
                                    @break
                                    @default
                                    bg-success
                                @endswitch
                                " role="progressbar" style="width: {{100-$dataItem->sisa_persen}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </td>
                        <td>{{number_format($dataItem->sisa_limit/1000000000,2,',','.')." M "}}</td>
                        <td>{{strval(100-$dataItem->sisa_persen)." %"}}</td>
                    </tr>
                    @endforeach
                    <tr style="font-weight:bold;">
                        <td colspan="2"></td>
                        <td align="right">{{number_format($total_plafon_aktif,2,',','.')}}</td>
                        <td align="right">{{number_format($total_baki_debet,2,',','.')}}</td>
                        <td align="right">{{number_format($total_nominal_lunas,2,',','.')}}</td>
                        <td align="right">{{number_format($total_nominal_total,2,',','.')}}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>