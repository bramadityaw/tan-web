@use('\App\Models\Product')

@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/sales/">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="w-5/6 sm:w-3/5 md:w-1/2 mx-auto">
    <div class="bg-white px-5 py-4 rounded-md mb-4">
        <div class="flex mb-4 items-center text-sm">
            <div class="flex flex-col justify-between w-full">
                <p class="flex justify-between">Pembeli: <span class="text-md">{{ $user->name }}</span></p>
                <p class="flex justify-between">E-Mail: <a class="text-md" href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
                <p class="flex justify-between">Tanggal Transaksi: <span class="text-md">{{ tanggalIdn($sales->created_at, 'D, j F o') }}</span></p>
            </div>
        </div>
@include('partials.divider-h')
        <div class="my-4">
            <ul>
            @foreach($order_items as $item)
                <li>
                @php $product = Product::find($item->product_id) @endphp
                    <div class="mb-4 flex items-center">
                        <img class="max-h-12 aspect-auto" src="/storage/{{ $product->thumbnail_url }}" alt="{{ $product->nama }}">
                        <p class="text-left mx-4 w-2/5 md:w-4/5">{{ $product->nama }}</p>
                        <div class="text-sm w-1/2">
                            <span class="text-right w-full block">{{ rupiah($product->harga) }} </span>
                            <span class="float-end"> &times; {{ $item->quantity }} </span>
                        </div>
                    </div>
                </li>
            @endforeach
            </ul>
        </div>
@include('partials.divider-h')
        <div>
            <h1 class="text-xl font-semibold flex justify-between">
                <span>Total Belanja: </span>
                <span>{{ rupiah($sales->total_bayar) }}</span>
            </h1>
        </div>
    </div>
</div>
@endsection
