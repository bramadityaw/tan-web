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
        $cart_items = DB::table('carts')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $cart_contents = $cart_items->map(function ($item) {
            return (object) [
                "product" => Product::find($item->product_id),
                "qty"     => $item->quantity,
                "cart"    => $item->id,
            ];
        });

        return view('toko.cart', [
            'contents' => $cart_contents,
            'total' => $this->total(),
        ]);
    }

    private function total() : int | null
    {
        $cart_items = DB::table('carts')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $total_purchase = $cart_items->map(function ($item) {
            return Product::find($item->product_id)->harga * $item->quantity;
        })->reduce(function ($acc, $curr) {
            return $acc + $curr;
        });

        return $total_purchase;
    }

    public function getTotal() : string
    {
        return json_encode([
            'price' => $this->total()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart) : void
    {
        $validated = $request->validate([
            'qty' => ['integer', 'min:1'],
        ]);

        $cart_item = Cart::findOrFail($cart->id);

        $cart_item->quantity = $validated["qty"];

        $cart_item->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart) : void
    {
        $cart->delete();
    }
}
