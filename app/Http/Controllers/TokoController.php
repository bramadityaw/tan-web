<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TokoController extends Controller
{
    public function index() : View
    {
        return view('toko.index', [
            "products" => DB::table('products')->paginate(16)
        ]);
    }

    public function search(Request $request)
    {
        //
    }

    public function show(Product $product)
    {
        return view('toko.show', [
            "product" => $product,
        ]);
    }
}
