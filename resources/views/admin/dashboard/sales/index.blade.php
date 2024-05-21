@extends('layouts.admin')

@section('main')
<section>
     <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Penjualan</h1>
        <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/sales/create">
            <svg class="aspect-square w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none">
                <path d="M6 12H18M12 6V18" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="inline-block mr-2">Catat</span>
        </a>
    </div>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-6">Tanggal Transaksi</th>
            <th scope="col" class="py-3 px-6">Nama Pelanggan</th>
            <th scope="col" class="py-3 px-6">Isi Keranjang</th>
            <th scope="col" class="py-3 px-6">Total Belanja</th>
        </tr>
        </thead>
        <tbody>
        @if($sales->isNotEmpty())
        @foreach($sales as $sale)
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="py-4 px-6">{{ $sale->created_at }}</td>
            <td class="py-4 px-6">{{ \App\Models\User::find($sale->user_id)->name }}</td>
            <td class="py-4 px-6">
                <a class="rounded-full border border-gray-400 px-3 py-1"
                   href="/user?{user_id}/transaction?{user_id}">Lihat</a>
            </td>
            <td class="py-4 px-6">{{ rupiah($sale->total_bayar) }}</td>
        </tr>
        @endforeach
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
    {{ $sales->links() }}
</section>
@endsection
