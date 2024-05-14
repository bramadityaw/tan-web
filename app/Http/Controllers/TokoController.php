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

    public function search(Request $request) : View
    {
        $query_string = $request->query->get('query');
        return view('toko.index', [
            "products" => DB::table('products')
                       ->whereFullText('deskripsi', $query_string)
                       ->paginate(16),
        ]);
    }

    public function show(Product $product) : View
    {
        return view('toko.show', [
            "product" => $product,
        ]);
    }
}
