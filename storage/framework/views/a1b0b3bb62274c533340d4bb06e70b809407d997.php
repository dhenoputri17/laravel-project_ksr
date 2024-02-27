<?php $__env->startSection('kasir'); ?>
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
                                <h5 class="card-title">Riwayat Pembayaran</h5>
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
                                        <th>Kode Pemesanan</th>
                                        <th>Struk</th>
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
                                <h5 class="card-title">Filter Data</h5>
                            </div>
                        </div>
                        <form id="filterForm" action="<?php echo e(url('/kasir-filter')); ?>" method="GET" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
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
                                <button type="reset" class="btn btn-warning">Batal</button> &nbsp; &nbsp;
                                <button type="submit" class="btn btn-success">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="mdl-nota">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Informasi</h4>
                </div>
                <form id="frm-cetak" method="get" action="<?php echo e(url('/cetak-nota')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="nota_id" id="nota_id">
                        <p>Anda ingin mencetak struk transaksi ini??</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-cyan">Cetak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsku'); ?>
    <script type="text/javascript">
        dataRiwayat();

        function dataRiwayat() {
            var hiss = $('#tabel-his').DataTable();
            if (hiss !== undefined) {
                hiss.destroy();
            }

            hiss = $('#tabel-his').DataTable({
                "processing": true,
                "responsive": true,
                "autoWidth": false,
                "stateSave": true,
                "serverSide": true,
                "info": false,
                "ajax": {
                    "url": 'list-history',
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
                        "render" : function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "nota"
                    },
                    {
                        "data": "tanggal"
                    },
                    {
                        "data": "kasir.name"
                    },
                    {
                        "data": "cart.meja.meja",
                        "name": "cart.meja.meja",
                        "render": function(data, type, full, meta) {
                            return data ? data : '';
                        }
                    },
                    {
                        "data": null,
                        "sortable": true,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-group-sm text-center">' +
                                '<a href="#" class="btn btn-sm btn-danger" data-id="' + data.id +
                                '" data-target="#mdl-nota" data-toggle="modal"><i title="Cetak Nota" data-toggle="tooltip"' +
                                'class="fa fa-dollar-sign"></i> Struk</a>' +
                                '</div>';
                        }
                    }
                ],
                initComplete: function() {

                },
            });
            hiss.draw();
        }



        function notifSukses(message, title) {
            toastr.success(message, title);
        }

        function notifGagal(message, title) {
            toastr.warning(message, title);
        }

        $('#mdl-nota').on('show.bs.modal', function(event) {
            var tombol = $(event.relatedTarget)
            var id = tombol.data('id')

            var modal = $(this)
            modal.find('.modal-body #nota_id').val(id)

        });

        $('#frm-hapus').submit(function(e) {
            e.preventDefault();
            var idproduk = $('#id-del').val();

            $.ajax({
                type: 'DELETE',
                url: "<?php echo e(url('/hapus-produk')); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.kastemp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/kasir/history.blade.php ENDPATH**/ ?>