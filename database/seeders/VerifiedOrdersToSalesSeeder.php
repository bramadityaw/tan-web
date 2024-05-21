<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Sales;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            DB::table('sales')->insert([
               'created_at' => $order->updated_at,
               'updated_at' => $order->updated_at,
               'order_id' => $order->id,
               'user_id' => $order->user_id,
               'total_bayar' => $order->harga_total,
            ]);
        }
    }
}
