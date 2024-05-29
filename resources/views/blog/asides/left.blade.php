<aside class="w-1/4 top-0 sticky">
    <div class="border-r border-gray-400">
        <h1 class="text-xl font-semibold mb-4">Topik</h1>
        <ul class="max-w-[132px]">
            <li class="flex items-center {{ url()->full() === route('blog') ? 'font-semibold gap-2' : '' }}">
                @if(url()->current() === route('blog'))
                <div class="relative border border-white rounded-full p-1 w-3 h-3 bg-white"></div>
                @endif
                <a href="{{ route('blog') }}">Semua</a>
                <span class="ml-2">({{ $articles->count() }})</span>
            </li>
            @foreach($categories as $category)
            <li class="flex items-center {{ (route('blog.category')
                . '?kategori=' . urlencode($category->value))
                === url()->full() ? 'font-semibold gap-2' : '' }}">
                @if( (route('blog.category')
                    . '?kategori=' . urlencode($category->value))
                    === url()->full() )
                <div class="relative border border-white rounded-full p-1 w-3 h-3 bg-white"></div>
                @endif
                <a class="truncate" href="{{ route('blog.category') . '/?kategori=' . urlencode($category->value) }}">
                    <span>{{ ucwords($category->value) }}</span>
                </a>
                <span class="ml-2">({{ $category->count }})</span>
            </li>
            @endforeach
        </ul>
    </div>
</aside>
