@extends('layouts.template')
@section('utama')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Data Transaksi</h4>
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
                                <h5 class="card-title">Data Transaksi</h5>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel-his" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nota</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Kasir</th>
                                        <th>Kode Meja</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $dt)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            {{-- <td>{{ $dt->id }}</td> --}}
                                            <td>{{ $dt->nota }}</td>
                                            <td>{{ $dt->tanggal }}</td>
                                            <td>{{ $dt->kasir->name }}</td>
                                            <td>{{ $dt->mejaa->meja }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nota</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Kasir</th>
                                        <th>Kode Meja</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">

                {{-- <div class="card">
                    <div class="card-body">

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

                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">Cetak Data</h5>
                            </div>
                        </div>
                        <div class="row">
                            <button type="submit" class="btn btn-default" data-toggle="modal"
                                data-target="#modal-cetak">Filter Data</button> &nbsp; &nbsp;
                            <button type="submit" class="btn btn-cyan">Cetak Semua Data</button>
                        </div>
                    </div>
                </div> --}}

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
                        <form id="filterForm" action="{{ url('/transaksi-filter') }}" method="GET"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Nama Kasir</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                        id="namakas" name="namakas">
                                        <option selected="true" disabled>Pilih</option>
                                        @foreach ($kasir as $ksr)
                                            <option value="{{ $ksr->name }}">{{ $ksr->id }} - {{ $ksr->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback" id="R_namakas">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Tanggal Awal</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <input type="date" data-toggle="tooltip" title="Tanggal Awal" class="form-control"
                                        id="tglawal" name="tglawal">
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
                                        id="tglakhir" name="tglakhir">
                                    <div class="valid-feedback" id="R_tglakhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-right">
                                <a href="{{ url('/transaksi-filter') }}" class="btn btn-orange">Reset Filter</a> &nbsp;
                                &nbsp; &nbsp;
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
        $('#tabel-his').DataTable();
    </script>
@endsection

@section('modalku')
    <div class="modal fade" id="modal-cetak">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Akun Kasir</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <form action="{{ url('/simpan-kasir') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="card">
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Nama Kasir</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                        id="namakas" name="namakas">
                                        <option selected="true" disabled>Pilih</option>
                                        @foreach ($kasir as $ksr)
                                            <option value="{{ $ksr->name }}">{{ $ksr->id }} -
                                                {{ $ksr->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback" id="R_namakas">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Bulan</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                        id="namakas" name="namakas">
                                        <option selected="true" disabled>Pilih</option>
                                        @php
                                            $bulanList = [
                                                1 => 'Januari',
                                                2 => 'Februari',
                                                3 => 'Maret',
                                                4 => 'April',
                                                5 => 'Mei',
                                                6 => 'Juni',
                                                7 => 'Juli',
                                                8 => 'Agustus',
                                                9 => 'September',
                                                10 => 'Oktober',
                                                11 => 'November',
                                                12 => 'Desember',
                                            ];
                                            $currentMonth = date('n'); // n mengembalikan nomor bulan (1-12)
                                        @endphp

                                        @foreach ($bulanList as $bulan => $namaBulan)
                                            <option value="{{ $bulan }}">{{ $namaBulan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="valid-feedback" id="R_tglakhir">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-5 col-md-12">
                                    <span>Tahun</span>
                                </div>
                                <div class="col-lg-7 col-md-12">
                                    <select class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" id="namakas" name="namakas">
                                                @php
                                                    $startYear = 2022;
                                                    $endYear = $startYear + 5; // Anda dapat mengganti 5 dengan jumlah tahun yang diinginkan
                                                    $currentYear = date('Y');
                                                @endphp

                                                @for ($year = $startYear; $year <= $endYear; $year++)
                                                    <option value="{{ $year }}"
                                                        {{ $year == $currentYear ? 'selected' : '' }}>{{ $year }}
                                                    </option>
                                                @endfor
                                            </select>
                                    <div class="valid-feedback" id="R_tglakhir">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Cetak Laporan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
