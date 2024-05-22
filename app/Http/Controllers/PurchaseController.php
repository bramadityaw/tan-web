<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('admin.dashboard.purchase.index', [
            "purchases" => DB::table('purchases')
                ->orderBy('created_at', 'desc')
                ->paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('admin.dashboard.purchase.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $rule = [
           'nama_barang' => ['required', 'string','max:255'],
           'harga_beli' => ['required', 'numeric'],
           'qty' => ['required', 'integer'],
           'created_at' => ['date'],
        ];
        $validated = $request->validate($rule);
        Purchase::create($validated);

        return redirect()->intended('/admin/dashboard/purchase');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id) : void
    {
        Purchase::destroy($id);
    }
}
