<header>
    <nav class="flex justify-between px-6 py-4">
        <div>
            @include('partials.icons.bars')
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
