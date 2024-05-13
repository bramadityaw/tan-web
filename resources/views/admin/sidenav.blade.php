@php
function isSamePath(string $path) : bool {
    return $_SERVER["REQUEST_URI"] === $path;
}
@endphp

<aside class="absolute left-0 top-0 w-0 md:w-1/5 h-screen bg-gray-800 text-white lg:static">
    <div class="w-4/5 mx-auto mt-4 overflow-y-auto">
    @include('partials.icons.logo')
        <nav class="text-xl mt-8">
            <ul>
                <li class="mb-2 {{ isSamePath(admin()) ? 'bg-white text-black pl-3 py-1 rounded-md' : '' }}">
                    <a class="block" href="{{ admin() }}">Beranda</a>
                </li>
                <li class="mb-2 {{ isSamePath(admin('/purchase')) ? 'bg-white text-black pl-3 py-1 rounded-md' : '' }}">
                    <a class="block" href="{{ admin('/purchase') }}">Pembelian</a>
                </li>
                <li class="mb-2 {{ isSamePath(admin('/sales')) ? 'bg-white text-black pl-3 py-1 rounded-md' : '' }}">
                    <a class="block" href="{{ admin('/sales') }}">Penjualan</a>
                </li>
                <li class="mb-2 {{ isSamePath(admin('/products')) ? 'bg-white text-black pl-3 py-1 rounded-md' : '' }}">
                    <a class="block" href="{{ admin('/products') }}">Produk</a>
                </li>
                <li class="mb-2 {{ isSamePath(admin('/blog')) ? 'bg-white text-black pl-3 py-1 rounded-md' : '' }}">
                    <a class="block" href="{{ admin('/blog') }}">Blog</a>
                </li>
           </ul>
        </nav>
    </div>
</aside>
