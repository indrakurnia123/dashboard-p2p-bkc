<div>
    
  <div class="row flex-grow">
    <div class="col-md-12 grid-margin">
        {{-- <div class="home-tab mb-4">
            <div class="d-sm-flex align-items-center justify-content-between border-bottom">
              <div class="btn-wrapper mb-3">
                <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                </div>
            </div>
        </div> --}}
        <div class="card card-rounded">
            <div class="card-body">
                <h6 class="card-title">DATA BORROWER</h6>
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
                                        <th>Nama Perusahaan</th>
                                        {{-- <th>Jenis Pembiayaan</th> --}}
                                        <th>Bentuk Badan Hukum</th>
                                        {{-- <th>Jenis Borrower</th> --}}
                                        {{-- <th>Riwayat Recurring</th> --}}
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ ($data ->currentpage()-1) * $data ->perpage() + $loop->index + 1 }}</td>
                                    <td>{{$item->nama}}</td>
                                    <td>{{$item->bentuk_badan_hukum->nama}}</td>
                                    {{-- <td>{{$item->jenis_pembiayaan->nama}}</td> --}}
                                    {{-- <td>{{$item->sektor_usaha->nama}}</td> --}}
                                    <td>
                                        <a href="{{route('data.borrower.detail',$item->id)}}" class="btn btn-primary">Detail</a>
                                        <a href="/admin/finteches/5/edit" class="btn btn-warning">Edit</a>
                                    </td>
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
