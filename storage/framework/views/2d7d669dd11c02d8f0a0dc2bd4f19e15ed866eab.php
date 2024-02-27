<?php $__env->startSection('customer'); ?>
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="<?php echo e(asset('storage/' . $produk->foto)); ?>"
                        alt="<?php echo e($produk->nama_produk); ?>" /></div>
                <div class="col-md-6">
                    <?php if($produk->stok_akhir == $produk->stok_minimal): ?>
                    <div class="small mb-1">Stok : Habis</div>
                    <?php else: ?>
                    <div class="small mb-1">Stok : <?php echo e($produk->stok_akhir); ?></div>
                    <?php endif; ?>
                    <h1 class="display-5 fw-bolder"><?php echo e($produk->nama_produk); ?></h1>
                    <div class="fs-5 mb-5">
                        <span>Rp. <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></span>
                    </div>
                    <p class="lead"><?php echo e($produk->deskripsi_produk); ?></p>
                    <div class="d-flex">
                        <button class="btn btn-link px-2"
                            onclick="decrementValue()">
                            <i class="fas fa-minus"></i>
                        </button>

                        <input id="quantity" min="0" name="quantity" value="1" type="number" oninput="isi(this.value)"
                            style="width: 40px" class="form-control form-control-sm" />

                        <button class="btn btn-link px-2 me-3"
                            onclick="incrementValue()">
                            <i class="fas fa-plus"></i>
                        </button>
                        <?php if($produk->stok_akhir == $produk->stok_minimal): ?>
                        <button class="btn btn-outline-dark flex-shrink-0 disabled" type="submit">
                            <i class="fa-solid fa-cart-shopping"></i>
                            Tambah
                        </button>
                        <?php else: ?>
                        <form action="<?php echo e(url('/tambah-keranjang')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="id_produk" id="id_produk" value="<?php echo e($produk->id); ?>">
                            <input type="hidden" name="qty" id="qty" value="1">
                            <button class="btn btn-outline-dark flex-shrink-0" type="submit">
                                <i class="fa-solid fa-cart-shopping"></i>
                                Tambah
                            </button>
                        </form>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    function incrementValue() {
        var qtyInput = document.getElementById('qty');
        var quantityInput = document.getElementById('quantity');
        quantityInput.stepUp();
        qtyInput.value = quantityInput.value;
    }

    function decrementValue() {
        var qtyInput = document.getElementById('qty');
        var quantityInput = document.getElementById('quantity');
        quantityInput.stepDown();
        qtyInput.value = quantityInput.value;
    }

    function isi(value) {
        var qtyInput = document.getElementById('qty');
        qtyInput.value = value;
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hometemp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/beranda/item.blade.php ENDPATH**/ ?>