<header class="bg-[#1b3c73] sticky top-0 z-10">
    <nav class=" flex px-6 py-4 text-white items-center justify-between">
        @include('partials.icons.logo')
        <div class="rounded-md bg-white text-black mx-6 w-1/2 sm:w-[60%] lg:w-[35%]">
            <form action="/toko/search" class="flex m-0">
                <input class="text-base w-full border-0 rounded-l-md pl-2 py-1" name="query" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
                <button class="px-4" type="submit">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
        <div class="hidden w-1/5 lg:flex justify-between max-w-[425px]">
            <a href="/">Beranda</a>
            <a href="/toko">Toko</a>
            <a href="/blog">Blog</a>
        </div>
        @include('toko.cart')
        <div class="">
            @auth
            <div class="cursor-pointer" id="profile">
                <img src="{{ Auth::user()->profile_pic }}" alt="Foto Profil {{ Auth::user()->nama }}" class="h-8 w-8 object-cover rounded-full">
            </div>
            @else
                <a href="/login">Masuk</a>
            @endauth
        </div>
        </nav>
        @auth
        <div class="absolute right-8 bg-white rounded-md text-black px-4 py-2 border-2 border-gray-300 hidden">
            <section>
                <h1> {{ Auth::user()->name }} </h1>
                <span class="text-sm text-gray-500">{{ Auth::user()->email }}</span>
            </section>
            @include('partials.divider-h')
            @if(Auth::user()->is_admin)
            <section>
                <a href="/admin"><h1 class="block">Kelola Website</h1></a>
            </section>
            @endif
            <form action="/logout" method="post">
                @csrf
                <button class="flex items-center justify-between w-full" type="submit">
                    <span>Log Out</span>
                    @include('partials.icons.logout')
                </button>
            </form>
        </div>
        @endauth
</header>

