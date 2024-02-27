<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>


</head>
<style>
    @import url('{{ public_path('css/bootstrap.min.css') }}');

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

    <p>Nomor Transaksi  : {{ $nt->nota }}</p>
    <p>Tanggal          : {{ $nt->tanggal }}</p>
    <p>Kasir            : {{ $nt->kasir->name }}</p>

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
            @foreach ($nt->cartdetail as $dt)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td>{{ $dt->produk->kode_produk }}</td>
              <td>{{ $dt->produk->nama_produk }}</td>
              <td class="text-center">{{ $dt->qty }}</td>
              <td class="text-center">{{ $dt->produk->harga }}</td>
              <td class="text-center">{{ $dt->subtotal }}</td>
            </tr>
            @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center"></th>
                <th class="text-center">Total : </th>
                <th class="text-center">{{ $nt->cart->total }}</th>
              </tr>
              <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center"></th>
                <th class="text-center">Dibayar : </th>
                <th class="text-center">{{ $nt->tunai }}</th>
              </tr>
              <tr>
                <th scope="col" class="text-center"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col" class="text-center"></th>
                <th class="text-center">Kembali : </th>
                <th class="text-center">{{ $nt->kembali }}</th>
              </tr>
        </tfoot>
      </table>
</body>

</html>
