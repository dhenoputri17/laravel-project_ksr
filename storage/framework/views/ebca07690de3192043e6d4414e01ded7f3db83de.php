<?php $__env->startSection('utama'); ?>
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
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">Filter Data</h5>
                            </div>
                        </div>
                        <form id="filterForm" action="<?php echo e(url('/transaksi-filter')); ?>" method="GET"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row me-4">
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-3 col-md-12 text-right">
                                            <span>Bulan</span>
                                        </div>
                                        <div class="col-lg-9 col-md-12">
                                            <select class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" id="namakas" name="namakas">
                                                <option selected="true" disabled>Pilih</option>
                                                <?php
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
                                                ?>

                                                <?php $__currentLoopData = $bulanList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bulan => $namaBulan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($bulan); ?>"
                                                        <?php echo e($bulan == $currentMonth ? 'selected' : ''); ?>><?php echo e($namaBulan); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="valid-feedback" id="R_namakas">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3 align-items-center">
                                        <div class="col-lg-3 col-md-12 text-right">
                                            <span>Tahun</span>
                                        </div>
                                        <div class="col-lg-9 col-md-12">
                                            <select class="select2 form-control custom-select"
                                                style="width: 100%; height:36px;" id="namakas" name="namakas">
                                                
                                                <?php
                                                    $startYear = 2022;
                                                    $endYear = $startYear + 5; // Anda dapat mengganti 5 dengan jumlah tahun yang diinginkan
                                                    $currentYear = date('Y');
                                                ?>

                                                <?php for($year = $startYear; $year <= $endYear; $year++): ?>
                                                    <option value="<?php echo e($year); ?>"
                                                        <?php echo e($year == $currentYear ? 'selected' : ''); ?>><?php echo e($year); ?>

                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                            <div class="valid-feedback" id="R_namakas">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-8">

                                </div>
                                <div class="col-md-4">
                                    <div class="row align-items-right text-right">
                                        <a href="<?php echo e(url('/transaksi-filter')); ?>" class="btn btn-orange">Reset Filter</a>
                                        &nbsp;
                                        &nbsp; &nbsp;
                                        <button type="submit" class="btn btn-success">Filter</button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        
                        <?php if(session('berhasil')): ?>
                            <div class="alert alert-success alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>x</span>
                                    </button>
                                    <?php echo e(session('berhasil')); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        <?php if(session('gagal')): ?>
                            <div class="alert alert-warning alert-dismissible show fade">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">
                                        <span>x</span>
                                    </button>
                                    <?php echo e(session('gagal')); ?>

                                </div>
                            </div>
                        <?php endif; ?>
                        
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
                                        <th>Kode</th>
                                        <th>Nama Produk</th>
                                        <th>Stok Awal</th>
                                        <th>Stok Minimal</th>
                                        <th>Stok Minimal</th>
                                    </tr>
                                </thead>
                                <tbody>

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

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsku'); ?>
    <script>
        $('#tabel-his').DataTable();
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modalku'); ?>
    <div class="modal fade" id="modal-cetak">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detail Produk</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Tanggal Awal</span>
                                    </div>
                                    <div class="col-lg-7 col-md-12">
                                        <input type="date" data-toggle="tooltip" title="Tanggal Awal"
                                            class="form-control" id="tglawal" name="tglawal">
                                        <div class="valid-feedback" id="R_tglawal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Tanggal Awal</span>
                                    </div>
                                    <div class="col-lg-7 col-md-12">
                                        <input type="date" data-toggle="tooltip" title="Tanggal Awal"
                                            class="form-control" id="tglawal" name="tglawal">
                                        <div class="valid-feedback" id="R_tglawal">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/laporan/stokbrg.blade.php ENDPATH**/ ?>