@use(App\Models\Cart)

<header class="bg-[#1b3c73] sticky top-0 z-10">
    <nav class=" flex px-6 py-4 text-white items-center justify-between">
        @include('partials.icons.logo')
        <div class="rounded-md bg-white text-black mx-6 w-1/2 sm:w-[60%] lg:w-[35%]">
            <form action="/toko/search" class="flex m-0">
                <input class="text-base w-full border-0 rounded-l-md pl-2 py-1" value="{{ $query ?? '' }}" name="query" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
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
        @auth
        <a href="/cart">
        @else
        <a href="/login">
        @endauth
            <div class="rounded-full px-2 py-1 mr-4 md:mr-0 text-lg text-gray-500 hover:text-gray-800 bg-white hover:bg-gray-300">
                <div class="pt-1 pr-1">
                     <i class="fa-solid fa-cart-shopping"></i>
                </div>
                <span class="absolute ml-[1.25rem] mt-[-.75rem] rounded-full px-1 text-xs text-white bg-orange-600">{{ Auth::check() ? Cart::count() : 0 }}</span>
            </div>
        </a>
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

