<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


        return view('home',
            [
                "products" => $products
            ]
        );
    }
}
