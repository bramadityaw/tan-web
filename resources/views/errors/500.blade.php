@php
    function isAdmin() {
        return Auth::check() && Auth::user()->is_admin;
    }
@endphp

@extends('layouts.' . (isAdmin() ? 'admin' : 'user'))

@section('main')
<section class="{{ isAdmin() ? '' : 'bg-[#1b3c73]' }} py-16">
    <div class="w-4/5 md:w-1/2 lg:w-1/3 mx-auto">
        <div class="m-4 p-4 bg-white rounded-md">
            <h1 class="text-black text-2xl text-center my-4">Orang ini bikin website ngawur!</h1>
            <img class="aspect-auto rounded-full mx-auto my-2" src="/images/500_raspb.jpeg">
            <p class="my-4 text-center">Marahin dia lewat email <a class="text-blue-500 underline" href="mailto:@rbramadityaario@gmail.com">@rbramadityaario@gmail.com</a></p>
            @if (isAdmin())
            <div class="text-center lg:flex lg:justify-center">
                <a class="block rounded-md bg-[#1b3c73] mb-4 lg:mb-0 lg:mr-4 lg:w-2/5 p-2 text-lg text-white" href="/admin/dashboard">Kembali ke dashboard</a>
            </div>

            @else
            <div class="text-center lg:flex lg:justify-center">
                <a class="block rounded-md bg-[#1b3c73] mb-4 lg:mb-0 lg:mr-4 lg:w-2/5 p-2 text-lg text-white" href="/toko">Kembali belanja</a>
                <a class="block rounded-md border-gray-400 border-2 p-2 lg:w-2/5 text-lg text-black" href="/blog">Baca artikel</a>
            </div>
            <div class="rounded-md border-2 border-gray-300 bg-white text-[#909090] w-5/6 mt-4 mx-auto">
                <form action="/toko/search" class="flex justify-between">
                    <input class="rounded-l-md text-base w-full border-0 pl-4 py-3" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
                    <button class="px-4" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
