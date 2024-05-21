<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('verified_at');
            $table->dropColumn('verif_status');
            $table->dropColumn('verif_bukti');
            $table->dropColumn('total_bayar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dateTime('verified_at');
            $table->enum('verif_status', ['pending', 'verified', 'failed']);
            $table->string('verif_bukti');
            $table->unsignedInteger('total_bayar');
        });
    }
};
