<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
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


        $unverified_orders = DB::table('orders')
            ->where('is_verified', false)
            ->where('expired_date', '>', Carbon::parse(time())->toDateTimeString())
            ->get();

        return view('home',
            [
                "products" => $products,
                "orders" => $unverified_orders,
            ]
        );
    }
}
