<?php

namespace App\Http\Controllers;

use App\Enums\JenisTransaksi;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TransactionsController extends Controller
{
    public function index() : View {
        return view('admin.dashboard.transactions.index', [
            "sales" => DB::table('sales')->paginate(5),
            "purchases" => DB::table('purchases')->paginate(5),
        ]);
    }

    public function create() : View {
        return view('admin.dashboard.transactions.create');
    }

    public function store(Request $request) : RedirectResponse
    {
        $transaction_type = $request['jenis_transaksi'];

        $rule = [
            'jenis_transaksi' => [Rule::enum(JenisTransaksi::class)],
            'nama_barang' => 'required|string|max:255',
            'harga' => 'digits_between:0,999',
            'created_at' => 'date',
        ];

        $validated = $request->validate($rule);

        $table_name = $transaction_type;
        DB::table($table_name)->insert($validated);

        return redirect()->intended('admin/dashboard/transaksi');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }
}
