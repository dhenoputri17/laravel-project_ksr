@extends('layouts.hometemp')
@section('customer')
    <section class="h-100 gradient-custom">
        <div class="container py-5">

            <div class="row d-flex justify-content-center my-4">
                <div class="col-md-8">
                    @if ($keranjang && $keranjang->keranjangdetail->count() > 0)
                        @foreach ($keranjang->keranjangdetail as $cart)
                            <div class="card rounded-3 mb-4">
                                <div class="card-body p-4">
                                    <div class="row d-flex justify-content-between align-items-center">
                                        <div class="col-md-2 col-lg-2 col-xl-2">
                                            <img src="{{ asset('storage/' . $cart->produk->foto) }}"
                                                class="img-fluid rounded-3" alt="{{ $cart->produk->nama_produk }}">
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3">
                                            <p class="lead fw-normal mb-2"><b>{{ $cart->produk->nama_produk }}</b></p>
                                        </div>
                                        <div class="col-md-3 col-lg-2 col-xl-2 d-flex">
                                            <form action="{{ route('keranjangdetail.update', $cart->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="param" value="kurang">
                                                <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                            </form>

                                            <input id="quantity" min="0" name="quantity" value="{{ $cart->qty }}"
                                                type="number" style="width: 40px" class="form-control form-control-sm" />

                                            <form action="{{ route('keranjangdetail.update', $cart->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="param" value="tambah">
                                                <button class="btn btn-link px-2"
                                                    onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div class="col-md-3 col-lg-3 col-xl-3 offset-lg-1">
                                            <h5 class="mb-0">Rp.
                                                {{ number_format($cart->qty * $cart->produk->harga, 0, ',', '.') }}</h5>
                                        </div>
                                        <div class="col-md-1 col-lg-1 col-xl-1 px-1 text-end">
                                            <form action="{{ route('keranjangdetail.hapusdetail', $cart->id) }}"
                                                method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger btn-sm me-1 mb-2"><i
                                                        class="fas fa-trash fa-sm"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p>Keranjang Kosong</p>
                    @endif

                    <div class="modal fade" id="checkoutErrorMessage"  aria-hidden="true"
                    aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title fs-5" id="exampleModalToggleLabel"><i
                                        class="fas fa-circle-info fa-sm fa-success"></i> Informasi</h2>
                                <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                    aria-label="Close" onclick="location.reload()"></button>
                            </div>
                            <div class="modal-body mx-4">
                                <p>Chekout berhasil.</p>
                                <p>Pesanan Anda akan segera siap.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal"
                                    aria-label="Close" onclick="location.reload()">OK</button>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            @if (session('gagalm'))
                                <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#notif-meja').modal('show');
                                    })
                                </script>
                            @endif
                            <div class="modal fade" id="notif-meja" aria-hidden="true"
                                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title fs-5" id="exampleModalToggleLabel"><i
                                                    class="fas fa-circle-info fa-sm fa-warning"></i> Informasi</h2>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                                aria-label="Close" onclick="location.reload()"></button>
                                        </div>
                                        <div class="modal-body mx-4">
                                            <p>Anda belum memilih meja.</p>
                                            <p>Silahkan pilih meja terledih dahulu untuk melanjutkan.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal"
                                                aria-label="Close" onclick="location.reload()">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (session('berhasil'))
                                <script src="{{ asset('admin/assets/libs/jquery/dist/jquery.min.js') }}"></script>
                                <script>
                                    $(document).ready(function() {
                                        $('#notif-sukses').modal('show');
                                    })
                                </script>
                            @endif
                            <div class="modal fade" id="notif-sukses" aria-hidden="true"
                                aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h2 class="modal-title fs-5" id="exampleModalToggleLabel"><i
                                                    class="fas fa-circle-info fa-sm fa-success"></i> Informasi</h2>
                                            <button type="button" class="btn-close btn-sm" data-bs-dismiss="modal"
                                                aria-label="Close" onclick="location.reload()"></button>
                                        </div>
                                        <div class="modal-body mx-4">
                                            <p>Chekout berhasil.</p>
                                            <p>Pesanan Anda akan segera siap.</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-dismiss="modal"
                                                aria-label="Close" onclick="location.reload()">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            @php
                                $total = 0;
                            @endphp
                            @foreach ($keranjang->keranjangdetail as $detail)
                                @php
                                    $subtotal = $detail->qty * $detail->produk->harga;
                                    $total += $subtotal;
                                @endphp
                            @endforeach
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex align-items-center border-0 px-3 mb-0">
                                    <div class="col-md-4 text-right">
                                        <strong>Meja</strong>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="select2 form-control custom-select"
                                            style="width: 100%; height:36px;" id="meja" name="meja"
                                            oninput="isia(this.value)" required>
                                            <option selected="true" disabled>Pilih</option>
                                            @foreach ($mejas as $mj)
                                                <option value="{{ $mj->id }}">{{ $mj->meja }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </li>
                                <hr class="my-2">
                                <li style="font-size: 20px"
                                    class="list-group-item d-flex justify-content-between align-items-center border-0 px-3 mb-0">
                                    <div>
                                        <strong>Total</strong>
                                    </div>
                                    <span><strong>Rp. {{ number_format($total, 0, ',', '.') }}</strong></span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6 text-end">

                                @if ($keranjang && $keranjang->keranjangdetail->count() > 0)
                                <form action="{{ url('/chekout') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="no_meja" id="no_meja">
                                    <button type="submit" class="btn btn-primary btn-block" align="right">
                                        Checkout
                                    </button>
                                </form>
                                @else
                                <button type="submit" class="btn btn-primary btn-block disabled" align="right">
                                    Checkout
                                </button>
                                @endif


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        function isia(value) {
            var qtyInput = document.getElementById('no_meja');
            qtyInput.value = value;
        }
    </script>


@endsection
