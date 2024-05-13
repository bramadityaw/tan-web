@extends('layouts.admin')
@section('main')
<section>
    <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Produk</h1>
        <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/products/create">
            <i class="fa-solid fa-plus block text-md mr-4"></i>
            <span class="inline-block mr-2">Tambah</span>
        </a>
    </div>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-6">Nama Barang</th>
            <th scope="col" class="py-3 px-6">Gambar</th>
            <th scope="col" class="py-3 px-6">Stok</th>
            <th scope="col" class="py-3 px-6">Harga</th>
            <th scope="col" class="py-3 px-6">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $products)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">{{ (explode(' ', $purchase->created_at)[0]) }}</td>
                <td class="py-4 px-6">{{ $purchase->nama_barang }}</td>
                <td class="py-4 px-6">{{ rupiah($purchase->harga_beli) }}</td>
                <td class="py-4 px-6">{{ $purchase->qty }}</td>
                <td class="py-4 px-6">{{ rupiah($purchase->harga_beli * $purchase->qty) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $products->links() }}
</section>

@endsection
