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
        $rule = [
            'jenis_transaksi' => [Rule::enum(JenisTransaksi::class)],
            'nama_barang' => 'required|string|max:255',
            'harga_beli' => 'digits:13',
            'qty' => 'digits_between:0,99',
            'created_at' => 'date',
        ];

        $validated = $request->validate($rule);

        $transaction_type = $validated['jenis_transaksi'];

        $table_name = '';
        switch ($transaction_type) {
            case 'pembelian':
                $table_name = 'purchases';
                break;

            case 'penjualan':
                $table_name = 'sales';
                break;

            default:
                # code...
                break;
        }

        unset($validated["jenis_transaksi"]);

        DB::table($table_name)->insert($validated);

        return redirect()->intended('admin/dashboard/transactions');
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
