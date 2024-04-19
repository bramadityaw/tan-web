<aside class="hidden md:block w-1/5 h-[100dvh] bg-gray-800 text-white">
    <div class="w-4/5 mx-auto mt-4">
    @include('partials.icons.logo')
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="{{ admin() }}">Beranda</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('transactions') }}">Kelola Transaksi</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('products') }}">Kelola Produk</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('blog') }}">Kelola Blog</a>
                </li>
                 <li class="mb-2">
                    <a href="{{ admin('users') }}">Kelola Akun</a>
                </li>
           </ul>
        </nav>
    </div>
</aside>
