<?php $__env->startSection('utama'); ?>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Kasir</h4>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Kasir</li>
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
                                <h5 class="card-title">Data Akun Kasir</h5>
                            </div>
                            <div class="col-md-3 px-3" align="right">
                                <div class="btn-group-sm">
                                    <a href="#" class="btn btn-default" data-toggle="modal"
                                        data-target="#modal-tkasir"><i title="Tambah data" data-toggle="tooltip"
                                            class="fa fa-plus-circle"></i> Tambah Kasir</a>
                                </div>
                                <br>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel-kass" class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Kasir</th>
                                        <th>Nama Kasir</th>
                                        <th>Email</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Kode Kasir</th>
                                        <th>Nama Kasir</th>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('jsku'); ?>
    <script type="text/javascript">
        dataKasir();

        function dataKasir() {
            var kass = $('#tabel-kass').DataTable();
            if (kass !== undefined) {
                kass.destroy();
            }

            hiss = $('#tabel-kass').DataTable({
                "processing": true,
                "responsive": true,
                "autoWidth": false,
                "stateSave": true,
                "serverSide": true,
                "ajax": {
                    "url": 'data-kasir',
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
                        "data": "code"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "email"
                    },
                    {
                        "data": null,
                        "sortable": true,
                        render: function(data, type, row, meta) {
                            return '<div class="btn-group-sm text-center">' +

                                '<a href="#" class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal-ukasir" data-id="' +
                                data.id +
                                '" data-kd="' + data.code +
                                '" data-nm="' + data.name +
                                '" data-eml="' + data.email +
                                '" data-pwd="' + data.password +
                                '"><i title="Rubah data" data-toggle="tooltip"' +
                                'class="fa fa-edit"></i></a> &nbsp' +

                                '<a href="#" class="btn btn-sm btn-danger" data-id="' + data.id +
                                '" data-target="#modal-hkasir" data-toggle="modal"><i title="Hapus data" data-toggle="tooltip"' +
                                'class="fa fa-trash"></i></a>' +
                                '</div>';
                        }
                    }
                ],
                initComplete: function() {

                },
            });
            kass.draw();
        }

        function notifSukses(message, title) {
            toastr.success(message, title);
        }

        function notifGagal(message, title) {
            toastr.warning(message, title);
        }

        $('#modal-ukasir').on('show.bs.modal', function(event) {
            var tombol = $(event.relatedTarget)
            var id = tombol.data('id')
            var kd = tombol.data('kd')
            var nm = tombol.data('nm')
            var email = tombol.data('eml')

            var modal = $(this)
            modal.find('.modal-body #id').val(id)
            modal.find('.modal-body #kd_kasir').val(kd)
            modal.find('.modal-body #nm_kasir').val(nm)
            modal.find('.modal-body #eml_kasir').val(email)
            modal.find('.modal-body #pwd_kasir').val(kd)
        });


        $('#modal-hkasir').on('show.bs.modal', function(event) {
            var tombol = $(event.relatedTarget)
            var id = tombol.data('id')

            var modal = $(this)
            modal.find('.modal-body #id-kasir').val(id)

        });

        $('#frm-hapus-kasir').submit(function(e) {
            e.preventDefault();
            var idkasir = $('#id-kasir').val();

            $.ajax({
                type: 'DELETE',
                url: "<?php echo e(url('/hapus-kasir')); ?>",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: idkasir,
                },
                success: function(data) {
                    if (data.status == 1) {
                        dataKasir();
                        $('#modal-hkasir').modal('hide');
                        notifSukses(data.message, data.title);
                    } else {
                        notifGagal(data.message, data.title);
                    }
                },
            });
        });

        function batal() {
            $('#batal1').click(function() {
                $('#modal-tkasir').modal('hide');
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('modalku'); ?>
    <div class="modal fade" id="modal-tkasir">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Tambah Akun Kasir</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <form action="<?php echo e(url('/simpan-kasir')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="card">

                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Kode Kasir</span>
                                    </div>
                                    <div class="col-lg-4 col-md-8">
                                        <input type="text" data-toggle="tooltip" title="Kode Kasir" class="form-control"
                                            id="kode_kasir" name="kode_kasir"
                                            value="<?php echo e(app('App\Http\Controllers\DashboardController')->kodekasir()); ?>" required>
                                        <div class="valid-feedback" id="R_kode_kasir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Nama Kasir</span>
                                    </div>
                                    <div class="col-lg-7 col-md-12">
                                        <input type="text" data-toggle="tooltip" title="Nama Kasir"
                                            class="form-control" id="nama_kasir" name="nama_kasir"
                                            placeholder="Masukkan Nama" required>
                                        <div class="valid-feedback" id="R_nama_kasir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Email</span>
                                    </div>
                                    <div class="col-lg-7 col-md-12">
                                        <input type="text" data-toggle="tooltip" title="Email Kasir"
                                            class="form-control" id="email_kasir" name="email_kasir"
                                            placeholder="Masukkan email" required>
                                        <div class="valid-feedback" id="R_email_kasir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Password</span>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <input type="text" data-toggle="tooltip" title="Password Kasir"
                                            class="form-control" id="pass_kasir" name="pass_kasir"
                                            value="<?php echo e(app('App\Http\Controllers\DashboardController')->kodekasir()); ?>" required>
                                        <div class="valid-feedback" id="R_pass_kasir">
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

    <div class="modal fade" id="modal-ukasir">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Form Ubah Akun Kasir</h4>
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Tutup</button>
                </div>
                <form action="<?php echo e(url('/ubah-kasir')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="card">

                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Kode Kasir</span>
                                    </div>
                                    <div class="col-lg-4 col-md-8">
                                        <input type="hidden" id="id" name="id">
                                        <input type="text" data-toggle="tooltip" title="Kode Kasir" class="form-control"
                                            id="kd_kasir" name="kd_kasir" disabled>
                                        <div class="valid-feedback" id="R_kd_kasir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Nama Kasir</span>
                                    </div>
                                    <div class="col-lg-7 col-md-12">
                                        <input type="text" data-toggle="tooltip" title="Nama Kasir"
                                            class="form-control" id="nm_kasir" name="nm_kasir"
                                            placeholder="Masukkan Nama" required>
                                        <div class="valid-feedback" id="R_nm_kasir">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3 mx-3 align-items-center">
                                    <div class="col-lg-5 col-md-12">
                                        <span>Email</span>
                                    </div>
                                    <div class="col-lg-7 col-md-12">
                                        <input type="text" data-toggle="tooltip" title="Email Kasie"
                                            class="form-control" id="eml_kasir" name="eml_kasir"
                                            placeholder="Masukkan email" required>
                                        <div class="valid-feedback" id="R_eml_kasir">
                                        </div>
                                    </div>
                                </div>
                                
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-hkasir">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Hapus Akun Kasir</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="frm-hapus-kasir" method="post">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <div class="modal-body">
                        <input type="hidden" id="id-kasir">
                        <p>Apakah Anda yakin ingin mengahapus data..?</p>
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

<?php echo $__env->make('layouts.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/dashboard/kasir.blade.php ENDPATH**/ ?>