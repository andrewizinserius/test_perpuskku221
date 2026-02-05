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
        Schema::create('tbl_ddc', function (Blueprint $table) {
            $table->unsignedBigInteger('id_ddc')->primary();
            $table->unsignedBigInteger('id_rak')->index('tbl_ddc_id_rak_foreign');
            $table->string('kode_ddc', 10)->unique();
            $table->string('ddc', 100);
            $table->string('keterangan', 100);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_ddc');
    }
};
