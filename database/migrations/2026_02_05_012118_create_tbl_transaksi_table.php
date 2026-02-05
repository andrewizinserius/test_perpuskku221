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
        Schema::create('tbl_transaksi', function (Blueprint $table) {
            $table->integer('id_transaksi', true);
            $table->unsignedBigInteger('id_pustaka');
            $table->unsignedBigInteger('id_anggota');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali');
            $table->date('tgl_pengembalian')->nullable();
            $table->enum('fp', ['0', '1']);
            $table->string('keterangan', 50);
            $table->integer('denda_telat')->nullable()->default(0);
            $table->integer('denda_hilang')->nullable()->default(0);
            $table->integer('total_denda')->nullable()->default(0);
            $table->boolean('denda_dibayar')->nullable()->default(false);
            $table->date('tgl_bayar_denda')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_transaksi');
    }
};
