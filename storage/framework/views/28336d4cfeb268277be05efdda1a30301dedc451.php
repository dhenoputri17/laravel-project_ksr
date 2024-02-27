<?php $__env->startSection('utama'); ?>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Barang</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Barang</li>
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
                        <h5 class="card-title">Kategori</h5>
                        <div class="table-responsive">
                            <table id="data-kategori" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
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
            <div class="col-md-6">
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
                        
                        <h5 class="card-title">Tambah Kategori</h5>
                        <form action="<?php echo e(url('/simpan-kategori')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-lg-3 col-md-12 text-right">
                                    <span>Nama Kategori</span>
                                </div>
                                <div class="col-lg-9 col-md-12 px-2">
                                    <input type="text" data-toggle="tooltip" title="Masukkan Nama Kategori"
                                        class="form-control" id="namak" name="namak"
                                        placeholder="Masukkan Nama Kategori" required>
                                    <div class="valid-feedback" id="R_nama">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row px-4">
                                <div class="col-md-6"></div>
                                <div class="col-md-6" align="right">
                                    <button type="reset" class="btn btn-warning px-2">Batal</button> &nbsp; &nbsp;
                                    <button type="submit" class="btn btn-default px-2">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modalku'); ?>
    <div class="modal fade" id="hps-kategori">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Kategori</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm-hapus-data" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-body">
                        <input type="hidden" id="id-kategori">
                        <p>Apakah Anda yakin ingin mengahapus data..?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                </form>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsku'); ?>
    <script type="text/javascript">
        dataKategori();

        function dataKategori() {
            var kate = $('#data-kategori').DataTable();
            if (kate !== undefined) {
                kate.destroy();
            }
            produkk = $('#data-kategori').DataTable({
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
                    "url": 'list-kategori',
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
                        "data": "nama_kategori"
                    },
                    {
                        "data": null,
                        "sortable": true,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-group-sm text-center">' +
                                '<a href="#" class="btn btn-sm btn-danger" data-id="' + data
                                .id +
                                '" data-target="#hps-kategori" data-toggle="modal"><i title="Hapus data" data-toggle="tooltip"' +
                                'class="fa fa-trash"></i></a>' +
                                '</div>';
                        }
                    }
                ],
                initComplete: function() {

                },
            });
            kate.draw();
        }

        function notifSukses(message, title) {
            toastr.success(message, title);
        }

        function notifGagal(message, title) {
            toastr.warning(message, title);
        }

        $('#hps-kategori').on('show.bs.modal', function(event) {
            var tbl = $(event.relatedTarget)
            var id = tbl.data('id')

            var modal = $(this)
            modal.find('.modal-body #id-kategori').val(id)
        });

        $('#frm-hapus-data').submit(function(e) {
            e.preventDefault();
            var idK = $('#id-kategori').val();

            $.ajax({
                type: 'DELETE',
                url: "<?php echo e(url('/hapus-kategori')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idK
                },
                success: function(data) {
                    if (data.status == 1) {
                        dataKategori();
                        $('#hps-kategori').modal('hide');
                        notifSukses(data.message, data.title);
                    } else {
                        notifGagal(data.message, data.title);
                    }
                },
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/kategori/index.blade.php ENDPATH**/ ?>