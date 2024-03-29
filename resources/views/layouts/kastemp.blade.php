<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <!-- Tell the browser to be responsive to screen width -->
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="{{ csrf_token() }}">
 <meta name="description" content="">
 <meta name="author" content="">
 <!-- Favicon icon -->
 <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
 <title>Aplikasi Penjualan</title>
 <!-- Custom CSS -->
 <link href="{{ asset('admin/assets/libs/flot/css/float-chart.css') }}" rel="stylesheet">
 <!-- Custom CSS -->
 <link href="{{ asset('admin/dist/css/style.min.css') }}" rel="stylesheet">
 <link href="{{ asset('admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
 <link rel="stylesheet" href="{{ asset('admin/assets/libs/toastr/build/toastr.min.css') }}">
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
       <img src="{{ asset('admin/assets/images/logo-icon.png') }}" alt="homepage" class="light-logo" />
      </b>
      <!--End Logo icon -->
      <!-- Logo text -->
      <span class="logo-text">
       <!-- dark Logo text -->
       <img src="{{ asset('admin/assets/images/logo-text.png') }}" alt="homepage" class="light-logo" />

      </span>

      <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
       data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
       aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
    </div>
    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
     <ul class="navbar-nav float-left mr-auto">
      {{-- <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light"
        href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <span class="d-none d-md-block">Create New <i class="fa fa-angle-down"></i></span>
        <span class="d-block d-md-none"><i class="fa fa-plus"></i></span>
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
       </div>
      </li>
      <!-- ============================================================== -->
      <!-- Search -->
      <!-- ============================================================== -->
      <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark" href="javascript:void(0)"><i
         class="ti-search"></i></a>
       <form class="app-search position-absolute">
        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i
          class="ti-close"></i></a>
       </form>
      </li> --}}
     </ul>

     <ul class="navbar-nav float-right">

      {{-- <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-bell font-24"></i>
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="#">Action</a>
        <a class="dropdown-item" href="#">Another action</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Something else here</a>
       </div>
      </li>

      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" id="2"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i
         class="font-24 mdi mdi-comment-processing"></i>
       </a>
       <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
        <ul class="list-style-none">
         <li>
          <div class="">
           <!-- Message -->
           <a href="javascript:void(0)" class="link border-top">
            <div class="d-flex no-block align-items-center p-10">
             <span class="btn btn-success btn-circle"><i class="ti-calendar"></i></span>
             <div class="m-l-10">
              <h5 class="m-b-0">Event today</h5>
              <span class="mail-desc">Just a reminder that event</span>
             </div>
            </div>
           </a>
           <!-- Message -->
           <a href="javascript:void(0)" class="link border-top">
            <div class="d-flex no-block align-items-center p-10">
             <span class="btn btn-info btn-circle"><i class="ti-settings"></i></span>
             <div class="m-l-10">
              <h5 class="m-b-0">Settings</h5>
              <span class="mail-desc">You can customize this template</span>
             </div>
            </div>
           </a>
           <!-- Message -->
           <a href="javascript:void(0)" class="link border-top">
            <div class="d-flex no-block align-items-center p-10">
             <span class="btn btn-primary btn-circle"><i class="ti-user"></i></span>
             <div class="m-l-10">
              <h5 class="m-b-0">Pavan kumar</h5>
              <span class="mail-desc">Just see the my admin!</span>
             </div>
            </div>
           </a>
           <!-- Message -->
           <a href="javascript:void(0)" class="link border-top">
            <div class="d-flex no-block align-items-center p-10">
             <span class="btn btn-danger btn-circle"><i class="fa fa-link"></i></span>
             <div class="m-l-10">
              <h5 class="m-b-0">Luanch Admin</h5>
              <span class="mail-desc">Just see the my new admin!</span>
             </div>
            </div>
           </a>
          </div>
         </li>
        </ul>
       </div>
      </li> --}}
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
         src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" class="rounded-circle"
         width="31">&nbsp; {{ Auth::user()->name }} </a>
       <div class="dropdown-menu dropdown-menu-right user-dd animated">
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
      </li>
      <!-- ============================================================== -->
      <!-- User profile and search -->
      <!-- ============================================================== -->
     </ul>
    </div>
   </nav>
  </header>
  {{-- menu side --}}
  @include('layouts.component.kasmenu')

  <div class="page-wrapper">
   @yield('kasir')

   <footer class="footer text-center">
    All Rights Reserved by Matrix-admin. Designed and Developed by <a href="#">WrapPixel</a>.
   </footer>
  </div>

 </div>
 <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
 <!-- Bootstrap tether Core JavaScript -->
 <script src="{{ asset('admin/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
 <script src="{{ asset('admin/assets/extra-libs/sparkline/sparkline.js') }}"></script>
 <!--Wave Effects -->
 <script src="{{ asset('admin/dist/js/waves.js') }}"></script>
 <!--Menu sidebar -->
 <script src="{{ asset('admin/dist/js/sidebarmenu.js') }}"></script>
 <!--Custom JavaScript -->
 <script src="{{ asset('admin/dist/js/custom.min.js') }}"></script>
 <!--This page JavaScript -->
 <!-- <script src="dist/js/pages/dashboards/dashboard1.js"></script> -->
 <!-- Charts js Files -->
 <script src="{{ asset('admin/assets/libs/flot/excanvas.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/flot/jquery.flot.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/flot/jquery.flot.pie.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/flot/jquery.flot.time.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/flot/jquery.flot.stack.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/flot/jquery.flot.crosshair.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js') }}"></script>
 <script src="{{ asset('admin/dist/js/pages/chart/chart-page-init.js') }}"></script>
 <script src="{{ asset('admin/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
 <script src="{{ asset('admin/assets/libs/toastr/build/toastr.min.js') }}"></script>
 <script src="{{ asset('admin/jQueryMask/dist/jquery.mask.min.js') }}"></script>

 @yield('modalku')
 @yield('jsku')

</body>

</html>
