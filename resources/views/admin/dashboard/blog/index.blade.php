@extends('layouts.admin')

@section('main')
<section>
    <div class="flex justify-between my-4">
        <h1 class="text-2xl font-semibold">Artikel</h1>
        <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="{{ route('blog.create') }}">
            <i class="fa-solid fa-plus block text-md mr-4"></i>
            <span class="inline-block mr-2">Tambah</span>
        </a>
    </div>
    <table class="w-full text-sm text-left my-4">
        <thead class="text-xs uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-6">Judul Artikel</th>
                <th scope="col" class="py-3 px-6 flex justify-center items-center h-full text-center">Gambar</th>
                <th scope="col" class="py-3 px-6">Konten</th>
                <th scope="col" class="py-3 px-6">Kategori</th>
                <th scope="col" class="py-3 px-6">Tanggal Publish</th>
                <th scope="col" class="py-3 px-7 flex justify-center items-center h-full text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <td class="py-4 px-6 text-white">{{ $article->judul }}</td>
                <td>
                    @if($article->thumbnail_url)
                    <img src="{{ asset('images1/'. $article->thumbnail_url) }}" alt="image" width="50px">
                    @else
                    No Image Available
                    @endif
                </td>
                <td class="py-4 px-6 text-white">{{ $article->konten }}</td>
                <td class="py-4 px-6 text-white">{{ $article->type }}</td>
                <td class="py-4 px-6 text-white">{{ $article->created_at }}</td>
                <td class="py-4 px-6 text-white text-center">
                    <a href="{{ route('blog.edit', $article->id) }}" class="inline-block w-fit rounded-md px-3 py-2 bg-green-500">
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
                <td class="py-4" colspan="5">
                    <h1 class="text-xl text-center text-gray-400 font-semibold py-12">Belum ada apa-apa di sini...</h1>
                    <a class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md mx-auto px-2 py-1" href="{{ route('blog.create') }}">
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
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button id="confirmDeleteButton" type="submit" class="rounded-md px-3 py-2 bg-red-500">Hapus</button>
            </form>
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
    if (articleIdToDelete) {
        const uri = `/admin/dashboard/blog/${articleIdToDelete}`;
        fetch(uri, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token,
                'Content-Type': 'application/json',
            },
        })
        .then(response => {
            if (response.ok) {
                deleteDialog.close();
                location.reload();
            } else {
                console.error('Error deleting article');
            }
        })
        .catch(e => console.error(e));
    }
});
</script>
@endpush
