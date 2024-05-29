<aside class="w-1/2">
    <div class="top-[calc(72px+2.5rem)] sticky">
        <div class="rounded-md bg-white text-black w-full">
            <form action="/blog/search" class="flex m-0">
                <input class="text-base w-full border-0 rounded-l-md pl-2 py-1" value="{{ $query_blog ?? '' }}" name="query" type="text" placeholder="Cari artikel...">
                <button class="px-4" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <h1 class="font-semibold text-lg my-4">Artikel Sorotan</h1>
        @foreach($highlights as $highlight)
        <div class="overflow-y-auto max-h-[60dvh]">
            <a href="{{ route('blog.show', $highlight->slug) }}">
                <div class="rounded-md bg-white text-black mb-4 p-3">
                    <div class="flex gap-4">
                        <h1 class="flex items-center">{{ ucwords($highlight->judul) }}</h1>
                        <img class="max-w-[115px] aspect-auto" src="/storage/images/{{ $highlight->thumbnail_url }}" alt="">
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</aside>
