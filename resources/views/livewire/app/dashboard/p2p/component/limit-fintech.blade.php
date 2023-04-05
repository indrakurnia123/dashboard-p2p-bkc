
                
<div class="row flex-grow">
    <div class="col-12 grid-margin stretch-card">
        <div class="card card-rounded">
            <div class="card-body">
                <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h4 class="card-title card-title-dash">Limit Fintech</h4>
                    </div>
                    </div>
                    <div class="mt-3">
                    @foreach($limitFintech as $item)
                    <div class="wrapper d-flex align-items-center justify-content-between py-2 border-bottom">
                        <div class="d-flex">
                        <div class="wrapper ms-3 ">
                            <p class="ms-1 mb-1 fw-bold">{{$item->name}}</p>
                            <small class="text-muted mb-0">{{number_format($item->outstanding/1000000000,2,',','.')."M / ".number_format($item->nominal_limit/1000000000,2,',','.')." M"}}</small>
                            <div class="progress" style="width:200px;">
                                <div class="progress-bar 
                                @switch(100-$item->sisa_persen)
                                    @case(100-$item->sisa_persen>50 && 100-$item->sisa_persen<80)
                                    bg-warning
                                    @break
                                    @case(100-$item->sisa_persen>80)
                                    bg-danger
                                    @break
                                    @default
                                    bg-success
                                @endswitch
                                " role="progressbar" style="width: {{100-$item->sisa_persen}}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="text-muted text-small">
                        {{number_format($item->sisa_limit/1000000000,2,',','.')." M (".strval($item->sisa_persen).")"}} % Tersisa
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>