@extends('layouts.admin')

@php
$purchase_sum = 0;

foreach ($purchases as $purchase) {
    $purchase_sum += $purchase->harga_beli * $purchase->qty;
}

function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
@endphp

@section('main')
<section>
    <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Pembelian</h1>
        <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/purchase/create">
            <i class="fa-solid fa-plus block text-md mr-4"></i>
            <span class="inline-block mr-2">Catat</span>
        </a>
    </div>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-6">Tanggal Transaksi</th>
            <th scope="col" class="py-3 px-6">Nama Barang</th>
            <th scope="col" class="py-3 px-6">Harga Satuan</th>
            <th scope="col" class="py-3 px-6">Qty</th>
            <th scope="col" class="py-3 px-6">Total Belanja</th>
        </tr>
        </thead>
        <tbody>
        @if($purchases->isNotEmpty())
        @foreach($purchases as $purchase)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">{{ (explode(' ', $purchase->created_at)[0]) }}</td>
                <td class="py-4 px-6">{{ $purchase->nama_barang }}</td>
                <td class="py-4 px-6">{{ rupiah($purchase->harga_beli) }}</td>
                <td class="py-4 px-6">{{ $purchase->qty }}</td>
                <td class="py-4 px-6">{{ rupiah($purchase->harga_beli * $purchase->qty) }}</td>
            </tr>
        @endforeach
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td colspan="4" class="py-4 px-12">Total Pembelian</td>
                <td class="py-4 px-6">{{ rupiah($purchase_sum) }}</td>
            </tr>
        @else
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4" colspan="5">
                    <h1 class="text-xl text-center text-gray-400 font-semibold py-12">Belum ada apa-apa di sini...</h1>
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md mx-auto px-2 py-1" href="/admin/dashboard/purchase/create">
                        <i class="fa-solid fa-plus block text-md mr-4"></i>
                        <span class="inline-block mr-2">Catat</span>
                    </a>
                </td>
            </tr>
        @endif
        </tbody>
    </table>
    {{ $purchases->links() }}
</section>
@endsection
