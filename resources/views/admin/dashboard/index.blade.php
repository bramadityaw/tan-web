@use('Carbon\Carbon')

@php
function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
@endphp

@extends('layouts.admin')
@section('main')
<div class="flex flex-col md:flex-row mb-4">
    <section class="justify-between w-full md:w-2/3">
        <h1 class="text-2xl font-semibold mb-4">Produk Terlaris Bulan Ini</h1>
        <!--Slider-->
        <div class="swiper mx-0">
            <div class="swiper-wrapper max-w-[640px]" style="height: auto;">
                <!-- Slides -->
                @foreach ($products as $product)
                    <div class="swiper-slide">
                        <img src="{{ $product["src"] }}" alt="">
                        <div class="absolute bottom-0 w-full px-10 pb-6 md:px-16 md:pb-8 bg-gradient-to-t from-black">
                            <h1 class="text-white text-lg md:text-xl">{{ $product["name"] }}</h1>
                        </div>
                    </div>
                @endforeach
            </div>

           <div class="swiper-button-prev aspect-square">
               <svg class="block aspect-square w-[8%]" style="width: 8%;" viewBox="0 0 63 67" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M31.75 3.19019C15.8738 3.19019 3 16.7521 3 33.4842C3 50.213 15.8738 63.7782 31.75 63.7782C47.6262 63.7782 60.5 50.213 60.5 33.4842C60.5 16.7521 47.6262 3.19019 31.75 3.19019Z" stroke="white" stroke-width="4.66216" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M36.2329 22.116L25.398 33.4836L36.2329 44.8512" stroke="white" stroke-width="4.66216" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
           </div>
           <div class="swiper-button-next aspect-square">
               <svg xmlns="http://www.w3.org/2000/svg" class="block aspect-square" style="width: 8%;" viewBox="0 0 64 67" fill="none">
               <path fill-rule="evenodd" clip-rule="evenodd" d="M32 64.3049C48.0143 64.3049 61 50.6251 61 33.7475C61 16.8732 48.0143 3.19012 32 3.19012C15.9857 3.19012 3 16.8732 3 33.7475C3 50.6251 15.9857 64.3049 32 64.3049Z" stroke="white" stroke-width="4.7027" stroke-linecap="round" stroke-linejoin="round"/>
               <path d="M27.4773 45.2144L38.4064 33.7479L27.4773 22.2814" stroke="white" stroke-width="4.7027" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
           </div>
        </div>
    </section>
    <section class="mt-4 md:w-2/3 md:mx-6 md:mt-0">
        <h1 class="text-2xl font-semibold mb-4">Rekap Bulan {{ Carbon::parse(date('c'))->translatedFormat('F') }}</h1>
        <div class="bg-white rounded-md px-4 py-3">
            <div class="w-full flex justify-between">
                <h2 class="w-fit font-semibold">Penjualan</h2>
                <span class="float-end">{{ rupiah($monthly_total['sales']) }}</span>
            </div>
            <div class="w-full flex justify-between">
                <h2 class="w-fit font-semibold">Pembelian</h2>
                <span class="float-right">{{ rupiah($monthly_total['purchases']) }}</span>
            </div>
            <div class="w-full flex justify-between {{ $monthly_total['diff'] >= 0 ? 'text-green-600' : 'text-red-600' }}">
                <h2 class="w-fit font-semibold">{{ $monthly_total['diff'] >= 0 ? 'Keuntungan' : 'Kerugian' }}</h2>
                <div>
                    @if($monthly_total['diff'] >= 0)
                        <i class="fa-solid fa-plus"></i>
                    @else
                        <i class="fa-solid fa-minus"></i>
                    @endif
                    <span class="float-end ml-1">{{ rupiah(abs($monthly_total['diff'])) }}</span>
                </div>
            </div>
        </div>
    </section>
</div>
<section>
    <h1 class="text-2xl font-semibold mb-4">Review Pelanggan</h1>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-[#C8C8C8]">
        <tr>
            <th scope="col" class="py-3 px-6">Nama Pelanggan</th>
            <th scope="col" class="py-3 px-6">Asal</th>
            <th scope="col" class="py-3 px-6">Review</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">Sasasa</td>
                <td class="py-4 px-6">Sasasa</td>
                <td class="py-4 px-6">Sasasa</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{-- {{ $reviews->links() }} --}}
</section>
@endsection

@push('scripts')
    @include('partials.scripts.swiperjs')
@endpush
