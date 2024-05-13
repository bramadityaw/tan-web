<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private function sum(array $arr, string $attribute) : int {
        return array_reduce($arr, function ($acc, $item) use ($attribute) {
            return $acc + $item->$attribute;
        }, 0);
    }

    public function view() : View {
        $products = [
            [
                "name" => "Arwana Silver",
                "src" => "/images/arwana_silver.jpeg"
            ],
            [
                "name" => "Ikan Koi",
                "src" => "/images/koi.jpg"
            ],
            [
                "name" => "Koki Redcap",
                "src" => "/images/koki_redcap.jpg"
            ],
            [
                "name" => "Ikan Komet",
                "src" => "/images/komet.jpg"
            ],
            [
                "name" => "Molly Orange",
                "src" => "/images/molly_orange.jpg"
            ]
        ];

        $purchase_monthly = DB::table('purchases')
            ->select('harga_beli')
            ->whereMonth('created_at', '=', date('m'))
            ->get()->toArray();
        $purchase_total = $this->sum($purchase_monthly, 'harga_beli');

        $sales_monthly = DB::table('sales')
            ->select('total_bayar')
            ->whereMonth('created_at', '=', date('m'))
            ->get()->toArray();

        $sales_total = $this->sum($sales_monthly, 'total_bayar');

        $monthly_total = [
            "purchases" => $purchase_total,
            "sales" => $sales_total,
            "diff" => $sales_total - $purchase_total,
        ];

        $reviews = [];

        return view('admin.dashboard.index',
            [
                "products" => $products,
                "monthly_total" => $monthly_total,
                "reviews" => $reviews,
            ]
        );
    }
}
