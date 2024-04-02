<header class="bg-[#1b3c73] sticky top-0 z-10">
    <nav class=" flex px-8 py-5 text-white items-center justify-between">
        @include('partials.logo')
        <div class="rounded-md bg-white text-[#909090] w-full sm:w-[60%] lg:w-[35%]">
            <form action="" class="flex justify-between">
                <input class="text-base w-full border-0 rounded-l-md pl-4 py-3" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
                <button class="px-4" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
        <div class="hidden w-1/5 lg:flex justify-between max-w-[425px]">
            <a href="/">Beranda</a>
            <a href="/toko">Toko</a>
            <a href="/blog">Blog</a>
        </div>
        <div class="">
            @auth
                <img src="{{ Auth::user()->profile_pic }}" alt="Foto Profil {{ Auth::user()->nama }}" class="h-8 w-8 object-cover rounded-full">
            @else
                <a href="/login">Masuk</a>
            @endauth
        </div>
    </nav>
</header>

