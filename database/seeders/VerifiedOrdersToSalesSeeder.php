<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Sales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VerifiedOrdersToSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $verified_orders = Order::where('is_verified', true)->get();

        foreach ($verified_orders as $order)
        {
            Sales::create([
               'order_id' => $order->id,
               'user_id' => $order->user_id,
            ]);
        }
    }
}
