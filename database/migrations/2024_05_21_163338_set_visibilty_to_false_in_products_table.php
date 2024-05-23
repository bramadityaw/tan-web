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
	  DB::statement('alter table "products" alter column "is_online" type boolean, alter column "is_online" set not null, alter column "is_online" set default \'0\'');

//        Schema::table('products', function (Blueprint $table) {
//            $table->boolean('is_online')->default(false)->change();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('is_online')->default(true)->change();
        });
    }
};
