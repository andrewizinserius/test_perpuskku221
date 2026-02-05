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
        Schema::create('tbl_format', function (Blueprint $table) {
            $table->unsignedBigInteger('id_format')->primary();
            $table->string('kode_format', 10)->unique();
            $table->string('format', 25);
            $table->string('keterangan', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_format');
    }
};
