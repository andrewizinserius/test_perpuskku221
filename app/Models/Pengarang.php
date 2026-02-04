<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengarang extends Model
{
    protected $table = 'tbl_pengarang';
    protected $primaryKey = 'id_pengarang';
    public $timestamps = false;

    protected $fillable = [
        'kode_pengarang',
        'gelar_depan',
        'nama_pengarang',
        'kelamin',
        'gelar_belakang',
        'no_telp',
        'email',
        'website',
        'biografi',
        'keterangan',
    ];
}


 