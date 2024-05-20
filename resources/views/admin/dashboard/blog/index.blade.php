@extends('layouts.admin')

@section('main')
<section>
    <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Artikel</h1>
        <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/blog/create">
            <i class="fa-solid fa-plus block text-md mr-4"></i>
            <span class="inline-block mr-2">Tambah</span>
        </a>
    </div>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-6">Judul Artikel</th>
                <th scope="col" class="py-3 px-6">Gambar</th>
                <th scope="col" class="py-3 px-6">Kategori</th>
                <th scope="col" class="py-3 px-6">Tanggal Publish</th>
                <th scope="col" class="py-3 px-6">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if($articles->isNotEmpty())
                @foreach($articles as $article)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="py-4 px-6">{{ $article->judul_artikel }}</td>
                    <td class="py-4 px-6">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->judul_artikel }}" class="max-w-[192px] aspect-auto">
                    </td>
                    <td class="py-4 px-6">{{ $article->kategori }}</td>
                    <td class="py-4 px-6">{{ $article->created_at }}</td>
                    <td class="py-4 px-6 text-white text-center">
                        <a href="/admin/dashboard/blog/{{ $article->id }}/edit" class="inline-block w-fit rounded-md px-3 py-2 bg-green-500">
                            <i class="fa-solid fa-pen-to-square"></i>
                            <span>Ubah</span>
                        </a>
                        <button data-article-id="{{ $article->id }}" onclick="deleteArticle(this)" class="rounded-md px-3 py-2 bg-red-500">
                            <i class="fa-solid fa-trash"></i>
                            <span>Hapus</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            @else
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4" colspan="5">
                    <h1 class="text-xl text-center text-gray-400 font-semibold py-12">Belum ada apa-apa di sini...</h1>
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md mx-auto px-2 py-1" href="/admin/dashboard/blog/create">
                        <i class="fa-solid fa-plus block text-md mr-4"></i>
                        <span class="inline-block mr-2">Tambah</span>
                    </a>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    {{ $articles->links() }}
</section>
<dialog id="deleteDialog" class="border border-[#1B3C73] rounded-md p-4 w-4/5 md:w-1/6">
    <div class="text-center">
        <button class="float-end" type="button" onclick="deleteDialog.close()">
            <i class="fa-solid fa-times text-lg"></i>
        </button>
        <p>Hapus artikel?</p>
        <img class="aspect-auto w-2/3 mx-auto my-4" src="{{ asset('/images/question.png') }}" alt="Tanda Tanya">
        <div class="flex flex-row justify-around text-white">
            <form method="dialog">
                <button type="submit" class="rounded-md px-3 py-2 bg-blue-500">Batal</button>
            </form>
            <button id="confirmDeleteButton" type="button" class="rounded-md px-3 py-2 bg-red-500">Hapus</button>
        </div>
    </div>
</dialog>
@endsection

@push('scripts')
<script>
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const deleteDialog = document.querySelector("#deleteDialog");
    const confirmDeleteButton = document.querySelector("#confirmDeleteButton");

    let articleToDelete = null;

    function deleteArticle(button) {
        articleToDelete = button;
        deleteDialog.showModal();
    }

    confirmDeleteButton.addEventListener("click", function() {
        const articleId = articleToDelete.dataset.articleId;
        const uri = `/admin/dashboard/blog/${articleId}`;

        fetch(uri, {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
        }).then(response => {
            if (response.ok) {
                deleteDialog.close();
                location.reload();
            } else {
                alert('Gagal menghapus artikel.');
            }
        });
    });
</script>
@endpush
