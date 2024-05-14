<header>
    <nav class="flex justify-between px-6 py-4">
        <button class="hidden md:inline-block opacity-70 hover:opacity-100 duration-300" onclick="toggleSideNav()" type="button">
            <i class="text-lg fa-solid fa-bars"></i>
        </button>
        <div class="flex items-center md:hidden">
            <button class="text-4xl font-bold opacity-70 hover:opacity-100 duration-300"
                onclick="toggleMobileMenu()">
                <i class="text-lg fa-solid fa-bars"></i>
            </button>
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
        <div class="absolute right-8 bg-white rounded-md text-black px-4 py-2 border-2 border-gray-300 z-30 hidden">
            <div class="flex">
                <div class="">
                    <p> {{ Auth::user()->name }} </p>
                    <span class="text-sm text-gray-500">{{ Auth::user()->email }}</span>
                </div>
            </div>
            @include('partials.divider-h')
            <section>
                <a href="/"><h1 class="block">Lihat Website</h1></a>
            </section>
            <form action="/logout" method="post">
                @csrf
                <button class="flex items-center justify-between w-full" type="submit">
                    <span>Log Out</span>
                    @include('partials.icons.logout')
                </button>
            </form>
        </div>
        @endauth
    </nav>
</header>

<div id="mobileMenu" class="fixed z-50 hidden bg-gray-800 py-8">
    <div onclick="toggleMobileMenu()" class="backdrop fixed inset-0 bg-gray-800 z-40 opacity-25"></div>
    <div class="w-4/5 text-white text-lg mx-auto mt-4 relative top-0 z-50">
        <div class="flex items-start">
            <button type="button" class="mr-4" onclick="toggleMobileMenu()"><i class="text-lg text-white fa-solid fa-times"></i></button>
            <nav>
                 <ul>
                    <li class="mb-2">
                        <a class="block" href="{{ admin() }}">Beranda</a>
                    </li>
                    <li class="mb-2">
                        <a class="block" href="{{ admin('/purchase') }}">Pembelian</a>
                    </li>
                    <li class="mb-2">
                        <a class="block" href="{{ admin('/sales') }}">Penjualan</a>
                    </li>
                    <li class="mb-2">
                        <a class="block" href="{{ admin('/products') }}">Produk</a>
                    </li>
                    <li class="mb-2">
                        <a class="block" href="{{ admin('/blog') }}">Blog</a>
                    </li>
               </ul>
           </nav>
        </div>
    </div>
</div>

@push('scripts')
<script>
const sidenav = document.querySelector('aside');

let sidenavOpen = true;

function toggleSideNav () {
    if (sidenavOpen) {
        sidenav.style.width = '0';
    } else {
        sidenav.style.width = '20%';
    }
    sidenavOpen = !sidenavOpen;
}

const mobileMenu = document.querySelector('#mobileMenu');

function toggleMobileMenu() {
    mobileMenu.classList.toggle('hidden');
    mobileMenu.classList.toggle('w-full');
}
</script>
@endpush
