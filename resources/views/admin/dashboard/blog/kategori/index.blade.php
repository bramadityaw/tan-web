@extends('layouts.admin')
@section('main')
<div class="flex justify-between mb-4">
    <a class="flex items-center w-fit text-center text-sm md:text-md px-2 py-1" href="/admin/dashboard/blog">
        <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
        <p>Kembali</p>
    </a>
</div>
<div class="w-1/2 mx-auto mb-12">
    <div class="bg-white rounded-md px-3 py-2">
        <section class="flex justify-end">
            <button type="button" onclick="tambahKategori()" class="flex items-center bg-[#1B3C73] rounded-md w-fit font-semibold text-white text-center text-sm md:text-md px-2 py-1">
                <i class="fa-solid fa-plus block text-md mr-4"></i>
                <span class="inline-block mr-2">Tambah</span>
            </button>
        </section>
        <section id="kategori" class="min-h-[35dvh]">
            @forelse($kategori as $k)
            <div class="flex mb-4">
                <input type="text" name="kategori" value="{{ $k->value ?? '' }}" disabled>
                <button data-product-id="{{ $k->id }}" onclick="editKategori(this)" class="rounded-md text-sm px-2 py-1 bg-green-500">
                    <i class="fa-solid fa-pen-to-square"></i>
                    <span>Edit</span>
                </button>
                <button data-product-id="{{ $k->id }}" onclick="deleteKategori(this)" class="rounded-md text-sm px-2 py-1 bg-red-500">
                    <i class="fa-solid fa-trash"></i>
                    <span>Hapus</span>
                </button>
            </div>
            @empty
            <h1 class="text-xl text-center text-gray-400 font-semibold mt-[calc(25dvh-1.5rem)]">Tambahkan kategori <i class="fa-solid fa-arrow-up text-md ml-4"></i> </h1>
            @endforelse
        </section>
    </div>
</div>
@endsection

@push('scripts')
<script>
const kategori = document.querySelector('#kategori');

function tambahKategori() {
    let placeholder = kategori.querySelector('h1');
    const row = document.createElement('div');
    row.classList.add('flex', 'mb-4');
    const field = document.createElement('input');
    field.type = 'text';
    field.name = 'kategori';
    row.appendChild(field);
    const cancelButton = document.createElement('button');

    if (placeholder) {
        placeholder.remove();
    }

    kategori.appendChild(row);
    row.querySelector('input[name="kategori"]').focus();
}

document.addEventListener("click", e => {
    let placeholder = kategori.querySelector('h1');
    if (!placeholder) {
        let input = kategori.children[0].querySelector('input');
        if (document.activeElement !== input) {
            input.parentNode.remove();
            kategori.appendChild(createPlaceholder());
        }
    }
});

function createPlaceholder() {
    const placeholder = document.createElement('h1');
    placeholder.innerHTML = "Tambahkan kategori <i class=\"fa-solid fa-arrow-up text-md ml-4\">";
    placeholder.classList.add("text-xl", "text-center", "text-gray-400", "font-semibold", "mt-[calc(25dvh-1.5rem)]");
    return placeholder;
}

function cancel(button) {
    button.parentNode.remove();
}
</script>
@endpush
