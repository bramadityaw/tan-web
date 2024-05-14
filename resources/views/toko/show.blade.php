@extends('layouts.user')
@section('main')

<div class="rounded-md lg:flex">
<img src="/storage/{{ $product->thumbnail_url }}" alt="{{ $product->nama }}" class="w-1/2">
</div>

<h1>{{ $product->nama }}</h1>
<p>{{ $product->deskripsi }}</p>
@endsection
