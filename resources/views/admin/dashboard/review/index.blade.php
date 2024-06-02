@extends('layouts.admin')
@section('main')

<section>
    <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Review</h1>
        <a class="flex items-center w-fit bg-[#1B3C73] rounded-md text-white text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/">
            <i class="fa-solid fa-arrow-left rounded-full p-1 mr-4 "></i>
            <p>Kembali ke dashboard</p>
        </a>
    </div>
    <div class="w-full relative flex flex-col flex-1">
    <div class="relative overflow-y-auto">
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-6">Nama Pelanggan</th>
            <th scope="col" class="py-3 px-6">Asal</th>
            <th scope="col" class="py-3 px-6">Review</th>
        </tr>
        </thead>
        <tbody>
        @forelse($reviews as $review)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">{{ $review->nama_pelanggan }}</td>
                <td class="py-4 px-6">{{ allCapsToCapCase($review->asal_kota) }}, {{ allCapsToCapCase($review->asal_provinsi)}}</td>
                <td class="py-4 px-6">
                    <a class="rounded-full border border-gray-400 px-3 py-1"
                       href="{{ route('review.show', $review->id) }}">Lihat</a>
                </td>
            </tr>
        @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4" colspan="5">
                    <h1 class="text-xl text-center text-gray-400 font-semibold py-12">Belum ada apa-apa di sini...</h1>
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
    </div>
    </div>
    {{ $reviews->links() }}
</section>
<dialog id="deleteDialog" class="border border-[#1B3C73] rounded-md p-4 w-4/5 md:w-1/6">
    <div class="text-center">
        <button class="float-end" type="button" onclick="deleteDialog.close()">
            <i class="fa-solid fa-times text-lg"></i>
        </button>
        <p>Hapus produk?</p>
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

function deleteProduct(produk) {
    deleteDialog.showModal();
    const produkId = produk.dataset.productId;
    const uri = `/product/${produkId}`;

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
        });
        deleteDialog.close();
        location.reload();
    });
}
</script>
@endpush
