@php
function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
@endphp

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
            <th scope="col" class="py-3 px-6">Nama Produk</th>
            <th scope="col" class="py-3 px-6">Gambar</th>
            <th scope="col" class="py-3 px-6">Stok</th>
            <th scope="col" class="py-3 px-6">Harga</th>
            <th scope="col" class="py-3 px-6">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @if($products->isNotEmpty())
        @foreach($products as $product)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">{{ $product->nama }}</td>
                <td class="py-4 px-6">
                    <img src="{{ asset('storage/'. $product->thumbnail_url) }}" alt="{{ $product->nama }}" class="max-w-[192px] aspect-auto">
                </td>
                <td class="py-4 px-6">{{ rupiah($product->harga) }}</td>
                <td class="py-4 px-6">{{ $product->stok }}</td>
                <td class="py-4 px-6 text-white text-center">
                    <a href="/admin/dashboard/product/{{ $product->id }}/ubah" class="inline-block w-fit rounded-md px-3 py-2 bg-green-500">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Ubah</span>
                    </a>
                    <button data-product-id="{{ $product->id }}" onclick="window.product = this; deleteProduct(window.product)" class="rounded-md px-3 py-2 bg-red-500">
                        <i class="fa-solid fa-trash"></i>
                        <span>Hapus</span>
                    </button>
                </td>
            </tr>
        @endforeach
        @else
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4" colspan="5">
                    <h1 class="text-xl text-center text-gray-400 font-semibold py-12">Belum ada apa-apa di sini...</h1>
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md mx-auto px-2 py-1" href="/admin/dashboard/products/create">
                        <i class="fa-solid fa-plus block text-md mr-4"></i>
                        <span class="inline-block mr-2">Tambah</span>
                    </a>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    {{ $products->links() }}
</section>
<dialog id="deleteDialog">
    <p>Hapus produk?</p>
    <form method="dialog">
        <button type="submit">Batal</button>
    </form>
    <button type="button">Hapus</button>
</dialog>
@endsection

@push('scripts')
<script>
const token = document.querySelector('input[name="_token"]').value;
const deleteDialog = document.querySelector("#deleteDialog");
const deleteButton = deleteDialog.querySelector('button[type="button"]');

function deleteProduct(produk) {
    deleteDialog.showModal();
    const produkId = produk.dataset.productId;
    const uri = `/product/${produkId}`;

    deleteButton.addEventListener("click", e => {
        fetch(uri, {
            method: "DELETE",
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                _token: token,
            }),
        });
        deleteDialog.close();
        location.reload();
    });
}
</script>
@endpush
