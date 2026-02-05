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
        Schema::create('tbl_jenis_anggota', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jenis_anggota')->primary();
            $table->string('kode_jenis_anggota', 2)->unique();
            $table->string('jenis_anggota', 15);
            $table->string('max_pinjam', 5);
            $table->string('keterangan', 50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_jenis_anggota');
    }
};
