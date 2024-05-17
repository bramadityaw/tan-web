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

            $order = new Order([
                "expired_date" => Carbon::now()->addDay()->toDateTimeString(),
                "harga_total" => CartController::total(),
                "user_id" => Auth::user()->id,
            ]);

            $order->verify_token = VerifyOrderController::createVerifyToken();
            $order->save();

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
