<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?php echo e(asset('customer/css/styles.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    /* Gaya untuk menyembunyikan panah pada input tipe number */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
        /* Untuk Firefox */
    }

    input[type="number"] {
        text-align: center;
    }
</style>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="<?php echo e(url('/')); ?>">Aplikasi Kasir Restoran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    
                            
                            
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="<?php echo e(url('/keranjang')); ?>" class="btn btn-outline-dark" type="submit">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Keranjang
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo e($jumlahItem); ?></span>
                    </a>
                </form>
                &nbsp; &nbsp; &nbsp;
                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-1">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo e(asset('admin/assets/images/users/1.jpg')); ?>" alt="user" class="rounded-circle"
                            width="31">
                        <?php echo e(Auth::user()->name); ?>

                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                                <?php echo csrf_field(); ?>
                            </form></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->

    <!-- Section-->


    <?php echo $__env->yieldContent('customer'); ?>
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aplikasi Kasir Restoran </p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="<?php echo e(asset('customer/js/scripts.js')); ?>"></script>

    

    <?php echo $__env->yieldContent('mdl'); ?>
    <?php echo $__env->yieldContent('js'); ?>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/layouts/hometemp.blade.php ENDPATH**/ ?>