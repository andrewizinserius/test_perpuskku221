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
        Schema::create('tbl_anggota', function (Blueprint $table) {
            $table->bigIncrements('id_anggota');
            $table->unsignedBigInteger('id_jenis_anggota')->index('tbl_anggota_id_jenis_anggota_foreign');
            $table->string('kode_anggota', 20)->unique();
            $table->string('nama_anggota', 100)->unique();
            $table->string('tempat', 20);
            $table->date('tgl_lahir');
            $table->string('alamat', 50);
            $table->string('no_telp', 15);
            $table->string('email', 30);
            $table->date('tgl_daftar');
            $table->date('masa_aktif');
            $table->enum('fa', ['Y', 'T']);
            $table->string('keterangan', 45)->nullable();
            $table->longText('foto')->nullable();
            $table->string('username', 50)->unique();
            $table->string('password', 60);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_anggota');
    }
};
