<?php $__env->startSection('utama'); ?>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Daftar Meja</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Daftar Meja</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="card-title">Daftar Meja</h5>
                            </div>
                            <div class="col-md-3 px-3" align="right">
                                <form action="<?php echo e(url('/meja-tambah')); ?>" enctype="multipart/form-data" method="post">
                                    <?php echo csrf_field(); ?>
                                    <div class="col-lg-9 col-md-12 px-2">
                                        <input type="hidden" class="form-control" id="nomeja" name="nomeja"
                                            value="<?php echo e(app('App\Http\Controllers\MejaController')->nomormeja()); ?>" required>
                                        <div class="valid-feedback" id="R_nomeja">
                                        </div>
                                    </div>
                                    <div class="btn-group-sm">
                                        <button type="submit" class="btn btn-default"><i title="Tambah data"
                                                data-toggle="tooltip" class="fa fa-plus"></i> Tambah Baru</button>
                                    </div>
                                </form>
                                <br>
                            </div>

                        </div>
                        
                        <?php if(session('tambah')): ?>
                        <div class="alert alert-success alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>x</span>
                                </button>
                                <?php echo e(session('tambah')); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(session('gagal')): ?>
                        <div class="alert alert-danger alert-dismissible show fade">
                            <div class="alert-body">
                                <button class="close" data-dismiss="alert">
                                    <span>x</span>
                                </button>
                                <?php echo e(session('gagal')); ?>

                            </div>
                        </div>
                    <?php endif; ?>
                    
                        <div class="table-responsive">
                            <table id="daftar-meja" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No. </th>
                                        <th>Kode Meja</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsku'); ?>
    <script type="text/javascript">
        dataMeja();

        function dataMeja() {
            var meja = $('#daftar-meja').DataTable();
            if (meja !== undefined) {
                meja.destroy();
            }
            mejaa = $('#daftar-meja').DataTable({
                "processing": true,
                "responsive": true,
                "autoWidth": false,
                "stateSave": true,
                "serverSide": true,
                "lengthMenu": false,
                "searching": false,
                "paging": false,
                "info": false,
                "ajax": {
                    "url": 'list-meja',
                    "dataSrc": ''
                },
                "language": {
                    "zeroRecords": "Tidak ada Data yang ditemukan",
                    "infoEmpty": "Tidak ada yg dicari",
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
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "meja"
                    },
                    {
                        "data": null,
                        "sortable": true,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-group-sm text-center">' +
                                '<a href="#" class="btn btn-sm btn-danger" data-id="' + data
                                .id +
                                '" data-target="#hps-meja" data-toggle="modal"><i title="Hapus data" data-toggle="tooltip"' +
                                'class="fa fa-trash"></i></a>' +
                                '</div>';
                        }
                    }
                ],
                initComplete: function() {

                },
            });
            meja.draw();
        }

        function notifSukses(message, title) {
            toastr.success(message, title);
        }

        function notifGagal(message, title) {
            toastr.warning(message, title);
        }

        $('#hps-meja').on('show.bs.modal', function(event) {
            var tbl = $(event.relatedTarget)
            var id = tbl.data('id')

            var modal = $(this)
            modal.find('.modal-body #id-meja').val(id)
        });

        $('#frm-hps-data').submit(function(e) {
            e.preventDefault();
            var idK = $('#id-meja').val();

            $.ajax({
                type: 'DELETE',
                url: "<?php echo e(url('/hapus-meja')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idK
                },
                success: function(data) {
                    if (data.status == 1) {
                        dataMeja();
                        $('#hps-meja').modal('hide');
                        notifSukses(data.message, data.title);
                    } else {
                        notifGagal(data.message, data.title);
                    }
                },
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modalku'); ?>
    <div class="modal fade" id="hps-meja">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Meja</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm-hps-data" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-body">
                        <input type="hidden" id="id-meja">
                        <p>Apakah Anda yakin ingin mengahapus Meja..?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/meja/index.blade.php ENDPATH**/ ?>