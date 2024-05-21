@extends('layouts.admin')

@php
$purchase_sum = 0;

foreach ($purchases as $purchase) {
    $purchase_sum += $purchase->harga_beli * $purchase->qty;
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
                <td class="py-4 px-6">{{ tanggalIdn($purchase->created_at, 'l, j F o, G:i')}}</td>
                <td class="py-4 px-6">{{ $purchase->nama_barang }}</td>
                <td class="py-4 px-6">{{ rupiah($purchase->harga_beli) }}</td>
                <td class="py-4 px-6">{{ $purchase->qty }}</td>
                <td class="py-4 px-6">
                    <span>{{ rupiah($purchase->harga_beli * $purchase->qty) }}</span>
                    <button data-purchase-id="{{ $purchase->id }}" onclick="window.purchase = this; deletePurchase(window.purchase)" class="float-end" type="button">
                        <i class="fa-solid fa-trash text-gray-600"></i>
                        <span class="text-sm">Hapus</span>
                    </button>
                </td>
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
<dialog id="deleteDialog" class="border border-[#1B3C73] rounded-md p-4 w-4/5 md:w-1/6">
    <div class="text-center">
        <button class="float-end" type="button" onclick="deleteDialog.close()">
            <i class="fa-solid fa-times text-lg"></i>
        </button>
        <p>Hapus pembelian dari pembukuan?</p>
        <img class="aspect-auto w-2/3 mx-auto my-4" src="{{ asset('/images/question.png') }}" alt="Tanda Tanya">
        <div class="flex flex-row justify-around text-white">
            <form method="dialog">
                <button type="submit" class="rounded-md px-3 py-2 bg-blue-500">Batal</button>
            </form>
            <button type="button" class="rounded-md px-3 py-2 bg-red-500">Hapus</button>
        </div>
    </div>
</dialog>
@endsection

@push('scripts')
<script>
const token = document.querySelector('input[name="_token"]').value;
const deleteDialog = document.querySelector("#deleteDialog");
const deleteButton = deleteDialog.querySelector('form[method="dialog"] + button[type="button"]');

function deletePurchase(purchase) {
    deleteDialog.showModal();
    const purchaseId = purchase.dataset.purchaseId;
    const uri = `/purchase/${purchaseId}`;

    const form = new FormData;
    form.append('_token', token);

    deleteButton.addEventListener("click", e => {
        fetch(uri, {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'multipart/form-data',
            },
            body: form,
    })
        .catch(e => console.error(e));
        deleteDialog.close();
        location.reload();
    });
}
</script>
@endpush
