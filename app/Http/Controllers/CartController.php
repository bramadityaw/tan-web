<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
            'qty' => ['integer', 'min:1'],
        ]);

        if (!DB::table('carts')->where('product_id', $product->id)->exists())
        {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'quantity' => $validated['qty'],
            ]);
        }

        return redirect()->to('/cart');
    }

    public function index() : View
    {
        $cart = DB::table('carts')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $total_purchase = $cart->map(function ($item) {
            return Product::find($item->product_id)->harga * $item->quantity;
        })->reduce(function ($acc, $curr) {
            return $acc + $curr;
        });

        $cart_contents = $cart->map(function ($item) {
            return (object) ["product" => Product::find($item->product_id),
                             "qty"     => $item->quantity];
        });

        return view('toko.cart', [
            'contents' => $cart_contents,
            'total' => $total_purchase,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
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
