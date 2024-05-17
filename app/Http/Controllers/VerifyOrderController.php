<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VerifyOrderController extends Controller
{
    public function notifyFailure() : View
    {
        return view('order.failure');
    }

    public function show(Order $order) : View
    {
        return view('order.verify', [
            "order" => $order,
            "link_with_message" => $this->whatsappLink($order),
        ]);
    }

    private function whatsappLink(Order $order) : string
    {
        $whatsapp_short_link = 'https://wa.me/';
        $phone_number = '6281379048620';
        $message = $this::message($order);
        return $whatsapp_short_link . $phone_number . '?text=' . rawurlencode($message);
    }

    private static function message(Order $order) : string
    {
        $order_items = DB::table('order_items')->where('order_id', $order->id)
                                               ->get();
        $total_price = $order->harga_total;

        $sapa = 'Halo kak, nama saya ' . Auth::user()->name . ' ingin membeli produk di toko online Tan Aquatic. ';

        $produk = $order_items->map(function ($item) {
            return Product::find($item->product_id)->nama;
        })->toarray();

        $produk_terbeli = 'Saya membeli ';
        if (count($produk) === 1)
        {
            $produk_terbeli = $produk_terbeli . $produk[0];
        } else {
            foreach ($produk as $i => $p)
            {
                if ($i === array_key_last($produk)) {
                    $produk_terbeli = $produk_terbeli . 'dan ' . $p;
                    break;
                }

                $produk_terbeli = $produk_terbeli . $p . ', ';
            }
        }

        $pembelian = $produk_terbeli . ' dengan total harga ' . rupiah($total_price) . '.';

        $message = $sapa . $pembelian;

        return $message;
    }

    public function verify(Request $request, Order $order) : RedirectResponse
    {
        return redirect()->intended('/admin/dashboard');
    }
}
