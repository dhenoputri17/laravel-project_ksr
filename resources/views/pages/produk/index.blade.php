@extends('layouts.template')
@section('utama')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Produk</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Produk</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        {{-- notif --}}
                        @if (session('berhasil'))
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>x</span>
                                    </button>
                                    {{ session('berhasil') }}
                                </div>
                            </div>
                        @endif
                        @if (session('gagal'))
                            <div class="alert alert-warning alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>x</span>
                                    </button>
                                    {{ session('gagal') }}
                                </div>
                            </div>
                        @endif
                        {{-- end notif --}}
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">Data Produk</h5>
                            </div>
                            <div class="col-md-3 px-3" align="right">
                                <div class="btn-group-sm">
                                    <a href="#" class="btn btn-cyan" data-toggle="modal"
                                        data-target="#modal-tambah"><i title="Tambah data" data-toggle="tooltip"
                                            class="fa fa-plus-circle"></i> Tambah</a>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel-produk" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th style="width: 15%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modalku')
    {{-- modal tambah --}}
    <div class="modal fade" id="modal-tambah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Produk</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <form action="{{ url('/simpan-produk') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Kode Produk</span>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <input type="text" data-toggle="tooltip" title="Kode Produk"
                                                class="form-control" id="kode" name="kode"
                                                value="{{ app('App\Http\Controllers\ProdukController')->code() }}" required>
                                            <div class="valid-feedback" id="R_kode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Nama Produk</span>
                                        </div>
                                        <div class="col-lg-8 col-md-12">
                                            <input type="text" data-toggle="tooltip" title="Masukkan Nama Produk"
                                                class="form-control" id="nama" name="nama"
                                                placeholder="Masukkan Nama Produk" required>
                                            <div class="valid-feedback" id="R_nama">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row px-4 align-items-center">
                                        <div class="col-md-3">
                                            <div class="row mb-3 align-items-center">
                                                <span>Stok Awal</span>
                                                <input type="number" data-toggle="tooltip" title=" Masukkan Stok Awal"
                                                    oninput="autoInputs(this.value)" class="form-control" id="awal"
                                                    name="awal" placeholder="0" required>
                                                <div class="valid-feedback" id="R_awal">
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div class="col-md-3">
                                            <div class="row mb-3 align-items-center">
                                                <span>Stok Akhir</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Stok Akhir"
                                                    class="form-control" id="akhir" name="akhir" placeholder="0"
                                                    required>
                                                <div class="valid-feedback" id="R_akhir">
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div class="col-md-3">
                                            <div class="row mb-3 align-items-center">
                                                <span>Stok Minimal</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Stok Minimal"
                                                    class="form-control" id="minimal" name="minimal" placeholder="0"
                                                    required>
                                                <div class="valid-feedback" id="R_minimal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row px-4 align-items-center">
                                        <div class="col-md-5">
                                            <div class="row mb-3 align-items-center">
                                                <span>Harga Beli</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Harga Beli"
                                                    class="form-control" id="beli" name="beli"
                                                    placeholder="Harga Beli" required>
                                                <div class="valid-feedback" id="R_beli">
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div class="col-md-5">
                                            <div class="row mb-3 align-items-center">
                                                <span>Harga Jual</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Harga Jual"
                                                    class="form-control" id="jual" name="jual"
                                                    placeholder="Harga Jual" required>
                                                <div class="valid-feedback" id="R_jual">
                                                </div>
                                            </div>
                                            <input type="hidden" name="status" value="A">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center px-4">
                                        <span>Kategori</span>
                                        <div class="col-md-9">
                                            <select class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" id="kategori" name="kategori">
                                                <option selected="true" disabled>Pilih</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center px-4">
                                        <span>Deskripsi</span>
                                        <textarea id="deskiripsi" name="deskripsi" class="form-control"style="height: 100px"
                                            placeholder="Masukkan Deskripsi Produk"></textarea>
                                    </div>
                                    <div class="row mb-3 align-items-center px-4">
                                        <span>Foto</span>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="file"
                                                    value="" name="file" accept="image/*" name="image"
                                                    onchange="loadFile(event, 'output')" style="display: none">
                                                <label class="custom-file-label" for="file"
                                                    style="cursor: pointer">Pilih file...</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                        </div>
                                        <img id="output" width="200" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-default" id="batal1" onclick="batal()">Batal</button>
                        <button type="reset" class="btn btn-warning">Bersihkan</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal detail --}}
    <div class="modal fade" id="modal-up">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Produk</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-3 me-3 my-2">
                                <img class="card-img-top mx-4 my-3 mb-md-0 img-thumbnail" style="width: 17rem"
                                    src="" alt="" id="ima" />
                            </div>
                            &nbsp; &nbsp;&nbsp; &nbsp;
                            <div class="col-md-8 ms-3 my-2">
                                <div class="table-responsive">
                                    <table id="table-detail"
                                        class="table table-sm table-striped table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th colspan="2" style="font-weight: bold;" class="bg-warning">Rincian Produk</th>
                                            </tr>
                                        </thead>
                                        <tbody style="width: 40%">
                                            <tr>
                                                <td>Kode Produk</td>
                                                <td id="kdp"></td>
                                            </tr>
                                            <tr>
                                                <td>Nama Produk</td>
                                                <td id="nmp"></td>
                                            </tr>
                                            <tr>
                                                <td>Kategori Produk</td>
                                                <td id="ktp"></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Beli</td>
                                                <td id="hbp"></td>
                                            </tr>
                                            <tr>
                                                <td>Harga Jual</td>
                                                <td id="hjp"></td>
                                            </tr>
                                            <tr>
                                                <td>Stok Awal</td>
                                                <td id="swp"></td>
                                            </tr>
                                            <tr>
                                                <td>Stok Akhir</td>
                                                <td id="skp"></td>
                                            </tr>
                                            <tr>
                                                <td>Stok Minimal</td>
                                                <td id="smp"></td>
                                            </tr>
                                            <tr>
                                                <td>Deskripsi Produk</td>
                                                <td id="dsp"></td>
                                            </tr>
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

    {{-- modal ubah --}}
    <div class="modal fade" id="modal-ubah">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Edit Data Produk</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <form action="{{ url('/rubah-produk') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Kode Produk</span>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <input type="hidden" name="id" id="id">
                                            <input type="text" data-toggle="tooltip" title="Kode Produk"
                                                class="form-control" id="kode" name="kode" required>
                                            <div class="valid-feedback" id="R_kode">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Nama Produk</span>
                                        </div>
                                        <div class="col-lg-8 col-md-12">
                                            <input type="text" data-toggle="tooltip" title="Masukkan Nama Produk"
                                                class="form-control" id="nama" name="nama"
                                                placeholder="Masukkan Nama Produk" required>
                                            <div class="valid-feedback" id="R_nama">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row px-4 align-items-center">
                                        <div class="col-md-3">
                                            <div class="row mb-3 align-items-center">
                                                <span>Stok Awal</span>
                                                <input type="number" data-toggle="tooltip" title=" Masukkan Stok Awal"
                                                    oninput="autoInputs(this.value)" class="form-control" id="awal"
                                                    name="awal" placeholder="0" required>
                                                <div class="valid-feedback" id="R_awal">
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div class="col-md-3">
                                            <div class="row mb-3 align-items-center">
                                                <span>Stok Akhir</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Stok Akhir"
                                                    class="form-control" id="akhir" name="akhir" placeholder="0"
                                                    required>
                                                <div class="valid-feedback" id="R_akhir">
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div class="col-md-3">
                                            <div class="row mb-3 align-items-center">
                                                <span>Stok Minimal</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Stok Minimal"
                                                    class="form-control" id="minimal" name="minimal" placeholder="0"
                                                    required>
                                                <div class="valid-feedback" id="R_minimal">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row px-4 align-items-center">
                                        <div class="col-md-5">
                                            <div class="row mb-3 align-items-center">
                                                <span>Harga Beli</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Harga Beli"
                                                    class="form-control" id="beli" name="beli"
                                                    placeholder="Harga Beli" required>
                                                <div class="valid-feedback" id="R_beli">
                                                </div>
                                            </div>
                                        </div>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <div class="col-md-5">
                                            <div class="row mb-3 align-items-center">
                                                <span>Harga Jual</span>
                                                <input type="number" data-toggle="tooltip" title="Masukkan Harga Jual"
                                                    class="form-control" id="jual" name="jual"
                                                    placeholder="Harga Jual" required>
                                                <div class="valid-feedback" id="R_jual">
                                                </div>
                                            </div>
                                            <input type="hidden" name="status" value="A">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center px-4">
                                        <span>Kategori</span>
                                        <div class="col-md-9">
                                            <select class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" id="kategori" name="kategori">
                                                <option selected="true" disabled>Pilih</option>
                                                @foreach ($kategoris as $kategori)
                                                    <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center px-4">
                                        <span>Deskripsi</span>
                                        <textarea id="deskiripsi" name="deskripsi" class="form-control"style="height: 100px"
                                            placeholder="Masukkan Deskripsi Produk"></textarea>
                                    </div>
                                    {{-- upload foto --}}
                                    <div class="row mb-3 align-items-center px-4">
                                        <span>Foto</span>
                                        <div class="col-md-9">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" accept="image/*" name="file2" id="file2"
                                                        onchange="loadFile(event, 'output2')" style="display: none;">
                                                <label class="custom-file-label" for="file2" style="cursor: pointer;">Pilih file</label>
                                                <div class="invalid-feedback">Example invalid custom file feedback</div>
                                            </div>
                                        </div>
                                        <img id="output2" width="200" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal-hapus --}}
    <div class="modal fade" id="modal-hapus">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Data</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm-hapus" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <input type="hidden" id="id-del">
                        <p>Apakah Anda yakin ingin menghapus produk..?</p>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsku')
    <script type="text/javascript">
        dataProduk();

        function dataProduk() {
            var produkk = $('#tabel-produk').DataTable();
            if (produkk !== undefined) {
                produkk.destroy();
            }

            produkk = $('#tabel-produk').DataTable({
                "processing": true,
                "responsive": true,
                "autoWidth": false,
                "stateSave": true,
                "serverSide": true,
                "ajax": {
                    "url": 'item-produk',
                    "dataSrc": ''
                },
                "language": {
                    "lengthMenu": "Menampilkan _MENU_ data per Halaman",
                    "zeroRecords": "Tidak ada Data yang ditemukan",
                    "info": "Menampilkan halaman ke _PAGE_ dari _PAGES_",
                    "infoEmpty": "Tidak ada yg dicari",
                    "infoFiltered": "difilter dari _MAX_ total data",
                    "search": "Pencarian",
                    "loadingRecords": "Memproses",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya",
                    }
                },
                "buttons": {
                    "copyTitle": "Data Berhasil disalin",
                    "copyKeys": "Gunakan keyboard atau menu untuk menyalin",
                    "copySuccess": {
                        1: "Menyalin 1 baris ke papan klip",
                        _: "Menyalin %d baris ke papan klip"
                    }
                },
                "columnDefs": [{
                    targets: [3],
                    createdCell: function(td) {
                        $(td).css('text-align', 'right');
                        $(td).css('font-weight', 'bold');
                    }
                }, ],
                "columns": [{
                        "data": null,
                        "render" : function(data, type, row, meta){
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "kode_produk"
                    },
                    {
                        "data": "nama_produk"
                    },
                    {
                        "data": "harga"
                    },
                    {
                        "data": "foto",
                        "render": function(data, type, row) {
                            return '<img src="' + "{{ asset('storage') }}/" + data +
                                '" alt="Product Image" width="180">';
                        }
                    },
                    {
                        "data": "status",
                        "sortable" : true,
                        "render" : function(data, type, row, meta) {
                            if(data === 'Habis'){
                                return '<button class="btn btn-sm btn-orange text-center">Habis</button>';
                            } else{
                                return '<button class="btn btn-sm btn-success text-center">Tersedia</button>';
                            }
                        }
                    },
                    {
                        "data": null,
                        "sortable": true,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-group-sm text-center">' +
                                '<a href="#" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-up" data-idd="' +
                                data.id +
                                '" data-nmm="' + data.nama_produk +
                                '" data-kdd="' + data.kode_produk +
                                '" data-des="' + data.deskripsi_produk +
                                '" data-kat="' + data.kategori_id +
                                '" data-staa="' + data.stok_awal +
                                '" data-stmm="' + data.stok_minimal +
                                '" data-stkk="' + data.stok_akhir +
                                '" data-hrgbb="' + data.harga_beli +
                                '" data-hrgjj="' + data.harga +
                                '" data-ft="' + data.foto +
                                '"><i title="Detail Produk" data-toggle="tooltip"' +
                                'class="fa fa-eye"></i></a> &nbsp' +

                                '<a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-ubah" data-id="' +
                                data.id +
                                '" data-kd="' + data.kode_produk +
                                '" data-nm="' + data.nama_produk +
                                '" data-sta="' + data.stok_awal +
                                '" data-stm="' + data.stok_minimal +
                                '" data-stk="' + data.stok_akhir +
                                '" data-hrgb="' + data.harga_beli +
                                '" data-hrgj="' + data.harga +
                                '" data-fto="' + data.foto +
                                '" data-ktr="' + data.kategori_id +
                                '" data-ds="' + data.deskripsi_produk +
                                '"><i title="Rubah data" data-toggle="tooltip"' +
                                'class="fa fa-edit"></i></a> &nbsp' +

                                '<a href="#" class="btn btn-sm btn-danger" data-id="' + data.id +
                                '" data-target="#modal-hapus" data-toggle="modal"><i title="Hapus data" data-toggle="tooltip"' +
                                'class="fa fa-trash"></i></a>' +
                                '</div>';
                        }
                    }
                ],
                initComplete: function() {

                },
            });
            produkk.draw();
        }

        function notifSukses(message, title) {
            toastr.success(message, title);
        }

        function notifGagal(message, title) {
            toastr.warning(message, title);
        }

        $('#modal-ubah').on('show.bs.modal', function(event) {
            var tombol = $(event.relatedTarget)
            var id = tombol.data('id')
            var kd = tombol.data('kd')
            var nm = tombol.data('nm')
            var stoka = tombol.data('sta')
            var stokm = tombol.data('stm')
            var stokk = tombol.data('stk')
            var hrgbl = tombol.data('hrgb')
            var hrgjl = tombol.data('hrgj')
            var des = tombol.data('ds')
            var kate = tombol.data('ktr')
            var fft = tombol.data('fto')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #kode').val(kd)
            modal.find('.modal-body #nama').val(nm)
            modal.find('.modal-body #awal').val(stoka)
            modal.find('.modal-body #minimal').val(stokm)
            modal.find('.modal-body #akhir').val(stokk)
            modal.find('.modal-body #beli').val(hrgbl)
            modal.find('.modal-body #jual').val(hrgjl)
            modal.find('.modal-body #deskiripsi').val(des)
            modal.find('.modal-body #kategori').val(kate)
            modal.find('.modal-body #output2').attr("src", "storage/"+fft)

        });

        $('#modal-up').on('show.bs.modal', function(e) {
            var tm = $(e.relatedTarget)
            var nm1 = tm.data('nmm')
            var kd1 = tm.data('kdd')
            var kate = tm.data('kat')
            var dess = tm.data('des')
            var hr1 = tm.data('hrgbb')
            var hr2 = tm.data('hrgjj')
            var st1 = tm.data('staa')
            var st2 = tm.data('stmm')
            var st3 = tm.data('stkk')
            var fto = tm.data('ft')

            var md = $(this)
            md.find('.modal-body #nmp').text(nm1)
            md.find('.modal-body #kdp').text(kd1)
            md.find('.modal-body #ktp').text(kate)
            md.find('.modal-body #swp').text(st1)
            md.find('.modal-body #skp').text(st3)
            md.find('.modal-body #smp').text(st2)
            md.find('.modal-body #hbp').text(hr1)
            md.find('.modal-body #hjp').text(hr2)
            md.find('.modal-body #dsp').text(dess)
            md.find('.modal-body #ima').attr("src", "storage/"+fto)
        });

        $('#modal-hapus').on('show.bs.modal', function(event) {
            var tombol = $(event.relatedTarget)
            var id = tombol.data('id')

            var modal = $(this)
            modal.find('.modal-body #id-del').val(id)

        });

        $('#frm-hapus').submit(function(e) {
            e.preventDefault();
            var idproduk = $('#id-del').val();

            $.ajax({
                type: 'DELETE',
                url: "{{ url('/hapus-produk') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idproduk,
                },
                success: function(data) {
                    if (data.status == 1) {
                        dataProduk();
                        $('#modal-hapus').modal('hide');
                        notifSukses(data.message, data.title);
                    } else {
                        notifGagal(data.message, data.title);
                    }
                },
            });
        });

        function batal() {
            $('#batal1').click(function() {
                $('#modal-tambah').modal('hide');
            });
        }
    </script>
    <script>
        var loadFile = function(event, outputId) {
            var image = document.getElementById(outputId);
            image.src = URL.createObjectURL(event.target.files[0]);
        };

        // $(document).ready(function() {
        //     $('#beli').mask('000.000.000', {
        //         reverse: true
        //     });
        //     $('#jual').mask('000.000.000', {
        //         reverse: true
        //     });
        // })

        function autoInputs(value) {
            document.getElementById('akhir').value = value;

            var vall = parseFloat(value) / parseFloat(value) + 5;
            document.getElementById('minimal').value = vall;
        }
    </script>
@endsection
