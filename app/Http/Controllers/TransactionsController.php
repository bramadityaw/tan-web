<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TransactionsController extends Controller
{
    public function index() : View {
        return view('admin.dashboard.transactions', [
            "sales" => DB::table('sales')->paginate(5),
            "purchases" => DB::table('purchases')->paginate(5),
        ]);
    }
}
