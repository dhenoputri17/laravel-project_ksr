<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>
<style>
    @import url('<?php echo e(public_path('css/bootstrap.min.css')); ?>');

    thead {
        border-bottom: 1px solid;
        border-top: 2px solid;
    }

    tbody {
        border-bottom: 1px solid;
    }

    tfoot {
        border-bottom: 1px solid;
    }

    h2 {
        text-align: center;
    }
</style>

<body>
    <h2>Laporan Stok</h2>

    <p>Tanggal : <?php echo e(now()); ?></p>
    <div class="table-responsive">
        <table id="tabel-stok" class="table table-sm table-striped table-bordered table-hover">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok Minimal</th>
                    <th>Stok Awal</th>
                    <th>Stok Akhir</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $prdk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $barang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="text-center"><?php echo e($barang->id); ?></td>
                        <td class="text-center"><?php echo e($barang->kode_produk); ?></td>&nbsp; &nbsp;
                        <td class="text-left"><?php echo e($barang->nama_produk); ?></td>
                        <td class="text-center"><?php echo e($barang->kategori->nama_kategori); ?></td>
                        <td class="text-center"><?php echo e($barang->stok_minimal); ?></td>
                        <td class="text-center"><?php echo e($barang->stok_awal); ?></td>
                        <td class="text-center"><b><?php echo e($barang->stok_akhir); ?></b></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
            <tfoot  class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok Minimal</th>
                    <th>Stok Awal</th>
                    <th>Stok Akhir</th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/report/stok.blade.php ENDPATH**/ ?>