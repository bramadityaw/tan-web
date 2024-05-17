@extends('layouts.user')
@section('main')
<div class="bg-[#1B3C73] text-white py-8">
    <div class="w-2/3 lg:w-5/6 mx-auto">
        @if($products->isNotEmpty())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        @foreach ($products as $product)
            <div class="rounded-md text-black col-span-1 bg-white p-4">
                <a href="/toko/product/{{ $product->slug }}">
                    <img class="w-[250px] h-[160px] object-cover" src="/storage/{{ $product->thumbnail_url }}" alt="">
                    <h1 class="text-lg font-bold">{{ $product->nama }}</h1>
                    <p>{{ rupiah($product->harga) }}</p>
                </a>
                <div class="grid grid-cols-2 gap-2 mt-4">
                    <a class="col-span-1 flex items-center bg-[#1B3C73] rounded-md font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/toko/product/{{ $product->slug }}">
                        <i class="fa-solid fa-eye block text-md mr-4"></i>
                        <span class="inline-block mr-2">Detail</span>
                    </a>
                    <button class="col-span-1 flex items-center bg-[#1B3C73] rounded-md font-semibold text-white text-center text-sm md:text-md px-2 py-1" data-product-id="{{ $product->id }}" onclick="addToCart(this.dataset.productId)">
                        <i class="fa-solid fa-cart-shopping block text-md mr-2"></i>
                        <span class="inline-block mr-2">Masukkan</span>
                    </button>
                </div>
            </div>
        @endforeach
        </div>
    {{ $products->links() }}
        @elseif(str_contains(url()->current(), 'search'))
        <div class="h-[50dvh]">
            <div class="mx-auto w-full lg:w-1/2">
                <div class="bg-white rounded-md p-4 text-black text-center">
                    <h1 class="text-lg font-semibold">Kami tidak mampu menemukan '{{ $query }}' di toko website ini.</h1>
                    <p class="w-5/6 mx-auto my-8">Antara kami tidak menjual apa yang kamu cari, atau belum ada di website. <a class="text-blue-500 underline" href="https://maps.app.goo.gl/igL3pTLTUekftqhb9">Kunjungi langsung toko kami</a> atau <a href="https://wa.me/+6281379048620" class="text-blue-500 underline">hubungi pemilik Tan Aquatic.</a></p>
                    <div class="rounded-md bg-white text-black w-full sm:w-3/5 lg:w-[35%]">
                        <form action="/toko/search" class="flex m-0">
                            <input class="text-base w-full border-0 rounded-l-md pl-2 py-1" name="query" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
                            <button class="px-4" type="submit">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@endsection


@section('scripts')
    @parent
<script>
async function addToCart(productId) {
    const form = new FormData();
    form.append('_token', token);
    form.append('qty', 1);

    const response = await fetch(`/cart/${productId}`, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'multipart/form-data',
        },
        body: form,
    })

    window.location.replace(response.url);
}
</script>
@endsection
