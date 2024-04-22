<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PurchaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('purchases')->insert([
            'nama_barang' => Str::random(10),
            'qty' => mt_rand(100000, 999999),
            'harga_beli' => mt_rand(100000, 999999),
        ]);
    }
}
