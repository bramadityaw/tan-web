@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/blog/">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="w-5/6 sm:w-3/5 md:w-1/2 mx-auto">
    <div class="bg-white px-5 py-4 rounded-md mb-4">
        <div class="w-full">
            <div class="flex">
                <div class="mr-4">
                    <h1 class="flex justify-between">Judul: <span class="ml-5 font-bold text-lg">{{ $article->judul }}</span></h1>
                    <p class="flex justify-between">Kategori: <span >{{ \App\Models\Kategori::find($article->kategori_id)->value }}</span></p>
                </div>
                <img class="max-h-[128px] aspect-auto" src="/storage/images/{{ $article->thumbnail_url }}" alt="{{ $article->judul }}">
            </div>
            <p class="mt-1">Konten:</p>
            <textarea class="rounded-md text-sm px-3 py-2 w-full" cols="30" rows="10" disabled>{{ trim($article->konten) }}</textarea>
        </div>
    </div>
</div>
@endsection
