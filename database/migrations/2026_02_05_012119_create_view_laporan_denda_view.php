<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("CREATE VIEW `view_laporan_denda` AS select `t`.`id_transaksi` AS `id_transaksi`,`t`.`tgl_pinjam` AS `tgl_pinjam`,`t`.`tgl_kembali` AS `tgl_kembali`,`t`.`tgl_pengembalian` AS `tgl_pengembalian`,(case when (`t`.`fp` = 0) then 'Dipinjam' when (`t`.`fp` = 1) then 'Selesai' when (`t`.`fp` = 2) then 'Hilang' end) AS `status`,`a`.`nama_anggota` AS `nama_anggota`,`p`.`judul_pustaka` AS `judul_pustaka`,`t`.`denda_telat` AS `denda_telat`,`t`.`denda_hilang` AS `denda_hilang`,`t`.`total_denda` AS `total_denda`,(case when (`t`.`denda_dibayar` = 1) then 'Lunas' when (`t`.`total_denda` > 0) then 'Belum Dibayar' else 'Tidak Ada Denda' end) AS `status_denda`,`t`.`tgl_bayar_denda` AS `tgl_bayar_denda`,(case when (`t`.`tgl_pengembalian` > `t`.`tgl_kembali`) then (to_days(`t`.`tgl_pengembalian`) - to_days(`t`.`tgl_kembali`)) else 0 end) AS `hari_terlambat` from ((`ohwakjemki12`.`tbl_transaksi` `t` join `ohwakjemki12`.`tbl_anggota` `a` on((`t`.`id_anggota` = `a`.`id_anggota`))) join `ohwakjemki12`.`tbl_pustaka` `p` on((`t`.`id_pustaka` = `p`.`id_pustaka`))) where ((`t`.`total_denda` > 0) or (`t`.`denda_dibayar` = 1))");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS `view_laporan_denda`");
    }
};
