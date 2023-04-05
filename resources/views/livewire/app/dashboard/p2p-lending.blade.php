<div>
  <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="mb-3 mb-md-0">Selamat Datang di <b>P2P Lending bank CiJ</b></h4>
    </div>
  </div>

  <div class="row">
    {{-- {{dd(menu('dashboard_user'))}} --}}
    <div class="col-12 col-xl-12 stretch-card">
      <div class="row flex-grow">
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-2">Nominal Pembiayaan</h6>
              </div>
              <div class="row">
                <div class="col-8 col-md-12 col-xl-8">
                  <h3 class="mb-2">{{number_format($totalPembiayaan[0]->total_sekarang/1000000000,2,',','.')}} M</h3>
                  <div class="d-flex align-items-baseline">
                    @if($totalPembiayaan[0]->pertumbuhan>0)
                    <p class="text-success">
                      <span>+{{$totalPembiayaan[0]->pertumbuhan}}%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                    @elseif($totalPembiayaan[0]->pertumbuhan<0)
                    <p class="text-danger">
                      <span>{{$totalPembiayaan[0]->pertumbuhan}}%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p>
                    @else
                    <p class="text-secondary">
                      <span>{{$totalPembiayaan[0]->pertumbuhan}}%</span>
                      <i data-feather="minus" class="icon-sm mb-1"></i>
                    </p>
                    @endif
                  </div>
                </div>
                <div class="col-4 col-md-12 col-xl-4">
                  <img src="{{asset('images/credit-card.svg')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-2">Aktif</h6>
              </div>
              <div class="row">
                <div class="col-8 col-md-12 col-xl-8">
                  <h3 class="mb-2">{{number_format($totalNominalAktif[0]->total_sekarang/1000000000,2,',','.')}} M</h3>
                  <div class="d-flex align-items-baseline">
                    @if($totalNominalAktif[0]->pertumbuhan>0)
                    <p class="text-success">
                      <span>+{{$totalNominalAktif[0]->pertumbuhan}}%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                    @elseif($totalNominalAktif[0]->pertumbuhan<0)
                    <p class="text-danger">
                      <span>{{$totalNominalAktif[0]->pertumbuhan}}%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p>
                    @else
                    <p class="text-secondary">
                      <span>{{$totalNominalAktif[0]->pertumbuhan}}%</span>
                      <i data-feather="minus" class="icon-sm mb-1"></i>
                    </p>
                    @endif
                  </div>
                </div>
                <div class="col-4 col-md-12 col-xl-4">
                  <img src="{{asset('images/briefcase.svg')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-2">On Process</h6>
              </div>
              <div class="row">
                <div class="col-8 col-md-12 col-xl-8">
                  <h3 class="mb-2">{{number_format($totalNominalOnProcess[0]->total_sekarang/1000000000,2,',','.')}} M</h3>
                </div>
                <div class="col-4 col-md-12 col-xl-4">
                  <img src="{{asset('images/archive.svg')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-baseline">
                <h6 class="card-title mb-2">Lunas</h6>
              </div>
              <div class="row">
                <div class="col-8 col-md-12 col-xl-8">
                  <h3 class="mb-2">{{number_format($totalNominalLunas[0]->total_sekarang/1000000000,2,',','.')}} M</h3>
                  <div class="d-flex align-items-baseline">
                    @if($totalNominalLunas[0]->pertumbuhan>0)
                    <p class="text-success">
                      <span>+{{$totalNominalLunas[0]->pertumbuhan}}%</span>
                      <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                    </p>
                    @elseif($totalNominalLunas[0]->pertumbuhan<0)
                    <p class="text-danger">
                      <span>{{$totalNominalLunas[0]->pertumbuhan}}%</span>
                      <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                    </p>
                    @else
                    <p class="text-secondary">
                      <span>{{$totalNominalLunas[0]->pertumbuhan}}%</span>
                      <i data-feather="minus" class="icon-sm mb-1"></i>
                    </p>
                    @endif
                  </div>
                </div>
                <div class="col-4 col-md-12 col-xl-4">
                  <img src="{{asset('images/airplay.svg')}}" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> <!-- row -->

  {{-- @livewire('app.dashboard.p2p.component.pendapatan-bunga') --}}
  

  @livewire('app.dashboard.p2p.component.nominal-pembiayaan')

  @livewire('app.dashboard.p2p.component.jumlah-disburse')
  
  @livewire('app.dashboard.p2p.component.pie')

  @livewire('app.dashboard.p2p.component.jatuh-tempo-hari-ini')

  @livewire('app.dashboard.p2p.component.lewat-jatuh-tempo')
  
  {{-- @livewire('app.dashboard.p2p.component.tunggakan-hari') --}}
  
  {{-- @livewire('app.dashboard.p2p.component.tanggal-jadwal-bayar') --}}

  @push('page_specified_js')
  
    <script src="{{asset('js/dashboard.js')}}"></script>

  @endpush
</div>