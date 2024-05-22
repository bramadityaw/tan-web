<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Sales;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.dashboard.sales.index', [
            "sales" => DB::table('sales')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.dashboard.sales.create', [
            'products' => Product::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order_items = $this->collectOrder($request->except('_token'));

        $total = $order_items->map(function ($item) {
            return Product::findOrFail($item->product_id)->harga * $item->qty;
        })->reduce(function($acc, $curr) {
            return $acc + $curr;
        }, 0);

        $order = new Order([
            "harga_total" => $total,
            "user_id" => Auth::user()->id,
        ]);

        $order->is_verified = true;

        $order->save();

        foreach ($order_items as $item)
        {
            OrderItem::create([
                "price" => Product::findOrFail($item->product_id)->harga,
                "quantity" => $item->qty,
                "order_id" => $order->id,
                "product_id" => $item->product_id,
            ]);
        }

        Sales::create([
            'user_id' => $order->user_id,
            'order_id' => $order->id,
            'total_bayar' => $order->harga_total,
        ]);

        return redirect()->intended('/admin/dashboard/sales');
    }

     /**
     * Display the specified resource.
     */
    public function show(Sales $sales, Order $order) : View
    {
        $order_items = OrderItem::where('order_id', $order->id)->get();
        $user = User::find($order->user_id);

        return view('admin.dashboard.sales.show', [
            "order" => $order,
            "order_items" => $order_items,
            "user" => $user,
            "sales" => $sales,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }   //

    private function collectOrder(array $arr) : Collection
    {
        $p = [];
        foreach ($arr as $k => $v)
        {
            if (str_contains($k, 'product'))
            {
                array_push($p, ['product_id' => $v]);
            }
            if (str_contains($k, 'qty'))
            {
                array_push($p, ['qty' => $v]);
            }
        }
        $order = collect($p)->map(function ($v, $k) use ($p) {
            $o = [];
            if ($k % 2 === 0)
            {
                array_push($o, [$v, $p[$k+1]]);
            }
            return $o;
        })->collapse()
          ->map(function ($val) {
              $o = [];
              foreach ($val as $v) {
                array_push($o, $v);
              }
              return $o;
          });
        return collect($this->flatten($order->toArray()));
    }

    private function flatten (array $arr) : array
    {
        $result = [];
        foreach ($arr as $inner_arr) {
            $merged_arr = [];
            foreach ($inner_arr as $sub_arr) {
                $merged_arr = array_merge($merged_arr, $sub_arr);
            }
            $result[] = (object) $merged_arr;
        }
        return $result;
    }
}
