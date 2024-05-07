<aside class="absolute left-0 top-0 w-0 md:w-1/5 h-screen bg-gray-800 text-white lg:static">
    <div class="w-4/5 mx-auto mt-4 overflow-y-auto">
    @include('partials.icons.logo')
        <nav>
            <ul>
                <li class="mb-2">
                    <a href="{{ admin() }}">Beranda</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('purchase') }}">Pembelian</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('sales') }}">Penjualan</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('products') }}">Produk</a>
                </li>
                <li class="mb-2">
                    <a href="{{ admin('blog') }}">Blog</a>
                </li>
           </ul>
        </nav>
    </div>
</aside>
