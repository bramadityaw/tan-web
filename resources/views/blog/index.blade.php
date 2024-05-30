@use('Illuminate\Support\Str')
@extends('layouts.blog')

@section('main')
    <div class="flex items-center my-4 lg:hidden lg:m-0">
        <label for="topik" class="text-lg font-semibold">Topik</label>
        <select oninput="goToCategory(this.value)" class="px-2 py-1 text-black bg-white rounded-md ml-4 w-full" id="topik">
            <option {{ url()->current() === route('blog') ? 'selected' : '' }} value="semua">Semua Artikel ({{ $count }})</option>
            @foreach($categories as $category)
            <option {{ route('blog.category', $category->slug) === url()->current() ? 'selected' : '' }}
                value="{{ $category->value }}">
                {{ $category->value }} ({{ $category->count }})
            </option>
            @endforeach
        </select>
        <div class="hidden sm:block ml-4 rounded-md bg-white text-black w-full">
           <form action="/blog/search" class="flex m-0">
               <input class="text-base w-full border-0 rounded-l-md pl-2 py-1" value="{{ $query_blog ?? '' }}" name="query" type="text" placeholder="Cari artikel...">
               <button class="px-4" type="submit">
                   <i class="fa-solid fa-magnifying-glass"></i>
               </button>
           </form>
       </div>
    </div>
    @foreach($articles as $article)
    <div class="rounded-md bg-white text-black mb-4">
        <article class="px-6 py-5">
            @php $kategori = \App\Models\Kategori::find($article->kategori_id); @endphp
            <a href="{{ route('blog.show', $article->slug) }}">
                <h1 class="text-xl font-semibold">{{ ucwords($article->judul) }}</h1>
            </a>
            <div class="md:flex md:gap-4 my-2">
                <span class="flex gap-2 items-center">
                    <i class="fa-solid fa-clock"></i>
                    <span>{{ tanggalIdn($article->created_at, 'j F, o' ) }}</span>
                </span>
                @if(! \Carbon\Carbon::parse($article->created_at)
                    ->isSameAs('Y-m-d H:i:s', \Carbon\Carbon::parse($article->updated_at)))
                <span>Diperbarui {{ tanggalIdn($article->updated_at, 'j F, o') }}</span>
                @endif
                <a href="/blog/topik/{{ $kategori->slug }}">{{ ucwords($kategori->value) }}</a>
            </div>
            <section class="md:flex xl:max-h-[6rem]">
                <img class="mx-auto my-2 md:max-w-[115px] max-h-[6rem] aspect-auto" src="/storage/images/{{ $article->thumbnail_url }}" alt="">
                <div>
                    <p class="md:ml-4">{{ Str::limit($article->konten, 200) }}</p>
                    <p class="text-right mt-2 md:m-0">
                        <a href="route('article.show', $article->slug)" class="mt-2 underline text-blue-500">Baca selengkapnya...</a>
                    </p>
                </div>
            </section>
        </article>
    </div>
    @endforeach
    <div class="mb-6 md:m-0">
        {{ $articles->links() }}
    </div>
@endsection

@section('scripts')
@parent
<script>
function goToCategory(category) {
    let url = '/blog/';

    if (category !== 'semua') {
        url = url + 'topik/' + category;
    }

    history.pushState({}, "", url);
    window.location.replace(url);
}
</script>
@endsection
