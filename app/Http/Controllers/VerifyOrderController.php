<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    private function verifyLink(Order $order) : string
    {
        $query = http_build_query([
            "_gmd" => $order->verify_token,
        ]);

        return route('order.verify', $order) . '/?' . $query;
    }

    public static function createVerifyToken() : string
    {
        $unix_n = Carbon::now()->timestamp;
        $unix_t = Carbon::parse(time())->timestamp;
        $unix_u = Carbon::parse(Auth::user()->created_at)->timestamp;
        return Hash::make(abs(floor($unix_n - $unix_n * ($unix_t / $unix_u))));
    }

    private function whatsappLink(Order $order) : string
    {
        $whatsapp_api_link = 'https://api.whatsapp.com/send/';
//        $phone_number = '6281379048620'; // Kak Ferdi's number
        $phone_number = '6281289096039'; // test number (my mom)
        $message = $this::message($order);

        return $whatsapp_api_link . '?phone=' . $phone_number
            . '&text=' . urlencode($message) . '%0ATolong verifikasi pembelian saya dengan mengklik link berikut%3A%0A' . urlencode($this->verifyLink($order));
    }

    private static function message(Order $order) : string
    {
        $order_items = DB::table('order_items')->where('order_id', $order->id)
                                               ->get();
        $total_price = $order->harga_total;

        $sapa = 'Halo kak, nama saya ' . Auth::user()->name . ' ingin membeli produk di toko online Tan Aquatic. ';

        $produk = $order_items->map(function ($item) {
            return (object) ["nama" => Product::find($item->product_id)->nama,
                             "jumlah_beli" => $item->quantity];
        })->toarray();

        $produk_terbeli = 'Saya membeli ';
        if (count($produk) === 1)
        {
            $produk_terbeli = $produk_terbeli . $produk[0]->nama . ' sebanyak ' . $produk[0]->jumlah_beli;
        } else {
            foreach ($produk as $i => $p)
            {
                if ($i === array_key_last($produk)) {
                    $produk_terbeli = $produk_terbeli . 'dan '
                        . $p->nama . ' sebanyak ' . $p->jumlah_beli;
                    break;
                }

                $produk_terbeli = $produk_terbeli . $p->nama
                    . ' sebanyak ' . $p->jumlah_beli . ', ';
            }
        }

        $pembelian = $produk_terbeli . ' dengan total harga ' . rupiah($total_price) . '.';

        $message = $sapa . $pembelian;

        return $message;
    }

    public function verify(Request $request, Order $order) : RedirectResponse
    {
        if ($request->input('_gmd') !== $order->verify_token)
        {
            return redirect('/');
        } else {
            $order->is_verified = true;
            $order->save();
        }

        return redirect()->intended('/admin/dashboard');
    }
}
