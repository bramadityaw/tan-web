<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function notifyFailure() : View
    {
        return view('order.failure');
    }

    public function showVerify(Order $order) : View
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

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $cart_item_ids = collect($request->except('_token'))->values();
        $cart_exists = $cart_item_ids
            ->map(function ($id) {
                return DB::table('carts')->where('id', '=', $id)->exists();
            })
            ->reduce(function ($acc, $curr) {
                return $acc && $curr;
            }, true);

        if (!$cart_exists)
        {
            $validator = \Illuminate\Support\Facades\Validator::make([], []);

            $validator->errors()->add('cart_id', 'Cart does not exist');

            throw new \Illuminate\Validation\ValidationException($validator);
        } else {
            $cart_items = $cart_item_ids
            ->map(function ($id) {
                return DB::table('carts')->where('id', '=', $id)->get();
            })->collapse();

            $order = Order::create([
                "expired_date" => Carbon::now()->addDay()->toDateTimeString(),
                "harga_total" => CartController::total(),
                "user_id" => Auth::user()->id,
            ]);

            foreach ($cart_items as $item)
            {
                OrderItem::create([
                    "price" => Product::findOrFail($item->product_id)->harga,
                    "quantity" => $item->quantity,
                    "order_id" => $order->id,
                    "product_id" => $item->product_id,
                ]);
            }

            Cart::clear();

            return redirect()->intended('/order/' . (string) $order->id . '/verify');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
