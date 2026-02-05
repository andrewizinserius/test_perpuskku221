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
        Schema::create('tbl_pustaka', function (Blueprint $table) {
            $table->integer('id_pustaka')->primary();
            $table->unsignedBigInteger('kode_pustaka');
            $table->unsignedBigInteger('id_ddc');
            $table->unsignedBigInteger('id_format');
            $table->unsignedBigInteger('id_penerbit');
            $table->unsignedBigInteger('id_pengarang');
            $table->string('isbn', 20);
            $table->string('judul_pustaka', 100);
            $table->string('tahun_terbit', 5);
            $table->string('keyword', 50);
            $table->string('keterangan_fisik', 100);
            $table->string('keterangan_tambahan', 100);
            $table->longText('abstraksi');
            $table->longText('gambar');
            $table->integer('harga_buku');
            $table->string('kondisi_buku', 15);
            $table->integer('jml_book');
            $table->enum('fp', ['0', '1']);
            $table->integer('jml_pinjam')->default(0);
            $table->integer('denda_terlambat');
            $table->integer('denda_hilang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pustaka');
    }
};
