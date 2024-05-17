@extends('layouts.user')

@section('main')
<section class="bg-[#1B3C73] py-8">
    <div class="w-5/6 md:w-full max-w-[600px] mx-auto">
       <div class="rounded-md bg-white">
            <div class="flex justify-between pt-4 px-6">
                <a class="flex items-center w-fit text-center text-sm md:text-md"
                   href="/{{ url()->previous() }}">
                    <i class="fa-solid fa-arrow-left border border-black rounded-full p-1 mr-4 "></i>
                    <p>Kembali</p>
                </a>
            </div>
            <div class="px-6 pt-5 pb-1">
            @if($contents->isNotEmpty())
                @foreach ($contents as $content)
                <div class="flex items-center mb-4">
                    <a class="block w-full max-w-[192px]" href="/toko/product/{{ $content->product->slug }}">
                        <img class="w-full aspect-auto" src="/storage/{{ $content->product->thumbnail_url }}" alt="{{ $content->product->nama }}">
                    </a>
                    <div class="ml-4 md:m-0 md:flex md:w-full md:justify-between md:items-center">
                        <button data-cart-id="{{ $content->cart }}" onclick="window.cartItem = this; deleteItem(window.cartItem)" class="border border-gray-600 h-10 text-gray-800 rounded-md px-2 py-1 md:ml-4 z-20">
                            <i class="text-xs fa-solid fa-trash"></i>
                        </button>
                        <a class="mx-4 md:mr-8" href="/toko/product/{{ $content->product->slug }}">
                            <h1>{{ $content->product->nama }}</h1>
                            <p class="text-sm w-fit">{{ rupiah($content->product->harga) }} / ekor</p>
                        </a>
                        <div data-id="{{ $content->cart }}" class="flex min-w-[135px] max-w-[155px] w-full text-sm items-center">
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
            @else
                <div class="mx-4 my-8">
                    <h1 class="text-black text-lg text-center mt-4">Keranjangmu kosong!</h1>
                    <div class="text-center my-8">
                        <a class="block rounded-md bg-[#1b3c73] mb-4 lg:mb-0 mx-auto lg:w-2/5 p-2 text-white" href="/toko">
                            <i class="fa-solid fa-cart-shopping"></i>
                        Belanja</a>
                    </div>
                    <div class="rounded-md border-2 border-gray-300 bg-white text-[#909090] w-5/6 mx-auto">
                        <form action="/toko/search" class="flex justify-between">
                            <input class="rounded-l-md text-base w-full border-0 pl-4 py-3" type="text" placeholder="Cari ikan hias, pakan, aksesoris akuarium...">
                            <button class="px-4" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endif
                <div class="md:flex md:items-center mb-4">
                    <div class="flex items-center">
                        <p class="w-3/5"> Total Pembayaran*
                            <span class="float-start text-xs">*tidak termasuk ongkos pengiriman</span>
                        </p>
                        <p id="total" class="mx-4 {{ $contents->isEmpty() ? 'text-2xl' : '' }}">{{ $total ? rupiah($total) : '-' }}</p>
                    </div>
                    <div data-total="{{ $total }}" hidden></div>
                    <form action="/order" method="post" class="md:w-1/3">
                        @csrf
                        @foreach($contents as $content)
                        <input type="hidden" name="cart_item_{{ $content->cart }}" value="{{ $content->cart }}">
                        @endforeach
                        <button class="flex items-center {{ $contents->isEmpty() ? 'bg-gray-400' : 'bg-[#1B3C73] ' }} rounded-md w-full font-semibold text-white text-center text-sm md:text-md mt-4 md:mt-0 px-2 py-1" type="submit" {{ $contents->isEmpty() ? 'disabled' : '' }} >
                            <i class="fa-solid fa-bag-shopping block text-md mr-4"></i>
                            <span class="inline-block mr-2">Checkout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
</section>
<dialog id="deleteDialog" class="border border-[#1B3C73] rounded-md p-4 w-2/5 md:4/5 lg:w-1/6">
    <div class="text-center">
        <button class="float-end" type="button" onclick="deleteDialog.close()">
            <i class="fa-solid fa-times text-lg"></i>
        </button>
        <p>Hapus produk?</p>
        <img class="aspect-auto w-2/3 mx-auto my-4" src="{{ asset('/images/question.png') }}" alt="Tanda Tanya">
        <div class="flex flex-row justify-around text-white">
            <form method="dialog">
                <button type="submit" class="rounded-md px-3 py-2 bg-blue-500">Batal</button>
            </form>
            <button type="button" class="rounded-md px-3 py-2 bg-red-500">Hapus</button>
        </div>
    </div>
</dialog>

@endsection

@section('scripts')
@parent
<script>
async function updateTotal(op, cartId) {
    updateQty(op, cartId);

    const finalTotal = document.querySelector('#total');
    const total = await fetchTotal();

    finalTotal.innerText = rupiah(total.price);
}

function updateQty(op, cartId) {
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
    form.append('_token', token);
    form.append('_method', 'PUT');
    form.append('qty', qty.value);

    fetch(`/cart/${cartId}`, {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': token,
            'Accept': 'multipart/form-data',
        },
        body: form,
    })
}

async function fetchTotal () {
    const response = await fetch('/cart/total');

    return response.json();
}

const deleteDialog = document.querySelector("#deleteDialog");
const deleteButton = deleteDialog.querySelector('form[method="dialog"] + button[type="button"]');

function deleteItem(cartItem) {
    deleteDialog.showModal();
    const itemId = cartItem.dataset.cartId;

    const form = new FormData;
    form.append('_token', token);

    deleteButton.addEventListener("click", e => {
        fetch(`/cart/${itemId}`, {
            method: "DELETE",
            headers: {
                'X-CSRF-TOKEN': token,
                'Accept': 'multipart/form-data',
            },
            body: form,
        });
        deleteDialog.close();
        location.reload();
    });
}

function rupiah (number) {
    return new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'})
                   .format(number);
}
</script>
@endsection

