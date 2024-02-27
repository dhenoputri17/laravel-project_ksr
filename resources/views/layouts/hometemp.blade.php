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
    <link href="{{ asset('customer/css/styles.css') }}" rel="stylesheet" />
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
            <a class="navbar-brand" href="{{ url('/') }}">Aplikasi Kasir Restoran</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    {{-- <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ url('/dashboard') }}">Login</a></li> --}}
                            {{-- <li>
                                <hr class="dropdown-divider" />
                            </li> --}}
                            {{-- <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li> --}}
                        </ul>
                    </li>
                </ul>
                <form class="d-flex">
                    <a href="{{ url('/keranjang') }}" class="btn btn-outline-dark" type="submit">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Keranjang
                        <span class="badge bg-dark text-white ms-1 rounded-pill">{{ $jumlahItem }}</span>
                    </a>
                </form>
                &nbsp; &nbsp; &nbsp;
                <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-1">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('admin/assets/images/users/1.jpg') }}" alt="user" class="rounded-circle"
                            width="31">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form></li>
                    </ul>
                </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Header-->

    <!-- Section-->


    @yield('customer')
    <!-- Footer-->
    <footer class="py-5 bg-dark">
        <div class="container">
            <p class="m-0 text-center text-white">Copyright &copy; Aplikasi Kasir Restoran </p>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('customer/js/scripts.js') }}"></script>

    {{-- <script>
        // public/js/scripts.js atau sesuaikan dengan struktur folder Anda

        document.addEventListener('DOMContentLoaded', function() {
            // Ambil semua tautan kategori
            var categoryLinks = document.querySelectorAll('.category-link');

            // Iterasi melalui setiap tautan kategori
            categoryLinks.forEach(function(link) {
                // Tambahkan event listener untuk setiap tautan kategori
                link.addEventListener('click', function(event) {
                    event.preventDefault();

                    // Ambil URL dari tautan kategori yang diklik
                    var url = link.getAttribute('href');

                    // Lakukan permintaan AJAX untuk mendapatkan produk berdasarkan kategori
                    fetch(url, {
                            method: 'GET'
                        })
                        .then(function(response) {
                            return response.text();
                        })
                        .then(function(html) {
                            // Ganti konten produk dengan produk baru
                            document.getElementById('container').innerHTML = html;
                        })
                        .catch(function(error) {
                            console.error('Error:', error);
                        });
                });
            });
        });
    </script> --}}

    @yield('mdl')
    @yield('js')
</body>

</html>
