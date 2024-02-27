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

thead{
    border-bottom: 1px solid;
    border-top: 2px solid;
}
tbody{
    border-bottom: 1px solid;
}
tfoot{
    border-bottom: 1px solid;
}
h2{
    text-align: center;
}
</style>
<body>
    <h2>Kuitansi Pembayaran</h2>

    <p>Nomor Transaksi  : <?php echo e($nt->nota); ?></p>
    <p>Tanggal          : <?php echo e($nt->tanggal); ?></p>
    <p>Kasir            : <?php echo e($nt->kasir->name); ?></p>

    <table class="table">
        <thead>
          <tr>
            <th scope="col" class="text-center">N0. </th>
            <th scope="col">KODE</th>
            <th scope="col">KETERANGAN</th>
            <th scope="col" class="text-center">QTY</th>
            <th scope="col" class="text-center">HARGA</th>
            <th scope="col" class="text-center">SUBTOTAL</th>
          </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $nt->cartdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td class="text-center"><?php echo e($loop->iteration); ?></td>
              <td><?php echo e($dt->produk->kode_produk); ?></td>
              <td><?php echo e($dt->produk->nama_produk); ?></td>
              <td class="text-center"><?php echo e($dt->qty); ?></td>
              <td class="text-center"><?php echo e($dt->produk->harga); ?></td>
              <td class="text-center"><?php echo e($dt->subtotal); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
        <tfoot>
            <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center"></th>
                <th class="text-center">Total : </th>
                <th class="text-center"><?php echo e($nt->cart->total); ?></th>
              </tr>
              <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center"></th>
                <th class="text-center">Dibayar : </th>
                <th class="text-center"><?php echo e($nt->tunai); ?></th>
              </tr>
              <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center"></th>
                <th class="text-center">Kembali : </th>
                <th class="text-center"><?php echo e($nt->kembali); ?></th>
              </tr>
        </tfoot>
      </table>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/report/nota.blade.php ENDPATH**/ ?>