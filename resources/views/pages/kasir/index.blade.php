@extends('layouts.kastemp')
@section('kasir')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Pembayaran</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Pembayaran</li>
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
                            <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
                            <script>
                                $(document).ready(function() {
                                    $('#nota_id').val('{{ Session::get('transaksiId') }}');
                                    $('#mdl-sukses').modal('show');
                                })
                            </script>
                        @endif

                        <div class="modal fade" id="mdl-sukses">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Informasi</h4>
                                    </div>
                                    <form id="frm-cetak" method="get" action="{{ url('/cetak-nota') }}">
                                        @csrf
                                        <div class="modal-body">
                                            <input type="hidden" name="nota_id" id="nota_id">
                                            <p>Pembayaran berhasil, data telah disimpan.</p>
                                            <p>Anda ingin mencetak struk transaksi ini??</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default"
                                                data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-cyan">Cetak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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
                                <h5 class="card-title">Data Pembayaran</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel-bayar" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nomor Meja</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                        <th style="width: 25%">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nomor Meja</th>
                                        <th>Status</th>
                                        <th>Total</th>
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
    <div class="modal fade" id="modal-bayar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Pembayaran</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <form action="{{ url('/selesai-bayar') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Nota</span>
                                        </div>
                                        <div class="col-lg-4 col-md-8">
                                            <input type="text" data-toggle="tooltip" title="Nota Pembayaran"
                                                class="form-control" id="nota" name="nota"
                                                value="{{ app('App\Http\Controllers\KasirController')->notrans() }}"
                                                required>
                                            <div class="valid-feedback" id="R_nota">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Kasir</span>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <input type="text" data-toggle="tooltip" title="Nama Kasir"
                                                class="form-control" id="kasir" name="kasir" placeholder="Nama Kasir"
                                                required>
                                            <input type="hidden" name="idkaa" id="idkaa">
                                            <div class="valid-feedback" id="R_kasir">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Tanggal</span>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <input type="date" data-toggle="tooltip" title="Masukkan Tanggal Pembayaran"
                                                class="form-control" id="tanggal" name="tanggal"
                                                required>
                                            <div class="valid-feedback" id="R_tanggal">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row mx-3">
                                <div class="col-lg-4 col-md-12 text-left">
                                    <span style="font-weight: bold; font-size: 16px;">Detail Pesanan</span>
                                </div>
                                <input type="hidden" name="idp" id="idp">
                                <table class="table text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID Pemesanan</th>
                                            <th scope="col">Nomor Meja</th>
                                            <th scope="col">Total Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="idp"></td>
                                            <td id="kdm"></td>
                                            <td id="tot"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row mx-3">
                                <div class="col-md-6"></div>
                                <div class="col-md-6 text-right">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Tunai</span>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <input type="hidden" name="tot" id="tot">
                                            <input type="number" data-toggle="tooltip" title="Tunai Pembayaran"
                                                class="form-control" id="tunai" name="tunai"
                                                oninput="hitungkembali()" required>
                                            <div class="valid-feedback" id="R_tunai">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-4 col-md-12 text-right">
                                            <span>Kembali</span>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <input type="number" data-toggle="tooltip" title="Kembalian"
                                                class="form-control" id="kembali" name="kembali" required>
                                            <div class="valid-feedback" id="R_kembali">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default">Batal</button>
                        <button type="submit" class="btn btn-success">Selesaikan Pembayaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('jsku')
    <script type="text/javascript">
        dataBayar();

        function dataBayar() {
            var bayar = $('#tabel-bayar').DataTable();
            if (bayar !== undefined) {
                bayar.destroy();
            }

            bayar = $('#tabel-bayar').DataTable({
                "processing": true,
                "responsive": true,
                "autoWidth": false,
                "stateSave": true,
                "serverSide": true,
                "searching": false,
                "paging": false,
                "info": false,
                "lengthMenu": false,
                "ajax": {
                    "url": 'item-bayar',
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
                        "render": function(data, type, row, meta){
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "meja.meja",
                        "name": "meja.meja"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "total"
                    },
                    {
                        "data": null,
                        "sortable": true,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-group-sm text-center">' +

                                '<a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-bayar" data-id="' +
                                data.id +
                                '" data-kode="' + data.meja_id +
                                '" data-meja="' + data.meja.meja +
                                '" data-total="' + data.total +
                                '">' +
                                '<i class="fa-solid fa-money-bill"></i> Selesaikan Pembayaran</a> &nbsp';
                        }
                    }
                ],
                initComplete: function() {

                },
            });
            bayar.draw();
        }

        $('#modal-bayar').on('show.bs.modal', function(ev) {
            var tm = $(ev.relatedTarget)
            var idpesan = tm.data('id')
            var kodepes = tm.data('meja')
            var totalpe = tm.data('total')

            var md = $(this)
            md.find('.modal-body #idp').text(idpesan)
            md.find('.modal-body #kdm').text(kodepes)
            md.find('.modal-body #tot').text(totalpe)
            md.find('.modal-body #tot').val(totalpe)
            md.find('.modal-body #idp').val(idpesan)
        });

        function hitungkembali() {
            var tunai = parseFloat(document.getElementById('tunai').value);
            var total = parseFloat(document.getElementById('tot').value);

            var kembali = tunai - total;

            document.getElementById('kembali').value = kembali;
        }
    </script>

    <script>
        var nama = "{{ $user->name }}";
        var idka = "{{ $user->id }}";

        $('#modal-bayar').on('show.bs.modal', function() {
            var mdl = $(this)
            mdl.find('.modal-body #kasir').val(nama)
            mdl.find('.modal-body #idkaa').val(idka)
        });
    </script>
@endsection
