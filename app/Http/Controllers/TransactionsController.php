<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

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

    public function store(Request $request)
    {
        //
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
