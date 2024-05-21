@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/products/">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-12 mx-auto w-fit min-h-[368px]">
    <h1 class="text-2xl font-semibold mb-4">Ubah Produk</h1>
    <form action="/product/{{ $product->id }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-2">
      <div class="lg:col-span-2">
        <div class=
        "grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
          <div class="md:col-span-5">
            <label for="nama_produk">Nama Produk</label>
            <input type="text" name="nama_produk" id=
            "nama_produk" class=
            "h-10 border mt-1 rounded px-4 w-full bg-gray-50"
            value="{{ $product->nama }}">
          </div>
          <div class="md:col-span-5">
            <div class="flex">
              <div class="w-full">
                <label for="harga">Harga Barang</label>
                <div class="flex items-center">
                  <span class=
                  "flex h-10 items-center rounded-l border border-r-0 border-gray-100 px-3">
                  Rp.</span> <input type="number" name="harga"
                  id="harga" class=
                  "h-10 border mt-1 rounded-r px-4 w-full bg-gray-50"
                  value="{{ $product->harga }}" placeholder="" min="0">
                </div>
              </div>
              <div class="ml-4 w-2/5">
                <label for="stok">Stok Awal</label>
                <div class="flex">
                  <button type="button" onclick="stok.value ++" class="border border-l-0 rounded-r px-3">
                     <i class="fa-solid fa-plus"></i>
                  </button>
                  <input type="number" name="stok" id="stok" class=
                  "h-10 border mt-1 px-4 w-full bg-gray-50" value="{{ $product->stok }}" min=
                  "0">
                  <button type="button" onclick="stok.value > 0 ? stok.value-- : 0" class="border border-l-0 rounded-r px-3">
                    <i class="fa-solid fa-minus"></i>
                 </button>
                </div>
              </div>
            </div>
          </div>
          <div class="md:col-span-5">
            <label for="deskripsi">Deskripsi Produk</label>
            <textarea class="rounded-l border px-3 py-2 bg-gray-50 w-full" name="deskripsi" id="deskripsi" cols="30" rows="6">{{ $product->deskripsi }}</textarea>
          </div>
           <div class="md:col-span-5">
            <div class="flex items-center">
                <div class="w-full">
                    <label for="gambar">Gambar Produk</label>
                    <input class="flex items-center rounded-l border w-full bg-gray-50 border-gray-100" type="file" name="gambar" id="gambar" value="{{ 'C:\\fakepath\\' . explode('/', $product->thumbnail_url)[1] }}">
                </div>
                <div class="ml-4 w-2/5">
                    <label for="is_online">Tampilkan di toko?</label>
                    <input {{ $product->is_online ? 'checked' : '' }} class="ml-4" type="checkbox" name="is_online" id="is_online">
                </div>
            </div>
          </div>          <div class="md:col-span-5 mt-4">
            <button type="submit" class=
            "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
            Ubah</button>
          </div>
        </div>
      </div>
    </div>
  </form>

@if ($errors->any())
    <div class="text-red-500">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
</div>
@endsection

@push('scripts')
<script>
const stok = document.querySelector('#stok');
</script>
@endpush
