<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.dashboard.products.index', [
            "products" => DB::table('products')->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $rule = [
           'nama_produk' => ['required', 'string','max:255'],
           'deskripsi' => ['string', 'min:50'],
           'harga' => ['required', 'numeric'],
           'stok' => ['required', 'integer'],
           'gambar' => ['required', 'file', 'image', 'extensions:jpg,jpeg,png'],
        ];

        $request->validate($rule);

        //dd($validated);

        $imageFileName = time() . '_' . $request->file('gambar')->getClientOriginalName();
        $imageFilePath = $request->file('gambar')->storeAs('images', $imageFileName, 'public');

        Product::create([
            'nama' => $request['nama_produk'],
            'deskripsi' => $request['deskripsi'],
            'harga' => $request['harga'],
            'stok' => $request['stok'],
            'thumbnail_url' => $imageFilePath,
        ]);

        return redirect()->intended('/admin/dashboard/products');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
