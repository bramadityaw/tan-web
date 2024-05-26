@extends('layouts.admin')

@section('main')
<section>
    <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Artikel</h1>
        <span class="flex gap-4">
            <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="{{ route('kategori.index') }}">
                <i class="fa-solid fa-cog block text-md mr-4"></i>
                <span class="inline-block mr-2">Atur Kategori</span>
            </a>
            <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="{{ route('article.create') }}">
                <i class="fa-solid fa-plus block text-md mr-4"></i>
                <span class="inline-block mr-2">Tambah</span>
            </a>
        </span>
    </div>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-6">Judul Artikel</th>
                <th scope="col" class="py-3 px-6">Kategori</th>
                <th scope="col" class="py-3 px-6">Detail</th>
                <th scope="col" class="py-3 px-6">Tanggal Publish</th>
                <th scope="col" class="py-3 px-7 flex justify-center items-center h-full text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6">{{ $article->judul }}</td>
                <td class="py-4 px-6">{{ \App\Models\Kategori::find($article->kategori_id)->value }}</td>
                <td class="py-4 px-6">
                    <a class="rounded-xl border border-gray-700 px-2 py-1" href="{{ route('article.show', $article) }}">Lihat</a>
                </td>
                <td class="py-4 px-6">{{ tanggalIdn($article->created_at, 'l, j F o') }}</td>
                <td class="py-4 px-6 text-white text-center">
                    <a href="{{ route('article.edit', $article->id) }}" class="inline-block w-fit rounded-md px-3 py-2 bg-green-500">
                        <i class="fa-solid fa-pen-to-square"></i>
                        <span>Ubah</span>
                    </a>
                    <button data-article-id="{{ $article->id }}" onclick="deleteArticle(this)" class="rounded-md px-3 py-2 bg-red-500">
                        <i class="fa-solid fa-trash"></i>
                        <span>Hapus</span>
                    </button>
                </td>
            </tr>
            @empty
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4" colspan="6">
                    <h1 class="text-xl text-center text-gray-400 font-semibold py-12">Belum ada apa-apa di sini...</h1>
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md mx-auto px-2 py-1" href="{{ route('article.create') }}">
                        <i class="fa-solid fa-plus block text-md mr-4"></i>
                        <span class="inline-block mr-2">Tambah</span>
                    </a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
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
            {{-- <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE') --}}
                <button id="confirmDeleteButton" type="button" class="rounded-md px-3 py-2 bg-red-500">Hapus</button>
            {{-- </form> --}}
        </div>
    </div>
</dialog>
@endsection

@push('scripts')
<script>
const token = document.querySelector('input[name="_token"]').value;
const deleteDialog = document.querySelector("#deleteDialog");
const confirmDeleteButton = deleteDialog.querySelector('#confirmDeleteButton');
let articleIdToDelete = null;

function deleteArticle(button) {
    articleIdToDelete = button.dataset.articleId;
    deleteDialog.showModal();
}

confirmDeleteButton.addEventListener("click", function (e) {
    e.preventDefault();
    const form = new FormData();
    form.append('_token', token);

    if (articleIdToDelete) {
        const uri = `/article/${articleIdToDelete}`;
        fetch(uri, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
            body: form,
        })
        deleteDialog.close();
        location.reload();
    }
});
</script>
@endpush
