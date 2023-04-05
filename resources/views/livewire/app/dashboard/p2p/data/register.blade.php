<div>
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">INPUT PEMBAYARAN P2P</h4>
                        <form class="forms-sample" wire:submit.prevent="store">
                            <!-- ROW 1 -->
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="factsheet">No. Factsheet</label>
                                        <input type="text" class="form-control @error('no_factsheet') is-invalid @enderror" wire:model.lazy="no_factsheet" placeholder="No. Factsheet" />
                                        @error('no_factsheet')        
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group" wire:ignore>
                                            <label>Nama Fintech</label>
                                            <select class="js-example-basic-single w-100 @error('fintech_id') is-invalid @enderror" id="fintech_id" name="fintech_id">
                                                <option>-- Pilih Fintech --</option>
                                                @forelse($finteches as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @empty
                                                    <option>Tidak ada pilihan di database!</option>
                                                @endforelse
                                            </select>
                                        </div>                                    
                                        @error('fintech_id')        
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- TUTUP ROW 1 -->

                            <!-- ROW 2 -->
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group" wire:ignore>
                                        <label for="nama_borrower">Nama Borrower</label>
                                        <select class="js-example-basic-single w-100" id="borrower">
                                        <option selected>-- Pilih Borrower --</option>
                                            @forelse($borrowerData as $borrower)
                                                <option value="{{$borrower->id}}">{{$borrower->nama}}</option>
                                            @empty
                                                <option>Tidak ada data borrower</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group" wire:ignore>
                                        <label for="nama_borrower">Bentuk Badan Hukum</label>
                                        <select class="js-example-basic-single w-100" id="bentuk_badan_hukum">
                                        <option selected>-- Pilih Bentuk Badan Hukum --</option>
                                            @forelse($bentukBadanHukum as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW 2 -->

                            <!-- ROW 3 -->
                            <div class="row">
                                <div class="col-6" wire:ignore>
                                    <div class="form-group">
                                        <label for="lokasi_perusahaan">Lokasi Perusahaan</label>
                                        <select class="js-example-basic-single w-100" id="lokasi_perusahaan">
                                        <option selected>-- Pilih Lokasi Perusahaan --</option>
                                            @forelse($lokasiPerusahaanData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6" wire:ignore>
                                    <div class="form-group">
                                        <label for="sektor_usaha">Sektor Usaha</label>
                                        <select class="js-example-basic-single w-100" id="sektor_usaha">
                                        <option selected>-- Pilih Sektor Usaha --</option>
                                            @forelse($sektorUsahaData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW 3 -->

                            <!-- ROW 4 -->
                            <div class="row">
                                <div class="col-6" wire:ignore>
                                    <div class="form-group">
                                        <label for="nama_lokasi_projek">Lokasi Proyek</label>
                                        <select class="js-example-basic-single w-100" id="lokasi_project">
                                        <option selected>-- Pilih Lokasi Lokasi Proyek --</option>
                                            @forelse($lokasiProjectData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6" wire:ignore>
                                    <div class="form-group">
                                        <label for="jenis_pembiayaan">Jenis Pembiayaan</label>
                                        <select class="js-example-basic-single w-100" id="jenis_pembiayaan">
                                        <option selected>-- Pilih Jenis Pembiayaan --</option>
                                            @forelse($jenisPembiayaanData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW 4 -->

                            <!-- ROW 5 -->
                            <div class="row">
                                <div class="col-3" wire:ignore>
                                    <div class="form-group">
                                        <label for="">Kriteria Borrower</label>
                                        <select class="js-example-basic-single w-100" id="kriteria_borrower">
                                        <option selected>-- Pilih Kriteria Borrower --</option>
                                            @forelse($kriteriaBorrowerData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" wire:ignore>
                                    <div class="form-group">
                                        <label for="">Jenis Penggunaan</label>
                                        <select class="js-example-basic-single w-100" id="jenis_penggunaan">
                                        <option selected>-- Pilih Jenis Penggunaan --</option>
                                            @forelse($jenisPenggunaanData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3" wire:ignore>
                                    <div class="form-group">
                                        <label for="add_pk">ADD & PK</label>
                                        <select class="js-example-basic-single w-100" id="add_pk">
                                        <option selected>-- Pilih Add PK --</option>
                                            @forelse($addPkData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>                                
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="tanggal_pembiayaan">Tanggal Penawaran</label>
                                        <input type="date" class="form-control" wire:model.lazy="tanggal_penawaran"/>
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW 5 -->

                            <!-- ROW 6 -->
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group">
                                        <label for="plafon_penawaran">Plafon Penawaran</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" wire:model.lazy="plafon_penawaran"  aria-label="Amount (to the nearest dollar)" />
                                            <div class="input-group-append">
                                                <span class="input-group-text">.00</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="jangka_waktu">jangka_waktu</label>
                                        <input type="number" class="form-control" wire:model.lazy="jangka_waktu" id="jangka_waktu" placeholder="jangka_waktu" />
                                    </div>
                                </div>
                                <div class="col-2" wire:ignore>
                                    <div class="form-group">
                                        <label for="type">Type Jkw</label>
                                        <select class="js-example-basic-single w-100" id="type_jangka_waktu">
                                        <option selected>-- Pilih Type Jkw --</option>
                                            @forelse($typeJangkaWaktuData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="bunga">Suku Bunga</label>
                                        <input type="text" class="form-control" id="bunga" placeholder="Bunga" wire:model.lazy="suku_bunga" />
                                    </div>
                                </div>
                            </div>
                            <!-- End ROW 6 -->
                            <!-- row 7 -->
                            <div class="row">
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="tujuan_pinjaman">Tujuan Pinjaman</label>
                                        <select class="js-example-basic-single w-100" id="tujuan_pinjaman">
                                            <option selected>-- Tujuan Pinjaman --</option>
                                            @forelse($tujuanPinjamanData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="sifat_pembiayaan">Sifat Pembiayaan</label>
                                        <select class="js-example-basic-single w-100" id="sifat_pembiayaan">
                                            <option selected>-- Tujuan Pinjaman --</option>
                                            @forelse($sifatPembiayaanData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="agunan_utama">Agunan Utama</label>
                                        <select class="js-example-basic-single w-100" id="agunan_utama">
                                            <option selected>-- Agunan Utama --</option>
                                            @forelse($agunanUtamaData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- row 7 -->

                            <!-- ROW 10 -->
                            <div class="row">
                                <div class="col-8" wire:ignore>
                                    <div class="form-group">
                                        <label for="nama_payor">Nama Payor</label>
                                        <select class="js-example-basic-single w-100" id="payor_id" multiple="">
                                            @forelse($payorData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="bonafide">Bonafide</label>
                                        <select class="js-example-basic-single w-100" id="bonafiditas">
                                        <option selected>-- Pilih Bonafiditas --</option>
                                            @forelse($bonafiditasData as $item)
                                                <option value="{{$item->id}}">{{$item->status}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- ROW 10 -->

                            <!-- ROW 8 -->
                            <div class="row">
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="rating_fintech">Rating Fintech</label>
                                        <select class="js-example-basic-single w-100" id="rating_fintech">
                                            <option selected>-- Rating Fintech --</option>
                                            @forelse($ratingFintechData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="rating_pefindo">Rating Pefindo</label>
                                        <select class="js-example-basic-single w-100" id="rating_pefindo">
                                            <option selected>-- Rating Pefindo --</option>
                                            @forelse($ratingPefindoData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="repeat_order">Repeat Order</label>
                                        <select class="js-example-basic-single w-100" id="repeat_order">
                                            <option selected>-- Repeat Order --</option>
                                            @forelse($repeatOrderData as $item)
                                                <option value="{{$item->id}}">{{$item->nama}}</option>
                                            @empty
                                                <option>Tidak ada data item</option>
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- ROW 8 -->

                            <!-- ROW 8 -->
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="baki_debet">Baki Debet Kredit</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" aria-label="Amount (to the nearest dollar)" wire:model.lazy="baki_debet" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">No Rekening MBS</label>
                                    <input type="text" class="form-control" wire:model.lazy="no_rekening">
                                </div>
                                <div class="col-4" wire:ignore>
                                    <div class="form-group">
                                        <label for="status_pembiayaan">Status Pembiayaan</label>
                                        <select class="js-example-basic-single w-100" id="status_pembiayaan" disabled>
                                            <option selected value="4">New</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- ROW 8 -->

                            <!-- ROW -->
                            <div class="row">
                                <div class="col-4" wire:ignore>
                                    <label>Asuransi</label>
                                    <select class="js-example-basic-single w-100" id="asuransi">
                                        <option selected>-- Asuransi --</option>
                                        @forelse($asuransiData as $item)
                                            <option value="{{$item->id}}">{{$item->nama}}</option>
                                        @empty
                                            <option>Tidak ada data item</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Asuransi Persen</label>
                                    <input type="number" class="form-control" wire:model.lazy="persen_asuransi" />
                                </div>
                                <div class="col-4">
                                    <label>Admin Persen</label>
                                    <input type="number" class="form-control" wire:model.lazy="persen_asuransi" />
                                </div>
                            </div>
                            <!-- ROW -->

                            <div class="row form-group">
                                <div class="col">
                                    <label>Link Dokumen</label>
                                    <input type="text" class="form-control" wire:model.lazy="link_dokumen" />
                                </div>
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('page_specified_js')
    <script>
        $(document).ready(function(){
            $('#fintech_id').change(function(e){
                var value = $(this).val();
                localStorage.setItem('fintech_id',$(this).val());
                @this.fintech_id=value;
            });
            $('#borrower').change(function(e){
                var value = $(this).val();
                @this.borrower=value;
            });
            $('#bentuk_badan_hukum').change(function(e){
                var value = $(this).val();
                @this.bentuk_badan_hukum=value;
            });
            $('#lokasi_perusahaan').change(function(e){
                var value = $(this).val();
                @this.lokasi_perusahaan=value;
            });
            $('#sektor_usaha').change(function(e){
                var value = $(this).val();
                @this.sektor_usaha=value;
            });
            $('#lokasi_project').change(function(e){
                var value = $(this).val();
                @this.lokasi_project=value;
            });
            $('#jenis_pembiayaan').change(function(e){
                var value = $(this).val();
                @this.jenis_pembiayaan=value;
            });
            $('#add_pk').change(function(e){
                var value = $(this).val();
                @this.add_pk=value;
            });
            $('#type_jangka_waktu').change(function(e){
                var value = $(this).val();
                @this.type_jangka_waktu=value;
            });
            $('#tujuan_pinjaman').change(function(e){
                var value = $(this).val();
                @this.tujuan_pinjaman=value;
            });
            $('#sifat_pembiayaan').change(function(e){
                var value = $(this).val();
                @this.sifat_pembiayaan=value;
            });
            $('#payor_id').change(function(e){
                let value = $(this).val();
                @this.set('newFactsheetPayor',value);
            });
            $('#agunan_utama').change(function(e){
                var value = $(this).val();
                @this.agunan_utama=value;
            });
            $('#repeat_order').change(function(e){
                var value = $(this).val();
                @this.repeat_order=value;
            });
            $('#rating_fintech').change(function(e){
                var value = $(this).val();
                @this.rating_fintech=value;
            });
            $('#rating_pefindo').change(function(e){
                var value = $(this).val();
                @this.rating_pefindo=value;
            });
            $('#bonafiditas').change(function(e){
                var value = $(this).val();
                @this.bonafiditas=value;
            });
            $('#status_pembiayaan').change(function(e){
                var value = $(this).val();
                @this.status_pembiayaan=value;
            });
            $('#asuransi').change(function(e){
                var value = $(this).val();
                @this.asuransi=value;
            });
            $('#kriteria_borrower').change(function(e){
                var value = $(this).val();
                @this.kriteria_borrower=value;
            });
            $('#jenis_penggunaan').change(function(e){
                var value = $(this).val();
                @this.jenis_penggunaan=value;
            });

        });
    </script>
    @endpush
</div>
