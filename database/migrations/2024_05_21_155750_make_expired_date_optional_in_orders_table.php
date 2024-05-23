<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
	  DB::statement('alter table "orders" alter column "expired_date" type timestamp(0) without time zone, alter column "expired_date" drop not null, alter column"expired_date" drop default');
//        Schema::table('orders', function (Blueprint $table) {
//            $table->dateTime('expired_date')->nullable(true)->change();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('expired_date')->nullable(false)->change();
        });
    }
};
