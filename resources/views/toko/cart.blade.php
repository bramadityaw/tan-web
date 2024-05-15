@php
function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
@endphp

@extends('layouts.user')

@section('main')
<section class="bg-[#1B3C73] py-8">
    <div class="w-5/6 md:w-full max-w-[520px] mx-auto">
        <div class="rounded-md bg-white">
            <div class="px-6 pt-5 pb-1">
            @foreach ($contents as $content)
                <div class="flex mb-4">
                    <a class="block w-full" href="/toko/produk/{{ $content->product->id }}">
                        <img class="w-full max-w-[192px] aspect-auto" src="/storage/{{ $content->product->thumbnail_url }}" alt="{{ $content->product->nama }}">
                    </a>
                    <div class="ml-4 md:m-0 md:flex">
                        <a class="mr-4 md:mr-8" href="/toko/produk/{{ $content->product->id }}">
                            <h1>{{ $content->product->nama }}</h1>
                            <p class="text-sm">{{ rupiah($content->product->harga) }}</p>
                        </a>
                        <div class="flex min-w-[135px] w-full text-sm items-center">
                            <button type="button" onclick="qty.value ++; updateQty(qty.value)" class="h-10 border border-r-0 rounded-l px-3">
                               <i class="fa-solid fa-plus"></i>
                            </button>
                            <input type="number" name="qty" id="qty" class=
                            "h-10 border mt-1 px-4 w-full bg-gray-50" value="{{ $content->qty }}" min=
                            "1">
                            <button type="button" onclick="qty.value > 0 ? qty.value-- : 0; updateQty(qty.value)" class="h-10 border border-l-0 rounded-r px-3">
                              <i class="fa-solid fa-minus"></i>
                           </button>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
</section>
@endsection
