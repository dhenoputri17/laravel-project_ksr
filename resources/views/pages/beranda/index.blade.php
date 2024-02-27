@extends('layouts.hometemp')
@section('customer')
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Aplikasi Kasir Restoran</h1>
                <p class="lead fw-normal text-white-50 mb-0">Halaman depan</p>
                <br>
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <form action="{{ url('/produk/cari') }}" method="GET">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" name="p" id="p"
                                    placeholder="Cari disini" value="{{ request('p') }}"
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
    <section>
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row mt-4">
                <div class="col-md-2 mt-1 text-end">
                    <h5>Kategori</h5>
                </div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card mb-4 shadow-sm">
                                <a href="{{ url('/') }}" class="btn btn-sm btn-outline-dark active">
                                    <p class="card-text">Semua Kategori</p>
                                </a>
                            </div>
                        </div>
                        @foreach ($kategoris as $kategori)
                            <div class="col-md-2">
                                <div class="card mb-4 shadow-sm">
                                    <a href="{{ url('/produk/kategori/' . $kategori->id) }}"
                                        class="btn btn-sm btn-outline-dark" id="kategoriLink{{ $kategori->id }}">
                                        <p class="card-text">{{ $kategori->nama_kategori }}</p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-3">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @foreach ($produks as $produk)
                    <div class="col mb-5">
                        <input type="hidden" name="kategori_id" value="{{ $produk->kategori_id }}">
                        <div class="card h-100"
                            onclick="window.location.href='{{ route('produk.detailproduk', ['id' => $produk->id]) }}'">
                            <!-- Sale badge -->
                            @if ($produk->stok_akhir == $produk->stok_minimal)
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                Sold Out</div>
                            @else
                            <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">
                                Sale</div>
                            @endif
                            <!-- Product image-->
                            <img class="card-img-top" src="{{ asset('storage/' . $produk->foto) }}" alt="..." />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder">{{ $produk->nama_produk }}</h5>
                                    <!-- Product price-->
                                    Rp. {{ number_format($produk->harga, 0, ',', '.') }}
                                </div>
                            </div>
                            @if ($produk->stok_akhir == $produk->stok_minimal)
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-outline-dark mt-auto disabled" href="#"><i
                                            class="fa-solid fa-cart-shopping"></i> Tambah</button>
                                </div>
                            </div>
                            @else
                            <form action="{{ url('/tambah-keranjang') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_produk" id="id_produk" value="{{ $produk->id }}">
                                <input type="hidden" name="qty" id="qty" value="1" min="1">
                                <!-- Product actions-->
                                <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-outline-dark mt-auto" href="#"><i
                                                class="fa-solid fa-cart-shopping"></i> Tambah</button>
                                    </div>
                                </div>
                            </form>
                            @endif

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
