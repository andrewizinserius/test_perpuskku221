<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class TblAnggota extends Authenticatable
{
    protected $table = 'tbl_anggota';
    protected $primaryKey = 'id_anggota';
    public $timestamps = false;
    protected $fillable = [
        'id_jenis_anggota',
        'kode_anggota',
        'nama_anggota',
        'tempat',
        'tgl_lahir',
        'alamat',
        'no_telp',
        'email',
        'tgl_daftar',
        'masa_aktif',
        'fa',
        'keterangan',
        'foto',
        'username',
        'password',
    ]; // Sesuaikan dengan kolom yang diperlukan
    protected $hidden = ['password'];
}