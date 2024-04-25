<?php

namespace App\Http\Controllers;

use App\Enums\JenisTransaksi;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
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
        $request->validate(['jenis_transaksi' => [new Enum(JenisTransaksi::class)]]);
        $transaction_type = $request->input('jenis_transaksi');

        switch ($transaction_type) {
            case 'pembelian':
                $rule = [
                   'nama_barang' => ['required', 'string','max:255'],
                   'harga_beli' => ['required', 'numeric'],
                   'qty' => ['required', 'integer'],
                   'created_at' => ['date'],
                ];
                $request->validate($rule);
                Purchase::create($request->except(['jenis_transaksi']));
            break;

            case 'penjualan':
//                $table_name = 'sales';
                break;

            default:
                # code...
                break;
        }

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
