<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('admin.dashboard.sales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
    }   //
}
