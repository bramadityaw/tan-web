@use('Illuminate\Support\Str')
@extends('layouts.blog')

@section('main')
    @foreach($articles as $article)
    <div class="rounded-md bg-white text-black mb-4">
        <article class="px-6 py-5">
            @php $kategori = \App\Models\Kategori::find($article->kategori_id); @endphp
            <a href="{{ route('blog.show', $article->slug) }}">
                <h1 class="text-xl font-semibold">{{ ucwords($article->judul) }}</h1>
            </a>
            <div class="flex gap-4 my-2">
                <span class="flex gap-2 items-center">
                    <i class="fa-solid fa-clock"></i>
                    <span>{{ tanggalIdn($article->created_at, 'j F, o' ) }}</span>
                </span>
                <a href="/blog/topik/{{ $kategori->slug }}">{{ ucwords($kategori->value) }}</a>
                @if(! \Carbon\Carbon::parse($article->created_at)
                    ->isSameAs('Y-m-d H:i:s', \Carbon\Carbon::parse($article->updated_at)))
                <span class="ml-4">Diperbarui {{ tanggalIdn($article->updated_at, 'j F, o') }}</span>
                @endif
            </div>
            <section class="flex max-h-[6rem]">
                <p class="text-ellipsis mr-4 h-fit">{{ Str::limit($article->konten, 260) }}</p>
                <img class="max-w-[115px] aspect-auto" src="/storage/images/{{ $article->thumbnail_url }}" alt="">
            </section>
        </article>
    </div>
    @endforeach
    {{ $articles->links() }}
@endsection
