<div>
    <div class="row flex-grow">
        <div class="col-md-12 grid-margin">
            <div class="home-tab mb-4">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-center" wire:click.prevent="selectStatus('*')" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{"All"." (".$totalPembiayaanCount.")"}}</a>
                        </li>
                        @foreach($statuses as $status)
                        <li class="nav-item">
                            <a class="nav-link text-center" wire:click.prevent="selectStatus({{$status->id}})" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">{{$status->status." (".$status->jml.")"}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div>
                        <div class="btn-wrapper">
                        <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                        <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                        <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-rounded">
                <div class="card-body">
                    <h6 class="card-title">DETAIL PEMBIAYAAN</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="dataTables_length d-flex flex-row" id="dataTableExample_length">
                                <label class="p-2">Show </label>
                                    <select class="custom-select custom-select-sm form-control w-10" wire:model="paginate">
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                <label class="p-2"> entries</label>
                            </div>
                        </div>
                        <div class="col-6">
                            <div id="dataTableExample_filter" class="dataTables_filter d-flex flex-row-reverse">
                                <label class="w-300">
                                    <input type="search" class="form-control" placeholder="No Factsheet / Fintech / Borrower" wire:model="querySearch">
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive">
                                <table id="dataTableExamplexx" class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tanggal Awal</th>
                                            <th>Tanggal Jt Tempo</th>
                                            <th>Nama Fintech</th>
                                            <th>No. Rekening</th>
                                            <th>Nama Borrower</th>
                                            <th>Nama Payor</th>
                                            <th>Sifat Pembiayaan</th>
                                            <th>JKW</th>
                                            <th>Status</th>
                                            <th>Bunga</th>
                                            <th>Nominal Pembiayaan</th>
                                            <th>No Factsheet</th>
                                            <th>Dokumen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($data as $item)
                                    <tr>
                                        <td>{{ ($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
                                        <td>{{$item->tanggal_pembiayaan}}</td>
                                        <td>{{$item->jatuh_tempo}}</td>
                                        <td>{{$item->fintech->name}}</td>
                                        <td>{{$item->no_rekening}}</td>
                                        <td>{{$item->borrowerData->nama}}</td>
                                        <td>
                                            <ul>
                                            @foreach ($item->payor as $itemPayor)
                                                <li>{{$itemPayor->nama}}</li>
                                            @endforeach
                                            </ul>
                                        </td>
                                        <td>{{$item->sifatPembiayaanData->nama}}</td>
                                        <td>{{$item->jangka_waktu." ".$item->typeJangkaWaktuData->nama}}</td>
                                        <td>{{$item->statusPembiayaanData->nama}}</td>
                                        <td>{{$item->bunga*100}} %</td>
                                        <td align="right">{{number_format($item->nominal_pembiayaan,2,',','.')}}</td>
                                        <td align="right">{{$item->no_factsheet}}</td>
                                        <td>{{$item->link_dokumen}}</td>
                                        <td><a href="/data/detail/{{$item->id}}" class="btn btn-primary">Detail</a></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination mt-2">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
