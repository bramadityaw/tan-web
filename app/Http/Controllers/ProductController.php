<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

        $imageFileName = time() . '_'
                        . str_replace(' ', '_', strtolower($request['nama_produk']))
                        . '.' . $request->file('gambar')->getClientOriginalExtension();
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
    public function show(Product $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) : View
    {
        $product = Product::findOrFail($id);

        return view('admin.dashboard.products.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id) : RedirectResponse
    {
        $product = Product::findOrFail($id);
        $rule = [
           'nama_produk' => ['required', 'string','max:255'],
           'deskripsi' => ['string', 'min:50'],
           'harga' => ['required', 'numeric'],
           'stok' => ['required', 'integer'],
           'gambar' => ['required', 'file', 'image', 'extensions:jpg,jpeg,png'],
        ];

        $request->validate($rule);

        $imageFileName = time() . '_'
                        . str_replace(' ', '_', strtolower($request['nama_produk']))
                        . '.' . $request->file('gambar')->getClientOriginalExtension();
        $imageFilePath = $request->file('gambar')->storeAs('images', $imageFileName, 'public');

        $current_image = '/public/' . $product->thumbnail_url;
        if (Storage::exists($current_image))
        {
            Storage::delete($current_image);
        }

        $product->nama = $request->nama_produk;
        $product->deskripsi = $request->deskripsi;
        $product->harga = $request->harga;
        $product->stok = $request->stok;
        $product->thumbnail_url = $imageFilePath;

        $product->save();

        return redirect()->intended('/admin/dashboard/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) : void
    {
        $product = Product::findOrFail($id);

        $storage_path = '/public/' . $product->thumbnail_url;
        if (Storage::exists($storage_path))
        {
            Storage::delete($storage_path);
            Product::destroy($id);
        }
    }
}
