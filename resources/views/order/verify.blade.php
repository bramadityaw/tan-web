@extends('layouts.user')

@push('head_scripts')
<script type="module" src="/scripts/countdown.js"></script>
@endpush

@section('main')
<section class="bg-[#1B3C73] py-4">
    <div class="rounded-md w-3/5 md:w-1/2 mx-auto bg-white p-4 my-8">
        <div class="text-center">
            <h1 class="text-xl">Mohon transfer ke rekening berikut</h1>
            <p class="text-lg mt-4">No. Rekening <b>8120827902 </b> (BCA) a.n. <b>Muhammad Ferdiansyah Tandianus</b></p>
            <p class="text-lg mb-4">Jumlah yang harus ditransfer: <b>{{ rupiah($order->harga_total) }}.</b></p>
        </div>
        <div class="text-xl font-semibold text-center">
            <template id="verify">
                <style>
                    .item:has(.days) {
                        display: none;
                    }
                    .seconds + .unit {
                        display: none;
                    }
                    .unit {
                        margin-left: 0.5rem;
                        margin-right: 0.5rem;
                    }
                </style>
                <p>Pesanan harus dibayar sebelum timer habis.</p>
                <time></time>
            </template>
            <count-down ends="{{ $order->expired_date }}" breakpoint1="25em" breakpoint2="50em" id="custom-template" template="verify">
                <p>Pesanan harus dibayar sebelum {{ tanggalIdn($order->expired_date, 'j F, H:i:s') }}.</p>
                <time>{{ $order->expired_date }}</time>
            </count-down>
        </div>
        <div class="text-center mt-4">
            <p>Setelah ini, Anda akan diarahkan ke WhatsApp Tan Aquatic. Harap screenshoot bukti keberhasilan transaksi dan kirimkan bersama pesan dari sistem.</p>
            <a class="flex items-center bg-[#1B3C73] rounded-md font-semibold text-white text-center text-sm md:text-md px-2 py-1" href="{{ $link_with_message }}" class="text-lg">
                <i class="fa-brands fa-whatsapp"></i>
                <span>Verifikasi</span>
            </a>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@parent
<script>
document.addEventListener("DOMContentLoaded", () => {
    const countdown = document.querySelector('count-down').shadowRoot;
    countdown.querySelectorAll('.item .unit').forEach(e => e.textContent = ':');

    function redirectIfOver() {
        let clockOver = Array.from(countdown.querySelectorAll('.number'))
            .map(e => Number(e.textContent) <= 0)
            .reduce((acc, curr) => acc && curr);

        if (clockOver) window.location.replace('/order/fail');
    }

    setInterval(redirectIfOver, 1000);
})
</script>
@endsection
