<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tbl_transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;
    public $timestamps = false;
    
    // ✅ FIX: Tambahkan ini
    protected $keyType = 'int';
    
    protected $fillable = [
        'id_transaksi', // ✅ FIX: Tambahkan id_transaksi ke fillable
        'id_pustaka', 
        'id_anggota', 
        'tgl_pinjam', 
        'tgl_kembali', 
        'tgl_pengembalian', 
        'fp', 
        'keterangan',
        'denda_telat',
        'denda_hilang',
        'total_denda',
        'denda_dibayar',
        'tgl_bayar_denda'
    ];

    protected $casts = [
        'fp' => 'integer',
        'denda_dibayar' => 'boolean',
    ];

    // Accessor untuk atribut kustom
    protected $appends = [
        'hari_terlambat',
        'status_text',
        'status_color',
        'ada_denda',
        'status_denda',
        'status_denda_color'
    ];

    public function pustaka()
    {
        return $this->belongsTo(Pustaka::class, 'id_pustaka');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    // Accessor: Hitung hari terlambat
    public function getHariTerlambatAttribute()
    {
        if ($this->tgl_pengembalian && $this->fp == 1) {
            $tglKembali = Carbon::parse($this->tgl_kembali);
            $tglPengembalian = Carbon::parse($this->tgl_pengembalian);
            
            if ($tglPengembalian->greaterThan($tglKembali)) {
                return $tglPengembalian->diffInDays($tglKembali);
            }
        }
        return 0;
    }

    // Accessor: Status teks
    public function getStatusTextAttribute()
    {
        return match($this->fp) {
            0 => 'Dipinjam',
            1 => 'Selesai',
            2 => 'Hilang',
            default => 'Tidak Diketahui',
        };
    }

    // Accessor: Warna badge status
    public function getStatusColorAttribute()
    {
        return match($this->fp) {
            0 => 'warning',
            1 => 'success',
            2 => 'danger',
            default => 'secondary',
        };
    }

    // Accessor: Cek apakah ada denda
    public function getAdaDendaAttribute()
    {
        return $this->total_denda > 0 && !$this->denda_dibayar;
    }

    // Accessor: Status denda
    public function getStatusDendaAttribute()
    {
        if ($this->total_denda == 0) {
            return 'Tidak Ada Denda';
        } elseif ($this->denda_dibayar) {
            return 'Denda Lunas';
        } else {
            return 'Ada Denda';
        }
    }

    // Accessor: Warna status denda
    public function getStatusDendaColorAttribute()
    {
        if ($this->total_denda == 0) {
            return 'success';
        } elseif ($this->denda_dibayar) {
            return 'info';
        } else {
            return 'danger';
        }
    }

    // Method untuk hitung denda telat
    public function hitungDendaTelat()
    {
        $hariTerlambat = $this->hari_terlambat;
        $dendaPerHari = 6000; // Rp 6.000 per hari
        
        if ($hariTerlambat > 0) {
            return $hariTerlambat * $dendaPerHari;
        }
        return 0;
    }

    // Method untuk hitung denda hilang
    public function hitungDendaHilang()
    {
        return 100000; // Rp 100.000 flat rate untuk buku hilang
    }

    // Method untuk hitung total denda
    public function hitungTotalDenda()
    {
        $total = 0;
        
        if ($this->fp == 2) { // Buku hilang
            $total = $this->hitungDendaHilang();
        } elseif ($this->fp == 1) { // Selesai (mungkin ada denda telat)
            $total = $this->hitungDendaTelat();
        }
        
        return $total;
    }

    // Method untuk format Rupiah
    public function formatRupiah($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

    // Method untuk update denda otomatis
    public function updateDendaOtomatis()
    {
        if ($this->fp == 1 && !$this->denda_dibayar) {
            $dendaTelat = $this->hitungDendaTelat();
            
            if ($dendaTelat != $this->denda_telat) {
                $this->update([
                    'denda_telat' => $dendaTelat,
                    'total_denda' => $dendaTelat + $this->denda_hilang,
                ]);
                return true;
            }
        }
        return false;
    }
}