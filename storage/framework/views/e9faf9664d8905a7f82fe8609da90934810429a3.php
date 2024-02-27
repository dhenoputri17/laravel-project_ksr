<?php $__env->startSection('customer'); ?>
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Aplikasi Penjualan</h1>
                <p class="lead fw-normal text-white-50 mb-0">Halaman depan</p>
                <br>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="<?php echo e(url('/produk/cari')); ?>" method="GET">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" name="p" id="p"
                                    placeholder="Cari disini" value="<?php echo e(request('p')); ?>"
                                    style="border-bottom-right-radius: 8px; border-top-right-radius: 8px;"> &nbsp;
                                &nbsp;
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-light">
                                        <i class="fa fa-search" style="color: black"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <section class="py-3">
        <div class="container px-4 px-lg-5 mt-5">
            <form action="<?php echo e(url('/tambah-keranjang')); ?>" method="post" enctype="multipart/form-data">

                <?php echo csrf_field(); ?>
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                    <?php $__currentLoopData = $prd; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col mb-5">
                            <input type="hidden" name="kategori_id" value="<?php echo e($produk->kategori_id); ?>">
                            <div class="card h-100"
                                onclick="window.location.href='<?php echo e(route('produk.detailproduk', ['id' => $produk->id])); ?>'">

                                <!-- Sale badge-->
                                <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                    Sale</div>
                                <!-- Product image-->
                                <img class="card-img-top" src="<?php echo e(asset('storage/' . $produk->foto)); ?>" alt="..." />
                                <!-- Product details-->
                                <div class="card-body p-4">
                                    <div class="text-center">
                                        <!-- Product name-->
                                        <h5 class="fw-bolder"><?php echo e($produk->nama_produk); ?></h5>
                                        <!-- Product price-->
                                        Rp. <?php echo e(number_format($produk->harga, 0, ',', '.')); ?>

                                    </div>
                                </div>
                                <input type="hidden" name="id_produk" id="id_produk" value="<?php echo e($produk->id); ?>">
                                <input type="hidden" name="qty" id="qty" value="1" min="1">
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-dark mt-auto" href="#"><i
                                                class="fa-solid fa-cart-shopping"></i> Tambah</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </form>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function() {
        // Menangani klik pada tautan dengan ID yang dimulai dengan "kategoriLink"
        $('[id^=kategoriLink]').on('click', function(event) {
            event.preventDefault(); // Mencegah tindakan default dari tautan

            // Di sini, Anda dapat menambahkan logika tambahan atau melakukan pengalihan ke URL yang sesuai.
            // Contoh: window.location.href = $(this).attr('href');

            // Anda juga dapat menambahkan efek visual atau mengubah kelas atau properti CSS, sesuai kebutuhan.
            $(this).addClass('active'); // Contoh menambahkan kelas "active"
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.hometemp', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/pages/beranda/cari.blade.php ENDPATH**/ ?>