@extends('layouts.user')

@use('\Illuminate\Support\Facades\Auth')

@section('main')
<div class="w-5/6 md:w-1/2 mx-auto">
<div class="bg-white rounded shadow-lg p-4 md:p-8 my-12">
    <h1 class="text-2xl font-semibold mb-4">Kritik &amp; Saran</h1>
    @if($errors->any())
    {{ $errors }}
    @endif
    <form action="/review" method="post">
    @csrf
    <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 lg:grid-cols-2">
        <div class="lg:col-span-2">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
                <div class="md:col-span-5">
                    <label for="nama_pelanggan">Nama</label>
                    <input type="text"
                    placeholder="Namamu siapa?"
                    name="nama"
                    id="nama_pelanggan" class=
                    "h-10 border mt-1 rounded px-4 w-full {{ Auth::check() ? 'bg-gray-200 text-gray-600' : '' }}"
                    value="{{ Auth::check() ? Auth::user()->name : '' }}" {{ Auth::check() ? 'readonly' : '' }}>
                </div>
                <div class="md:col-span-5">
                    <label for="asal_provinsi">Asal Provinsi</label>
                    <input
                    class="h-10 border mt-1 rounded px-4 w-full"
                    placeholder="Cari provinsi..."
                    list="provinsi" name="asal_provinsi" id="asal_provinsi">
                    <datalist  id="provinsi">
                    </datalist>
                </div>
                <div class="md:col-span-5">
                    <label for="asal_kota">Asal Kota/Kabupaten</label>
                    <input
                    class="h-10 border mt-1 rounded px-4 w-full"
                    placeholder="Cari kota..."
                    list="kota" name="asal_kota" id="asal_kota">
                    <datalist id="kota">
                    </datalist>
                </div>
                <div class="md:col-span-5">
                    <label for="review">Kritik &amp; Saran</label>
                    <textarea
                    class="rounded-l border px-3 py-2 w-full"
                    placeholder="Bagaimana pengalaman Anda belanja di toko kami?"
                    name="review" id="review"
                    cols="30" rows="6"></textarea>
                </div>
            <div class="md:col-span-5 mt-4">
                <button type="submit" class=
                "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded float-end">
                Tambah</button>
              </div>
            </div>
        </div>
        </form>
</div>
@endsection

@section('scripts')
@parent
<script type="module">
const provinces = await get("provinces");
populateList(provinces, "provinsi");

const asalProvinsi = document.querySelector("#asal_provinsi");
asalProvinsi.addEventListener("change", e => populateKota(e.target.value));

async function get(wilayah, noId = null) {
    const url = noId
        ? `https://www.emsifa.com/api-wilayah-indonesia/api/${wilayah}/${noId}.json`
        : `https://www.emsifa.com/api-wilayah-indonesia/api/${wilayah}.json`;

    const result = await fetch(url)
        .then(res => res.json());

    return result;
}

function getIdFromName(areas, areaName) {
    for (let i = 0; i < areas.length; i++) {
        if (areas[i].name === areaName) {
            return areas[i].id;
        }
    }
};

async function populateKota(provinceName) {
    const provinceId = getIdFromName(provinces, provinceName);
    const cities = await get("regencies", provinceId);
    populateList(cities, "kota");
}

function populateList(items, listId) {
    const list = document.querySelector('datalist#' + listId);

    items.forEach( item => {
        const option = document.createElement('option');
        option.textContent = item.name.split(' ')
            .map(i => i.charAt(0) + i.slice(1).toLowerCase())
            .reduce((acc, curr) => acc + ' ' + curr);
        option.value = item.name;
        list.appendChild(option);
    })
}
</script>
@endsection
