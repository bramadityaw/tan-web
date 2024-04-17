<header class="bg-[#1b3c73] sticky top-0 z-10">
    <nav class=" flex px-6 py-4 text-white items-center justify-between">
        @include('partials.icons.logo')
        <div class="rounded-md bg-white text-[#909090] mx-2 w-full sm:w-[60%] lg:w-[35%]">
            <form action="" class="flex m-0">
                <input class="text-base w-full border-0 rounded-l-md pl-2 py-1" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
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
            <div class="flex">
                <div class="">
                    <p> {{ Auth::user()->name }} </p>
                    <span class="text-sm text-gray-500">{{ Auth::user()->email }}</span>
                </div>
            </div>
            @include('partials.divider-h')
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

