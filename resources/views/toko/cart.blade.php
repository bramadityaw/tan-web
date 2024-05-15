@php
function rupiah(int $amount) : string {
    return 'Rp.' . number_format($amount,2, ',' , '.');
}
@endphp

@extends('layouts.user')

@section('main')
<section class="bg-[#1B3C73] py-8">
    <div class="w-5/6 md:w-full max-w-[520px] mx-auto">
        <div class="rounded-md bg-white">
            <div class="px-6 pt-5 pb-1">
            @foreach ($contents as $content)
                <div class="flex mb-4">
                    <a class="block w-full" href="/toko/produk/{{ $content->product->id }}">
                        <img class="w-full max-w-[192px] aspect-auto" src="/storage/{{ $content->product->thumbnail_url }}" alt="{{ $content->product->nama }}">
                    </a>
                    <div class="ml-4 md:m-0 md:flex">
                        <a class="mr-4 md:mr-8" href="/toko/produk/{{ $content->product->id }}">
                            <h1>{{ $content->product->nama }}</h1>
                            <p class="text-sm">{{ rupiah($content->product->harga) }}</p>
                        </a>
                        <div data-id="{{ $content->cart }}" class="flex min-w-[135px] w-full text-sm items-center">
                            <button type="button" data-id="{{ $content->cart }}" onclick="updateTotal('+', this.dataset.id )" class="h-10 border border-r-0 rounded-l px-3">
                               <i class="fa-solid fa-plus"></i>
                            </button>
                            <input type="number" name="qty" id="qty" class=
                            "h-10 border mt-1 px-4 w-full bg-gray-50" value="{{ $content->qty }}" min=
                            "1">
                            <button type="button" data-id="{{ $content->cart }}" onclick="qty.value > 0 ? updateTotal('-', this.dataset.id) : 0; " class="h-10 border border-l-0 rounded-r px-3">
                              <i class="fa-solid fa-minus"></i>
                           </button>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="md:flex mb-4">
                    <div class="flex">
                        <p class="w-3/5"> Total Pembayaran*
                            <span class="float-start text-xs">*tidak termasuk ongkos pengiriman</span>
                        </p>
                        <p id="total" class="mx-4">{{ rupiah($total) }}</p>
                    </div>
                    <div data-total="{{ $total }}" hidden></div>
                    <form action="" method="post" class="w-1/3">
                        @csrf
                        <input type="hidden">
                        <button class="flex items-center bg-[#1B3C73] rounded-md w-full font-semibold text-white text-center text-sm md:text-md px-2 py-1" type="submit">
                            <i class="fa-solid fa-bag-shopping block text-md mr-4"></i>
                            <span class="inline-block mr-2">Checkout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
</section>
@endsection

@section('scripts')
    @parent
<script>
const token = document.querySelector('input[name="_token"]').value;
const finalTotal = document.querySelector('#total');

function updateTotal(op, cartId) {
    window.qty = document.querySelector(`[data-id=\"${cartId}\"] #qty`);

    switch (op) {
        case '+':
            qty.value ++;
            break;
        case '-':
            qty.value --;
            break;
    }

    const form = new FormData;
    form.append('qty', qty.value);

    fetch(`/cart/${cartId}`, {
        method: "PUT",
        headers: {
            'X-CSRF-TOKEN': token,
        },
        body: form,
    });
}

//(async function fetchTotal () {

//})();

function rupiah (number) {
    return new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'})
                   .format(number);
}
</script>
@endsection
