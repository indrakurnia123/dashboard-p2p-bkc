<div class="container w-75 mt-4">
    @push('page_specified_css')
    @endpush
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h4>Transaksi</h4>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="storeTransaksi">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="form-group my-0">
                                    <label for="">Nomor Factsheet</label>
                                    <input type="text" class="form-control" wire:model="noFactsheet" placeholder="Masukan Nomor Factsheet">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group my-0">
                                    <label for="">&nbsp;</label>
                                    <button class="btn btn-primary form-control" wire:click.prevent="cekData">Cek data</button>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">No Factsheet</label>
                                    <input type="text" class="form-control" wire:model="lendingData.no_factsheet" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">No Rekening</label>
                                    <input type="text" class="form-control" wire:model="lendingData.no_rekening">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">Status</label>
                                    <input type="text" class="form-control" wire:model="lendingData.status" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="form-group-my-0">
                                    <label for="">Nama Borrower</label>
                                    <input type="text" class="form-control" wire:model="lendingData.borrower" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">Tanggal penawaran</label>
                                    <input type="text" class="form-control" wire:model="lendingData.tanggal_penawaran" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">Nama Fintech</label>
                                    <input type="text" class="form-control" wire:model="lendingData.fintech" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">Plafon Penawaran</label>
                                    <input type="text" class="form-control" wire:model="lendingData.plafon_penawaran" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">Tanggal jatuh tempo</label>
                                    <input type="text" class="form-control" wire:model="lendingData.jatuh_tempo" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group my-0">
                                    <label for="">Suku Bunga</label>
                                    <input type="text" class="form-control" wire:model="lendingData.bunga" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group my-0">
                                    <label for="">JKW</label>
                                    <input type="text" class="form-control" wire:model="lendingData.jangka_waktu" readonly>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group my-0">
                                    <label for="">&nbsp;</label>
                                    <input type="text" class="form-control" wire:model="lendingData.type_jangka_waktu" readonly>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kode Transaksi</label>
                                    <select class="form-control" wire:model="selected_kode_transaksi">
                                        <option value="">-- Pilih Kode Trx --</option>
                                        @forelse ($kode_transaksi as $item)
                                            <option value="{{$item->kode}}">{{$item->nama}}</option>
                                        @empty
                                            <option value="">Tidak Ada Kode Transaksi di database!</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tanggal Transaksi</label>
                                    <input type="date" class="form-control datetimepicker" wire:model="dataTransaksi.tanggal">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Pokok</label>
                                    <input type="text" class="form-control" wire:model="dataTransaksi.pokok">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Bunga</label>
                                    <input type="text" class="form-control" wire:model="dataTransaksi.bunga">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Diskon Bunga</label>
                                    <input type="text" class="form-control" wire:model="dataTransaksi.diskon_bunga">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Denda</label>
                                    <input type="text" class="form-control" wire:model="dataTransaksi.denda">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-right">
                                <button type="submit" class="btn-primary btn">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>