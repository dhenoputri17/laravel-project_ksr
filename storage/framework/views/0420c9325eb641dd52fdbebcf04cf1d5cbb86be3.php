<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <!-- Tell the browser to be responsive to screen width -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
 <meta name="description" content="">
 <meta name="author" content="">
 <!-- Favicon icon -->
 <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
 <title>Aplikasi Penjualan</title>
 <!-- Custom CSS -->
 <link href="<?php echo e(asset('admin/assets/libs/flot/css/float-chart.css')); ?>" rel="stylesheet">
 <!-- Custom CSS -->
 <link href="<?php echo e(asset('admin/dist/css/style.min.css')); ?>" rel="stylesheet">
 <link href="<?php echo e(asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')); ?>" rel="stylesheet">
 <link rel="stylesheet" href="<?php echo e(asset('admin/assets/libs/toastr/build/toastr.min.css')); ?>">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
 <div class="preloader">
  <div class="lds-ripple">
   <div class="lds-pos"></div>
   <div class="lds-pos"></div>
  </div>
 </div>

 <div id="main-wrapper">
  <header class="topbar" data-navbarbg="skin5">
   <nav class="navbar top-navbar navbar-expand-md navbar-dark">
    <div class="navbar-header" data-logobg="skin5">
     <!-- This is for the sidebar toggle which is visible on mobile only -->
     <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
       class="ti-menu ti-close"></i></a>

     <a class="navbar-brand" href="index.html">
      <!-- Logo icon -->
      <b class="logo-icon p-l-10">
       <img src="<?php echo e(asset('admin/assets/images/logo-icon.png')); ?>" alt="homepage" class="light-logo" />
      </b>
      <!--End Logo icon -->
      <!-- Logo text -->
      <span class="logo-text">
       <!-- dark Logo text -->
       <img src="<?php echo e(asset('admin/assets/images/logo-text.png')); ?>" alt="homepage" class="light-logo" />

      </span>

      <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
       data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
       aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
     <ul class="navbar-nav float-left mr-auto">

     </ul>

     <ul class="navbar-nav float-right">
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
         src="<?php echo e(asset('admin/assets/images/users/1.jpg')); ?>" alt="user" class="rounded-circle"
         width="31"> &nbsp; <?php echo e(Auth::user()->name); ?></a>
       <div class="dropdown-menu dropdown-menu-right user-dd animated">
        <a class="dropdown-item"  href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                <?php echo csrf_field(); ?>
            </form>
      </li>
      <!-- ============================================================== -->
      <!-- User profile and search -->
      <!-- ============================================================== -->
     </ul>
    </div>
   </nav>
  </header>
  
  <?php echo $__env->make('layouts.component.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <div class="page-wrapper">
   <?php echo $__env->yieldContent('utama'); ?>

   <footer class="footer text-center">
    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="#">WrapPixel</a>.
   </footer>
  </div>

 </div>
 <script src="<?php echo e(asset('admin/assets/libs/jquery/dist/jquery.min.js')); ?>"></script>
 <!-- Bootstrap tether Core JavaScript -->
 <script src="<?php echo e(asset('admin/assets/libs/popper.js/dist/umd/popper.min.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/extra-libs/sparkline/sparkline.js')); ?>"></script>
 <!--Wave Effects -->
 <script src="<?php echo e(asset('admin/dist/js/waves.js')); ?>"></script>
 <!--Menu sidebar -->
 <script src="<?php echo e(asset('admin/dist/js/sidebarmenu.js')); ?>"></script>
 <!--Custom JavaScript -->
 <script src="<?php echo e(asset('admin/dist/js/custom.min.js')); ?>"></script>
 <!--This page JavaScript -->
 <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
 <!-- Charts js Files -->
 <script src="<?php echo e(asset('admin/assets/libs/flot/excanvas.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/flot/jquery.flot.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/flot/jquery.flot.pie.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/flot/jquery.flot.time.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/flot/jquery.flot.stack.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/flot/jquery.flot.crosshair.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/dist/js/pages/chart/chart-page-init.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/extra-libs/DataTables/datatables.min.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/assets/libs/toastr/build/toastr.min.js')); ?>"></script>
 <script src="<?php echo e(asset('admin/jQueryMask/dist/jquery.mask.min.js')); ?>"></script>
 <?php echo $__env->yieldContent('modalku'); ?>
 <?php echo $__env->yieldContent('jsku'); ?>

</body>

</html>
<?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/layouts/template.blade.php ENDPATH**/ ?>