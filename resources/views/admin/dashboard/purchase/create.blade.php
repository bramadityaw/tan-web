@extends('layouts.admin')
@section('main')
<div class="flex justify-between">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/purchase/">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-12 mx-auto w-fit min-h-[368px]">
    <h1 class="text-2xl font-semibold mb-4">Buat Pembelian</h1>
    <form action="/admin/dashboard/transactions" method="post">
    @csrf
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-2">
      <div class="lg:col-span-2">
        <div class=
        "grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
          <div class="md:col-span-5">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id=
            "nama_barang" class=
            "h-10 border mt-1 rounded px-4 w-full bg-gray-50"
            value="">
          </div>
          <div class="md:col-span-5">
            <div class="flex">
              <div class="w-full">
                <label for="harga">Harga Barang</label>
                <div class="flex items-center">
                  <span class=
                  "flex h-10 items-center rounded-l border border-r-0 border-gray-100 px-3">
                  Rp.</span> <input type="number" name="harga_beli"
                  id="harga" class=
                  "h-10 border mt-1 rounded-r px-4 w-full bg-gray-50"
                  value="" placeholder="">
                </div>
              </div>
              <div class="ml-4 w-2/5">
                <label for="qty">Jumlah Terbeli</label>
                <div class="flex">
                  <button type="button" onclick="qty.value ++" class="border border-l-0 rounded-r px-3">
                     <i class="fa-solid fa-plus"></i>
                  </button>
                  <input type="number" name="qty" id="qty" class=
                  "h-10 border mt-1 px-4 w-full bg-gray-50" value="0" min=
                  "0">
                  <button type="button" onclick="qty.value > 0 ? qty.value-- : 0" class="border border-l-0 rounded-r px-3">
                    <i class="fa-solid fa-minus"></i>
                 </button>
                </div>
              </div>
            </div>
          </div>
          <div class="md:col-span-5">
            <label for="created_at">Tanggal Transaksi</label>
            <input type="date" name="created_at" id="created_at"
            class=
            "h-10 border mt-1 rounded px-4 w-full bg-gray-50"
            placeholder="">
          </div>
          <div class="md:col-span-5 mt-4">
            <button type="submit" class=
            "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
            Buat</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
const qty = document.querySelector('#qty');
</script>
@endpush
