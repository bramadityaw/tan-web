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
<div class="flex justify-between my-4">
    <h1 class="text-2xl font-semibold">Pembukuan dan Pengelolaan Transaksi</h1>
    <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="transactions/create">
        <svg class="aspect-square w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
            <path d="M6 12H18M12 6V18" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <span class="inline-block mr-2">Buat Transaksi</span>
    </a>
</div>
<section>
    <h2 class="text-lg font-medium">Pembelian</h2>
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
        </tbody>
    </table>
    {{ $purchases->links() }}
</section>
<section>
    <h2 class="text-lg font-medium">Penjualan</h2>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-6">Nama Pelanggan</th>
            <th scope="col" class="py-3 px-6">Isi Keranjang</th>
            <th scope="col" class="py-3 px-6">Total Belanja</th>
            <th scope="col" class="py-3 px-6">Verifikasi</th>
            <th scope="col" class="py-3 px-6">Tanggal Transaksi</th>
        </tr>
        </thead>
        <tbody>

        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="py-4 px-6">Adam Hawa</td>
            <td class="py-4 px-6">
                <a class="rounded-full border border-gray-400 px-3 py-1"
                   href="/user?{user_id}/transaction?{user_id}">Lihat</a>
            </td>
            <td class="py-4 px-6">Rp. 200.000</td>
            <td class="py-4 px-6">
                <img class="aspect-square w-4 float-left" src="/images/green-check.png" alt="Verified">
                Berhasil
            </td>
            <td class="py-4 px-6">2024-04-16</td>
        </tr>
        </tbody>
    </table>
</section>
@endsection
