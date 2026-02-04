<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $table = 'tbl_format';
    protected $primaryKey = 'id_format';
    public $timestamps = false;
    protected $fillable = ['kode_format', 'format', 'keterangan'];

    public function pustakas()
    {
        return $this->hasMany(Pustaka::class, 'id_format');
    }
}