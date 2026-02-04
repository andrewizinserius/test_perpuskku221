<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    protected $table = 'tbl_penerbit';
    protected $primaryKey = 'id_penerbit';
    public $timestamps = false; // Nonaktifkan timestamps
    protected $fillable = ['kode_penerbit', 'nama_penerbit', 'alamat_penerbit', 'no_telp', 'email', 'fax', 'website', 'kontak'];

    public function pustakas()
    {
        return $this->hasMany(Pustaka::class, 'id_penerbit');
    }
}