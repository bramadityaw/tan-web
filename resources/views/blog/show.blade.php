@extends('layouts.blog')
@push('head-styles')
<style>
    article ol {
        list-style: decimal;
        margin-left: 1rem;
    }

    article ol li {
        padding-left: 1rem;
    }

    article h2 {
        font-size: 1.25rem/* 18px */;
        font-weight: 500;
        line-height: 1.75rem/* 28px */;
        margin-bottom: 1rem;
        margin-top: 1rem;
    }

    article h3 {
        font-size: 1.125rem/* 18px */;
        font-weight: 500;
        line-height: 1.75rem/* 28px */;
        margin-bottom: .5rem;
        margin-top: .5rem;
    }

</style>
@endpush
@section('main')
    <div class="rounded-md bg-white text-black mb-4">
        <div class="px-4 py-3">
            <div class="flex gap-2 text-sm">
                <a class="underline text-orange-600 hover:text-orange-400" href="{{ route('blog') }}">Blog</a>
                <span>>></span>
                <a class="underline text-orange-600 hover:text-orange-400" href="{{ route('blog.category', \App\Models\Kategori::find($article->kategori_id)->slug) }}">{{ ucwords(\App\Models\Kategori::find($article->kategori_id)->value) }}</a>
                <span>>></span>
                <a class="underline text-orange-600 hover:text-orange-400" href="{{ route('blog.show', $article->slug) }}">{{ ucwords($article->judul) }}</a>
            </div>
            <article>
                <h1 class="text-2xl font-semibold my-4">{{ $article->judul }}</h1>
                <img class="w-2/3 aspect-auto mx-auto" src="/storage/images/{{ $article->thumbnail_url }}" alt="">
                <div class="my-4">
                    {!! $konten !!}
                </div>
            </article>
            <div class="pt-4">
                <h1 class="text-xl font-semibold my-4">Artikel Terkait</h1>
                @foreach($highlights as $highlight)
                <div class="overflow-y-auto max-h-[60dvh]">
                    <a href="{{ route('blog.show', $highlight->slug) }}">
                        <div class="border-b border-gray-400 bg-white text-black mb-2 p-3">
                            <div class="flex gap-4">
                                <img width="64" height="40" class="aspect-auto" src="/storage/images/{{ $highlight->thumbnail_url }}" alt="">
                                <h1 class="flex items-center">{{ ucwords($highlight->judul) }}</h1>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
