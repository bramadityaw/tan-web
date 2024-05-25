@extends('layouts.admin')

@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/blog/">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4"></i>
        <p>Kembali</p>
    </a>
</div>
<div class="bg-white rounded shadow-lg p-4 px-4 md:p-8 mb-12 mx-auto w-fit min-h-[368px]">
    <h1 class="text-2xl font-semibold mb-4">Ubah Artikel</h1>
    <form action="/admin/dashboard/blog/{{ $article->id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-2">
            <div class="lg:col-span-2">
                <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                    <div class="md:col-span-5">
                        <label for="judul_artikel">Judul Artikel</label>
                        <input type="text" name="judul" id="judul_artikel" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50" value="{{ $article->judul }}">
                    </div>
                    <div class="md:col-span-5">
                        <label for="kategori">Kategori</label>
                        <select name="type" id="kategori" class="h-10 border mt-1 rounded px-4 w-full bg-gray-50">
                            <option value="kategori_1" {{ $article->type == 'kategori_1' ? 'selected' : '' }}>Kategori 1</option>
                            <option value="kategori_2" {{ $article->type == 'kategori_2' ? 'selected' : '' }}>Kategori 2</option>
                            <option value="kategori_3" {{ $article->type == 'kategori_3' ? 'selected' : '' }}>Kategori 3</option>
                        </select>
                    </div>
                    <div class="md:col-span-5">
                        <label for="deskripsi">Deskripsi Artikel</label>
                        <textarea class="rounded-l border px-3 py-2 bg-gray-50 w-full" name="konten" id="deskripsi" cols="30" rows="6">{{ $article->konten }}</textarea>
                    </div>
                    <div class="md:col-span-5">
                        <label for="gambar">Gambar artikel</label>
                        <input class="flex items-center rounded-l border w-full bg-gray-50 border-gray-100" type="file" name="thumbnail_url" id="gambar" value="{{ $article->thumbnail_url }}">
                    </div>
                    <div class="md:col-span-5 mt-4">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">Ubah</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
@endpush
