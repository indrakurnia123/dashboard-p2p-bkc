<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">DETAIL PEMBIAYAAN</h6>
                    <p class="card-description">Data Detail Pembiayaan</p>
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
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Fintech</th>
                                    <th>Nama Borrower</th>
                                    <th>Nominal</th>
                                    <th>No Factsheet</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->fintech->name}}</td>
                                    <td>{{$item->borrowerData->nama}}</td>
                                    <td>{{number_format($item->plafon_penawaran,2,',','.')}}</td>
                                    <td>{{$item->no_factsheet}}</td>
                                    <td>
                                        @if ($item->quick_analysis)
                                            <a href="/analisa/quick-analysis-detail/{{$item->quick_analysis}}"  target="_blank" class="btn btn-primary">
                                                Lihat Analisa
                                            </a>
                                            <a href="#" target="_blank" wire:click.prevent="analisaConfirm('{{$item->no_factsheet}}')" class="btn btn-danger">
                                                Analisa Ulang
                                            </a>                                       
                                        @else
                                        <a href="#" target="_blank" wire:click.prevent="cekAnalisa('{{$item->no_factsheet}}')" class="btn btn-primary">
                                            Analisa
                                        </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                            <div class="pagination">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
