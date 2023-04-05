<div>
  <style>
    :root {
      --primary-color: #555;
      --secondary-color: #999;
      --tertiary-color: #dedede;
      --bg-primary-color: #6c7ae0;
      --bg-secondary-color: #d2d7ff;
      --bg-tertiary-color: #ecefff;
    }
    tr:nth-child(even) {
      background-color: var(--bg-tertiary-color);
    }
    .table-responsive {
      max-height: 300px;
      width: 100%;
      overflow: auto;
    }
    thead {
      position: sticky;
      top: 0;
      background-color: var(--bg-primary-color);
      color: #fff;!important
      border: border-collapse: 
    }
    .table-responsive thead th {
      color: #fff;
    }
    tfoot {
      position: sticky;
      bottom: 0;
      background-color: var(--bg-secondary-color);
      color: #000;
    }
    ::-webkit-scrollbar {
      width: 2px;
    }                     
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }                    
    ::-webkit-scrollbar-thumb {
      background: #888; 
    }                    
    ::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }
  </style>
  <div class="profile-page tx-13">
    <div class="row">
      <div class="col-12 grid-margin">
        <div class="card card-body">
          <div class="cover">
            <div class="cover-body d-flex justify-content-between align-items-center">
              <div>
                <strong class="profile-name">{{$borrower->nama}}</strong>
              </div>
              <div class="d-none d-md-block">
                <button class="btn btn-primary btn-icon-text btn-edit-profile">
                  <i data-feather="edit" class="btn-icon-prepend"></i> Edit profile
                </button>
              </div>
            </div>
          </div>
          <div class="header-links">
            <!-- <ul class="links d-flex align-items-center mt-3 mt-md-0">
              <li class="header-link-item d-flex align-items-center active">
                <i class="mr-1 icon-md" data-feather="columns"></i>
                <a class="pt-1px d-none d-md-block" href="#">Timeline</a>
              </li>
              <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                <i class="mr-1 icon-md" data-feather="user"></i>
                <a class="pt-1px d-none d-md-block" href="#">About</a>
              </li>
              <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                <i class="mr-1 icon-md" data-feather="users"></i>
                <a class="pt-1px d-none d-md-block" href="#">Friends <span class="text-muted tx-12">3,765</span></a>
              </li>
              <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                <i class="mr-1 icon-md" data-feather="image"></i>
                <a class="pt-1px d-none d-md-block" href="#">Photos</a>
              </li>
              <li class="header-link-item ml-3 pl-3 border-left d-flex align-items-center">
                <i class="mr-1 icon-md" data-feather="video"></i>
                <a class="pt-1px d-none d-md-block" href="#">Videos</a>
              </li>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
    <div class="row profile-body">
      <!-- left wrapper start -->
      <div class="d-none d-md-block col-md-12 col-xl-12 left-wrapper mb-3">
        <div class="card rounded">
          <div class="card-body">
            <div class="d-flex align-items-center justify-content-between mb-2">
              <h6 class="card-title mb-0">Profile Borrower</h6>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="edit-2" class="icon-sm mr-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="git-branch" class="icon-sm mr-2"></i> <span class="">Update</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="#"><i data-feather="eye" class="icon-sm mr-2"></i> <span class="">View all</span></a>
                </div>
              </div>
            </div>
            <div class="row d-flex justify-content-between">
              <div class="col-2">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Mulai Usaha :</label>
                  <p class="text-muted text-left">Nomor PKS</p>
                </div>
              </div>
              <div class="col-2">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Rating Borrower :</label>
                  <p class="text-muted text-left">Izin OJK</p>
                </div>
              </div>
              <div class="col-2">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Jenis Borrower :</label>
                  <p class="text-muted text-left">Outstanding</p>
                </div>
              </div>
              <div class="col-2">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Sektor Usaha :</label>
                  <p class="text-muted text-left">TKB Fintech</p>
                </div>
              </div>
              <div class="col-2">
                <div class="mt-3">
                  <label class="tx-11 font-weight-bold mb-0 text-uppercase">Riwayat Recurring :</label>
                  <p class="text-muted text-left">Cakupan Wilayah</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- left wrapper end -->
      <!-- middle wrapper start -->
      <div class="col-md-12 middle-wrapper">
        <div class="card">
          <div class="card-body">
            <div class="row py-3">
              <div class="col">
                <h4 class="text-left">Rekap Pembiayaan</h4>
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%">
                    <thead>
                      <tr align="center">
                        <th style="width: 30%;">Nama Fintech</th>
                        <th style="width: 30%;">Status Pembiayaan</th>
                        <th style="width: 20%;">Noa</th>
                        <th style="width: 20%;" >Nominal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($borrowerByStatus as $item)
                      <tr>
                        <td>{{$item->nama_fintech}}</td>
                        <td>{{$item->status}}</td>
                        <td align="center">{{$item->noa}}</td>
                        <td align="right">{{number_format($item->nominal,2,',','.')}}</td>
                      </tr>                              
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2" align="center">Total Keseluruhan</td>
                        <td align="center">{{$borrowerByStatus->sum('noa')}}</td>
                        <td align="right">{{number_format($borrowerByStatus->sum('nominal'),2,',','.')}}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <div class="row py-3">
              <div class="col">
                <h4 class="text-left">Rekap Payor</h4>
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%">
                    <thead>
                      <tr align="center">
                        <th style="width: 30%;">Nama Payor</th>
                        <th style="width: 30%;">Status Pembiayaan</th>
                        <th style="width: 20%;">Jumlah Factsheet</th>
                        <th style="width: 20%;">Nominal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($borrowerByPayor as $item)
                        <tr>
                          <td>{{$item->nama_payor}}</td>
                          <td align="left">{{$item->status}}</td>
                          <td align="center">{{$item->jml_factsheet}}</td>
                          <td align="right">{{number_format($item->nominal,2,',','.')}}</td>
                        </tr>                              
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="2" align="center">Total Keseluruhan</td>
                        <td align="center">{{$borrowerByPayor->sum('jml_factsheet')}}</td>
                        <td align="right">{{number_format($borrowerByPayor->sum('nominal'),2,',','.')}}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
            <div class="row py-3">
              <div class="col">
                <h4 class="text-left">Pembiayaan Aktif</h4>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>No. Factsheet</th>
                        <th style="width: 30%;">Nama Borrower</th>
                        <th style="width: 20%;">Fintech</th>
                        <th style="width: 20%;">Status Pembiayaan</th>
                        <th style="width: 20%;">Nominal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($borrower->lending->where('status_pembiayaan',1) as $item)
                      <tr>
                        <td>{{$item->no_factsheet}}</td>
                        <td>{{$item->borrowerData->nama}}</td>
                        <td>{{$item->fintech->name}}</td>
                        <td>{{$item->statusPembiayaanData->nama}}</td>
                        <td align="right">{{number_format($item->nominal_pembiayaan,2,',','.')}}</td>
                      </tr>                              
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        {{-- <td align="center">{{$borrower->lending->where('status_pembiayaan',1)->count('id')}}</td> --}}
                        <td colspan="4" align="center">Total Keseluruhan</td>
                        <td align="right">{{number_format($borrower->lending->where('status_pembiayaan',1)->sum('nominal_pembiayaan'),2,',','.')}}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- middle wrapper end -->
    </div>
  </div>
</div>
