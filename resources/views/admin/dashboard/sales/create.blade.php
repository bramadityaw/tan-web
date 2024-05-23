@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/sales/">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-12 mx-auto w-5/6 md:w-1/2 min-h-[368px]">
    <h1 class="text-2xl font-semibold mb-4">Catat Penjualan</h1>
    <form action="/sales" method="post">
    @csrf
    <div class="text-sm h-full">
        <div class="flex">
            <label class="w-full" for="product">Nama Produk dan Harga</label>
            <label class="w-2/3" for="qty">Terjual</label>
        </div>
        <div id="pemesanan" class="">
            <div class="flex mb-4">
                <select class="w-full min-w-16 rounded-md px-3 py-2" name="product_id_0" id="product">
                    @foreach($products as $p)
                    <option value="{{ $p->id }}">{{ $p->nama }} ({{ rupiah($p->harga) }})</option>
                    @endforeach
                </select>
                <div class="flex mx-4 w-1/2">
                    <button type="button" onclick="plus(this)" class="border border-r-0 rounded-r px-3">
                         <i class="fa-solid fa-plus"></i>
                    </button>
                        <input type="number" name="qty" id="qty" class="border mt-1 px-4 w-full bg-gray-50" value="1" min="1">
                    <button type="button" onclick="minus(this)" class="border border-r-0 rounded-r px-3">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
                <button onclick="tambahPesanan()" class="flex items-center justify-center bg-[#1B3C73] rounded-md w-1/6 aspect-square font-semibold text-white text-center text-md px-2 py-1" type="button">
                    <i class="fa-solid fa-plus block"></i>
                </button>
            </div>
        </div>
        <div class="mt-4 flex justify-end">
            <button type="submit" class=
            "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Buat</button>
        </div>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
    const pemesanan = document.querySelector('#pemesanan');
    let count = 0;
    function tambahPesanan() {
        count++;
        let pesanan = document.createElement('div');
        pesanan.classList.add('flex', 'mb-4');
        pesanan.innerHTML = `<select class="w-full min-w-16 px-3 py-2" name="product_id_${count}">\
            @foreach($products as $p)
            <option value="{{ $p->id }}">{{ $p->nama }} ({{ rupiah($p->harga) }})</option>\
            @endforeach\
            </select><div class="flex mx-4 w-1/2">
                    <button type="button" onclick="plus(this)" class="border border-r-0 rounded-r px-3">
                         <i class="fa-solid fa-plus"></i>
                    </button>
                    <input type="number" name="qty_${count}" id="qty" class=
                    "border mt-1 px-4 w-full bg-gray-50" value="1" min=
                    "1">
                    <button type="button" onclick="minus(this)" class="border border-r-0 rounded-r px-3">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
                <button onclick="kurangPesanan(this)" class="flex items-center justify-center bg-[#1B3C73] rounded-md w-1/6 aspect-square font-semibold text-white text-center text-md px-2 py-1" type="button">
                    <i class="fa-solid fa-trash block"></i>
                </button>`;
        pemesanan.append(pesanan);
    }

    function kurangPesanan(button) {
        button.parentNode.remove();
    }

    function plus(button) {
        let qty = button.parentNode.querySelector('#qty');
        console.log(qty, qty.value);
        qty.value = Number(qty.value) + 1;
    }

    function minus(button) {
        let qty = button.parentNode.querySelector('#qty');
        console.log(qty, qty.value);
        qty.value = Number(qty.value) > 1 ? Number(qty.value) - 1 : 1;
    }
</script>
@endpush
