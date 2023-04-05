<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Analisa Keuangan</h6>
                    <p class="card-description text-left">Data Analisa Keuangan Borrower</p>
                    <div class="d-flex flex-row-reverse">
                        <a type="button" href="{{route('analisa.keuangan.register')}}" class="btn btn-success btn-icon-text mb-3 mt-2 text-white">
                            <i class="btn-icon-prepend" data-feather="file-plus"></i>
                            Buat Analisa
                        </a>
                    </div>
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
                                    <th>Kode Analisa</th>
                                    <th>Tanggal Analisa</th>
                                    <th>Nama Fintech</th>
                                    <th>Nama Borrower</th>
                                    <th>Total Penawaran</th>
                                    <th>Jumlah Factsheet</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($data as $item)
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->kode_analisa}}</td>
                                    <td>{{$item->tanggal_analisa}}</td>
                                    <td>{{$item->fintech->name}}</td>
                                    <td>{{$item->borrowerData->nama}}</td>
                                    <td align="right">{{number_format($item->total_plafon_penawaran,2,',','.')}}</td>
                                    <td align="center">{{$item->lending->count()}}</td>
                                    <td>
                                        <a href="/analisa/analisa-keuangan/detail/{{$item->id}}" class="btn btn-primary" target="_blank">
                                            Lihat Analisa
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" align="center">Tidak ada data!</td>
                                    </tr>
                                @endforelse
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
