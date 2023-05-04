        
        <!-- middle wrapper start -->
        <div class="col-md-12 col-xl-12 middle-wrapper mt-3">
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h6 class="card-title mb-0 mb-3">Info Pembiayaan</h6>
                    <div class="row">
                      <div class="col">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr align="center" style="background-color: var(--bg-primary-color); color: #fff;">
                                <td>Angsuran ke</td>
                                <td>Tanggal</td>
                                <td>Pokok</td>
                                <td>Bunga</td>
                                <td>Total</td>
                                <td>Keterangan</td>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($jadwalAngsuran as $item)
                              <tr>
                                <td align="center">{{$loop->index+1}}</td>
                                <td align="center">{{$item->Tanggal}}</td>
                                <td align="right">{{number_format($item->Pokok,2,',','.')}}</td>
                                <td align="right">{{number_format($item->Bunga,2,',','.')}}</td>
                                <td align="right">{{number_format($item->Total,2,',','.')}}</td>
                                <td>{{$item->Uraian}}</td>
                              </tr>
                              @empty
                                <tr>
                                  <td colspan="7"><button class="btn btn-primary" wire:click.prevent="$emit('createJadwalAngsuran','{{$lending->no_factsheet}}')">Create Jadwal Angsuran</button></td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- middle wrapper end -->