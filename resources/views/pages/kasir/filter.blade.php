@extends('layouts.kastemp')
@section('kasir')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Riwayat</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Riwayat</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
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
                                <h5 class="card-title">Riwayat Pembayaran</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-sm table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nota</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Kasir</th>
                                        <th>Kode Pemesanan</th>
                                        <th>Struk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filter as $data)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->nota }}</td>
                                            <td>{{ $data->tanggal }}</td>
                                            <td>{{ $data->kasir->name }}</td>
                                            <td>{{ $data->mejaa->meja }}</td>
                                            <td>
                                                <div class="btn-group-sm text-center">
                                                    <a href="#" class="btn btn-sm btn-danger"
                                                        data-id=" {{ $data->id }} " data-target="#mdl-nota"
                                                        data-toggle="modal">
                                                        <i title="Cetak Nota" data-toggle="tooltip"
                                                            class="fa fa-dollar-sign"></i> Struk</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nota</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Kasir</th>
                                        <th>Kode Pemesanan</th>
                                        <th>Struk</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
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
                                <h5 class="card-title">Filter Data</h5>
                            </div>
                        </div>
                        <form id="filterForm" action="{{ url('/kasir-filter') }}" method="GET"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Tanggal Awal</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <input type="date" data-toggle="tooltip" title="Tanggal Awal" class="form-control"
                                        id="tglawal" name="tglawal" required>
                                    <div class="valid-feedback" id="R_tglawal">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Tanggal Akhir</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <input type="date" data-toggle="tooltip" title="Tanggal Akhir" class="form-control"
                                        id="tglakhir" name="tglakhir" required>
                                    <div class="valid-feedback" id="R_tglakhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-right">
                                <a href="{{ url('/kasir-history') }}" class="btn btn-warning" >Batal</a> &nbsp; &nbsp;
                                <button type="submit" class="btn btn-success">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('jsku')
    <script>
        $('#zero_config').DataTable();
    </script>
    <script>
        $('#mdl-nota').on('show.bs.modal', function(event) {
            var tombol = $(event.relatedTarget)
            var id = tombol.data('id')

            var modal = $(this)
            modal.find('.modal-body #nota_id').val(id)

        });
    </script>
@endsection

@section('modalku')
    <div class="modal fade" id="mdl-nota">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Informasi</h4>
                </div>
                <form id="frm-cetak" method="get" action="{{ url('/cetak-nota') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="nota_id" id="nota_id">
                        <p>Anda ingin mencetak struk transaksi ini??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-cyan" target="_blank" onclick="window.open('{{ url('/cetak-nota') }}', '_blank'); return false;">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
