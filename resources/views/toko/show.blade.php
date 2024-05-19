@php
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
        <div class="flex justify-between mb-4 ">
            <a class="flex items-center w-fit text-center text-sm md:text-md bg-white hover:bg-gray-300 text-black rounded-full px-2 py-1"
                href="{{url()->previous()}}">
                <i class="fa-solid fa-arrow-left text-gray-500 hover:text-gray-800 rounded-full"></i>
                <p class="ml-4">Kembali</p>
            </a>
        </div>
        <section class="lg:flex bg-black rounded-md items-center">
            <div class="w-full md:w-1/2">
                <img class="rounded-t-md md:rounded-none w-full aspect-auto" src="/storage/{{ $product->thumbnail_url }}" alt="{{ $product->nama }}">
            </div>
            <div class="rounded-b-md md:rounded-none md:rounded-r-md bg-white text-black md:w-1/2 p-4">
                <h1 class="font-semibold text-2xl">{{ $product->nama }}</h1>
                <div class="flex justify-between items-end my-4 text-lg">
                    @if ($product->stok > 0)
                        <span class="inline-block">Stok Tersedia: <span class="font-bold"> {{ $product->stok }} </span></span>
                    @else
                        <span>Stok Habis! <a href="https://wa.me/+6281379048620">Silahkan hubungi pemilik toko </a>  untuk stok ulang</span>
                    @endif
                    <span class="inline-block">{{ rupiah($product->harga) }} / ekor</span>
                </div>
                <div class="lg:flex">
                    <h1 class="lg:mr-8">Deskripsi</h1>
                    <p>{{ extractText('DESKRIPSI', 'BUDIDAYA', $product->deskripsi) }}</p>
                </div>
                <div>
                    <form action="/cart/{{ $product->id }}" method="post">
                        @csrf
                        <div class="flex items-center">
                            <label class="block" for="qty">Jumlah Beli</label>
                            <div class="ml-4 flex">
                                <button {{ $product->stok <= 0 ? 'disabled' : '' }} type="button" onclick="qty.value < {{ $product->stok }} ? qty.value ++ : qty.value" class="border border-r-0 rounded-l px-3">
                                   <i class="fa-solid fa-plus"></i>
                                </button>
                                <input {{ $product->stok <= 0 ? 'disabled' : '' }} type="number" name="qty" id="qty" class=
                                "h-10 border mt-1 px-4 w-1/4 bg-gray-50" value="1" min=
                                "1" max="{{ $product->stok }}">
                                <button {{ $product->stok <= 0 ? 'disabled' : '' }} type="button" onclick="qty.value > 0 ? qty.value-- : 0" class="border border-l-0 rounded-r px-3">
                                  <i class="fa-solid fa-minus"></i>
                               </button>
                            </div>
                        </div>
                        <button class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-md md:text-lg px-3 py-2 mt-4" type="submit">
                            <i class="fa-solid fa-cart-plus"></i>
                            <p class="ml-4">Masukkan Keranjang</p>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section class="mt-4">
            <h1 class="font-semibold text-2xl mb-4">Produk lainnya</h1>
            <div class="grid grid-cols-4 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($others as $other)
                <div class="rounded-md text-black col-span-3 mx-auto md:mx-0 md:col-span-1 bg-white p-4">
                    <a href="/toko/product/{{ $product->slug }}">
                        <img class="w-[250px] h-[160px] object-cover" src="/storage/{{ $other->thumbnail_url }}" alt="{{ $other->nama }}">
                        <h1 class="text-lg font-bold">{{ $other->nama }}</h1>
                        <p>{{ rupiah($other->harga) }}</p>
                    </a>
                    @if ($product->stok > 0)
                    <span class="float-start">Sisa stok: {{ $product->stok }}</span>
                    @else
                    <span class="float-start">Stok habis</span>
                    @endif
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-1/2 float-end font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/toko/product/{{ $other->slug }}">
                        <i class="fa-solid fa-eye block text-md mr-4"></i>
                        <span class="inline-block">Detail</span>
                    </a>
                </div>
                @endforeach
            </div>
            {{$others->links()}}
        </section>
    </div>
</div>
@endsection
