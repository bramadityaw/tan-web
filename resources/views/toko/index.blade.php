@php
function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
@endphp

@extends('layouts.user')
@section('main')
<div class="bg-[#1B3C73] text-white py-8">
    <div class="w-5/6 mx-auto">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <div class="rounded-md text-black col-span-1 bg-white p-4">
                <a href="/toko/product/{{ $product->slug }}">
                    <img class="w-[250px] h-[160px] object-cover" src="/storage/{{ $product->thumbnail_url }}" alt="">
                    <h1 class="text-lg font-bold">{{ $product->nama }}</h1>
                    <p>{{ rupiah($product->harga) }}</p>
                </a>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-4">
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-full font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/toko/product/{{ $product->slug }}">
                        <i class="fa-solid fa-eye block text-md mr-4"></i>
                        <span class="inline-block mr-2">Detail</span>
                    </a>
                    <button class="flex items-center bg-[#1B3C73] rounded-md w-full font-semibold text-white text-center text-sm md:text-md px-2 py-1" data-product-id="{{ $product->id }}" onclick="addToCart(this.dataset.productId)">
                        <i class="fa-solid fa-cart-shopping block text-md mr-4"></i>
                        <span class="inline-block mr-2">Tambah</span>
                    </button>
                </div>
            </div>
@endforeach
        </div>
    </div>
    {{ $products->links() }}
</div>

@include('toko.cart')
@endsection


@section('scripts')
    @parent
<script>
function addToCart(productId) {
    console.log(productId);
}
</script>
@endsection
