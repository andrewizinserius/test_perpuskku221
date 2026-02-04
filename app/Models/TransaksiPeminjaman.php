<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiPeminjaman extends Model
{
    // di app/Models/TransaksiPeminjaman.php
protected $fillable = [
    'id_pustaka',
    'id_user',
    'tanggal_pinjam',
    'tanggal_kembali',
    'status',
    'keterangan'
];
}
