@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="{{ url()->previous() }}">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="w-5/6 sm:w-3/5 md:w-1/2 mx-auto">
    <div class="bg-white px-5 py-4 rounded-md mb-4">
        <p class="flex justify-between">Nama Pelanggan: <span>{{ $review->nama_pelanggan }}</span></p>
        <p class="flex justify-between">Asal: <span>{{ allCapsToCapCase($review->asal_kota) }}, {{ allCapsToCapCase($review->asal_provinsi)}}</span></p>
        <p>Kritik &amp; Saran:</p>
        <p>{{ $review->review }}</p>
    </div>
</div>
@endsection
