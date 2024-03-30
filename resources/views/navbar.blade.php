<header class="bg-[#1b3c73] sticky top-0 z-10">
    <nav class=" flex px-8 py-5 text-white items-center justify-between">
        @include('partials.logo')
        <div class="rounded-md bg-white text-[#909090] w-full sm:w-[60%] lg:w-[35%]">
            <form action="search" class="flex justify-between">
                <input class="text-base w-full border-0 pl-4 py-3" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
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
            <a href="/login">Masuk</a>
        </div>
    </nav>
</header>

