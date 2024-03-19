@include('head')
@include('navbar')
<main class="bg-[#1b3c73] py-16">
    <div class="w-1/2 mx-auto p-4 bg-white rounded-md">
        <img class="aspect-auto w-2/3 mx-auto my-2" src="images/404-goldfish.png">
        <h1 class="text-black text-2xl text-center my-2">Halaman tidak tersedia</h1>
        <div class="mx-auto">
            <a class="rounded-md bg-[#1b3c73] p-2 text-lg" href="/toko">Kembali belanja</a>
            <a class="rounded-md border-gray-400 border-2 p-2 text-lg text-black" href="/blog">Baca artikel</a>
        </div>
    </div>
</main>
@include('footer')
