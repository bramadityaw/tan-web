<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
	DB::statement('alter table "orders" alter column "verify_token" type varchar(255), alter column "verify_token" drop not null, alter column "verify_token" drop default');
//        Schema::table('orders', function (Blueprint $table) {
//            $table->string('verify_token')->nullable(true)->change();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('verify_token')->nullable(false)->change();
        });
    }
};
