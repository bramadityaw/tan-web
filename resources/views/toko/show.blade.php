@php
function rupiah(int $amount) : string
{
    return 'Rp.' . number_format($amount,2, ',' , '.');
}

function extractText(string $start, string $end, string $text) : string
{
    $startPos = strpos($text, $start) + strlen($start);
    $endPos = strpos($text, $end);

    if (!($startPos || $endPos))
    {
        return '';
    }

    return trim(substr($text, $startPos, $endPos - $startPos));
}
@endphp


@extends('layouts.user')
@section('main')
<div class="bg-[#1B3C73] text-white py-8">
    <div class="w-4/5 mx-auto">
        <section class="lg:flex items-center">
            <img src="/storage/{{ $product->thumbnail_url }}" alt="{{ $product->nama }}" class="rounded-r-md w-1/2 h-full object-cover">
            <div class="rounded-r-md bg-white text-black w-1/2 p-4">
                <h1 class="font-semibold text-2xl">{{ $product->nama }}</h1>
                <div class="flex justify-between items-end my-4 text-lg">
                    <span class="inline-block">Stok Tersedia: {{ $product->stok }}</span>
                    <span class="inline-block">{{ rupiah($product->harga) }} / ekor</span>
                </div>
                <div class="lg:flex">
                    <h1 class="lg:mr-8">Deskripsi</h1>
                    <p>{{ extractText('DESKRIPSI', 'BUDIDAYA', $product->deskripsi) }}</p>
                </div>
                <div>
                    <form action="/cart" method="post">
                        <div class="flex items-center">
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <label for="qty">Jumlah Beli</label>
                            <div class="ml-4 flex">
                                <button type="button" onclick="qty.value ++" class="border border-r-0 rounded-l px-3">
                                   <i class="fa-solid fa-plus"></i>
                                </button>
                                <input type="number" name="qty" id="qty" class=
                                "h-10 border mt-1 px-4 w-1/4 bg-gray-50" value="0" min=
                                "0">
                                <button type="button" onclick="qty.value > 0 ? qty.value-- : 0" class="border border-l-0 rounded-r px-3">
                                  <i class="fa-solid fa-minus"></i>
                               </button>
                            </div>
                        </div>
                        <button class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" type="submit">
                            <i class="fa-solid fa-cart-plus"></i>
                            <p>Masukkan Keranjang</p>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section class="mt-4">
            <h1 class="font-semibold text-2xl mb-4">Produk lainnya</h1>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($others as $other)
                <div class="rounded-md text-black col-span-1 bg-white p-4">
                    <a href="/toko/product/{{ $product->slug }}">
                        <img class="w-[250px] h-[160px] object-cover" src="/storage/{{ $other->thumbnail_url }}" alt="{{ $other->nama }}">
                        <h1 class="text-lg font-bold">{{ $other->nama }}</h1>
                        <p>{{ rupiah($other->harga) }}</p>
                    </a>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 mt-4">
                        <a class="flex items-center bg-[#1B3C73] rounded-md w-full font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/toko/product/{{ $other->slug }}">
                            <i class="fa-solid fa-eye block text-md mr-4"></i>
                            <span class="inline-block mr-2">Detail</span>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            {{$others->links()}}
        </section>
    </div>
</div>

@include('toko.cart')
@endsection
