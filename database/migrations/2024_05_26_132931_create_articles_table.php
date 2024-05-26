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
<<<<<<<< HEAD:database/migrations/2024_05_21_112706_add_total_bayar_column_to_sales_table.php
        Schema::table('sales', function (Blueprint $table) {
            $table->bigInteger('total_bayar');
========
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->foreignId('kategori_id')->references('id')->on('kategori');
            $table->text('konten');
            $table->string('thumbnail_url');
            $table->timestamps();
>>>>>>>> blog-admin:database/migrations/2024_05_26_132931_create_articles_table.php
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('total_bayar');
        });
    }
};
