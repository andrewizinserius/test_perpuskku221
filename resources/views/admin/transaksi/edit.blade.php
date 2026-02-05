@extends('admin.layout')

@section('content')
<div class="container-fluid mt-4">
    <h2 class="fw-bold mb-4">Edit Transaksi #{{ $transaksi->id_transaksi }}</h2>

    <!-- Info Denda -->
    @if($transaksi->total_denda > 0)
    <div class="alert alert-{{ $transaksi->denda_dibayar ? 'info' : 'warning' }} mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h6 class="mb-1">
                    <i class="fas fa-money-bill-wave me-2"></i>
                    Informasi Denda
                </h6>
                <p class="mb-0">
                    Total denda: <strong>Rp {{ number_format($transaksi->total_denda, 0, ',', '.') }}</strong>
                    @if($transaksi->denda_dibayar)
                        <span class="badge bg-success ms-2">LUNAS</span>
                    @else
                        <span class="badge bg-danger ms-2">BELUM DIBAYAR</span>
                    @endif
                </p>
                @if($transaksi->denda_telat > 0)
                    <p class="mb-0">Denda telat: Rp {{ number_format($transaksi->denda_telat, 0, ',', '.') }}</p>
                @endif
                @if($transaksi->denda_hilang > 0)
                    <p class="mb-0">Denda hilang: Rp {{ number_format($transaksi->denda_hilang, 0, ',', '.') }}</p>
                @endif
            </div>
            <a href="{{ route('transaksi.showDenda', $transaksi->id_transaksi) }}" class="btn btn-sm btn-outline-primary">
                <i class="fas fa-info-circle me-1"></i> Detail Denda
            </a>
        </div>
    </div>
    @endif

    <form action="{{ route('transaksi.update', $transaksi->id_transaksi) }}" method="POST" id="editForm">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="id_pustaka" class="form-label">Buku *</label>
                <select name="id_pustaka" id="id_pustaka" required class="form-select">
                    <option value="">-- Pilih Buku --</option>
                    @foreach ($pustakas as $pustaka)
                        <option value="{{ $pustaka->id_pustaka }}" 
                                {{ $transaksi->id_pustaka == $pustaka->id_pustaka ? 'selected' : '' }}
                                data-stock="{{ $pustaka->jml_book }}">
                            {{ $pustaka->judul_pustaka }} (Stok: {{ $pustaka->jml_book }})
                        </option>
                    @endforeach
                </select>
                @error('id_pustaka')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="id_anggota" class="form-label">Anggota *</label>
                <select name="id_anggota" id="id_anggota" required class="form-select">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach ($anggotas as $anggota)
                        <option value="{{ $anggota->id_anggota }}"
                                {{ $transaksi->id_anggota == $anggota->id_anggota ? 'selected' : '' }}>
                            {{ $anggota->nama_anggota }}
                        </option>
                    @endforeach
                </select>
                @error('id_anggota')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="tgl_pinjam" class="form-label">Tanggal Pinjam *</label>
                <input type="date" name="tgl_pinjam" id="tgl_pinjam" required
                       value="{{ $transaksi->tgl_pinjam }}"
                       class="form-control">
                @error('tgl_pinjam')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="tgl_kembali" class="form-label">Tanggal Harus Kembali *</label>
                <input type="date" name="tgl_kembali" id="tgl_kembali" required
                       value="{{ $transaksi->tgl_kembali }}"
                       class="form-control">
                @error('tgl_kembali')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4 mb-3">
                <label for="tgl_pengembalian" class="form-label">Tanggal Pengembalian</label>
                <input type="date" name="tgl_pengembalian" id="tgl_pengembalian"
                       value="{{ $transaksi->tgl_pengembalian }}"
                       class="form-control">
                <small class="text-muted">Kosongkan jika belum dikembalikan</small>
                @error('tgl_pengembalian')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fp" class="form-label">Status *</label>
                <select name="fp" id="fp" required class="form-select" onchange="toggleDendaFields()">
                    <option value="0" {{ $transaksi->fp == 0 ? 'selected' : '' }}>Dipinjam</option>
                    <option value="1" {{ $transaksi->fp == 1 ? 'selected' : '' }}>Selesai</option>
                    <option value="2" {{ $transaksi->fp == 2 ? 'selected' : '' }}>Hilang</option>
                </select>
                @error('fp')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan"
                       value="{{ $transaksi->keterangan }}"
                       class="form-control">
                @error('keterangan')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Input Denda Manual - HANYA TAMPIL JIKA STATUS SELESAI ATAU HILANG -->
        <div class="card mb-4" id="dendaSection" style="{{ $transaksi->fp == 1 || $transaksi->fp == 2 ? '' : 'display: none;' }}">
            <div class="card-header bg-light">
                <h5 class="mb-0">
                    <i class="fas fa-calculator me-2"></i> Pengaturan Denda
                    @if($transaksi->fp == 1 && $transaksi->denda_dibayar)
                        <span class="badge bg-success float-end">Denda Lunas</span>
                    @endif
                </h5>
            </div>
            <div class="card-body">
                <!-- Info Penting: Status Selesai tapi belum bayar -->
                @if($transaksi->fp == 1 && $transaksi->total_denda > 0 && !$transaksi->denda_dibayar)
                <div class="alert alert-danger mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2 fa-lg"></i>
                        <div>
                            <strong>PERHATIAN!</strong>
                            <p class="mb-0">Status transaksi adalah <strong>SELESAI</strong> tetapi denda <strong>BELUM DIBAYAR</strong>.</p>
                            <p class="mb-0">Silakan hitung denda terlebih dahulu, kemudian centang "Denda sudah dibayar" jika sudah dibayar.</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Info Batas Waktu -->
                <div class="alert alert-warning mb-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div>
                            <strong>Peraturan Denda:</strong>
                            <ul class="mb-0 ps-3">
                                <li>Batas peminjaman: <strong>3 hari</strong></li>
                                <li>Jika dikembalikan setelah 3 hari, dikenakan denda telat</li>
                                <li>Denda telat: <strong>Rp 6.000 per hari</strong></li>
                                <li>Denda hilang: <strong>Rp 100.000 per buku</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Denda Telat -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="hari_telat" class="form-label">Jumlah Hari Keterlambatan</label>
                        <div class="input-group">
                            <input type="number" name="hari_telat" id="hari_telat" 
                                   class="form-control" min="0" max="365"
                                   value="{{ old('hari_telat', $transaksi->hari_terlambat) }}"
                                   onchange="hitungDendaManual()">
                            <span class="input-group-text">hari</span>
                        </div>
                        <small class="text-muted">Masukkan jumlah hari keterlambatan (0-365)</small>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Denda Telat</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="text" id="denda_telat_display" class="form-control" 
                                   value="{{ number_format($transaksi->denda_telat, 0, ',', '.') }}" readonly>
                            <input type="hidden" name="denda_telat" id="denda_telat" 
                                   value="{{ old('denda_telat', $transaksi->denda_telat) }}">
                        </div>
                        <small class="text-muted">Otomatis: Rp 6.000 × hari keterlambatan</small>
                    </div>
                </div>

                <!-- Denda Hilang -->
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-check">
                            <input type="checkbox" name="denda_hilang_check" id="denda_hilang_check" 
                                   class="form-check-input" 
                                   {{ old('denda_hilang_check', $transaksi->denda_hilang > 0) ? 'checked' : '' }}
                                   onchange="toggleDendaHilang()">
                            <label class="form-check-label" for="denda_hilang_check">
                                <strong>Tandai sebagai denda buku hilang</strong>
                            </label>
                        </div>
                        <small class="text-muted">Jika dicentang, akan dikenakan denda hilang Rp 100.000</small>
                        
                        <div id="denda_hilang_input" style="{{ $transaksi->denda_hilang > 0 ? '' : 'display: none;' }}" class="mt-2">
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" value="100,000" readonly>
                                <input type="hidden" name="denda_hilang" id="denda_hilang" 
                                       value="{{ old('denda_hilang', $transaksi->denda_hilang > 0 ? 100000 : 0) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Denda dan Status Bayar -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert {{ $transaksi->denda_dibayar ? 'alert-success' : 'alert-warning' }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="mb-1">Total Denda</h6>
                                    <h4 class="mb-0" id="total_denda_display">
                                        Rp {{ number_format($transaksi->total_denda, 0, ',', '.') }}
                                    </h4>
                                    <input type="hidden" name="total_denda" id="total_denda" 
                                           value="{{ old('total_denda', $transaksi->total_denda) }}">
                                    @if($transaksi->fp == 1 && $transaksi->total_denda > 0)
                                        <div class="mt-2">
                                            <small class="{{ $transaksi->denda_dibayar ? 'text-success' : 'text-danger' }}">
                                                <i class="fas {{ $transaksi->denda_dibayar ? 'fa-check-circle' : 'fa-exclamation-circle' }} me-1"></i>
                                                {{ $transaksi->denda_dibayar ? 'Denda sudah dibayar' : 'Denda BELUM dibayar' }}
                                            </small>
                                        </div>
                                    @endif
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="denda_dibayar" id="denda_dibayar" 
                                           class="form-check-input" 
                                           {{ old('denda_dibayar', $transaksi->denda_dibayar) ? 'checked' : '' }}
                                           onchange="updateStatusBayar()">
                                    <label class="form-check-label" for="denda_dibayar">
                                        <strong>Denda sudah dibayar</strong>
                                    </label>
                                    <div class="form-text">
                                        Centang hanya jika denda sudah dibayar
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- PERINGATAN: Status selesai tapi belum bayar -->
                <div id="warningBelumBayar" class="alert alert-danger" 
                     style="{{ $transaksi->fp == 1 && $transaksi->total_denda > 0 && !$transaksi->denda_dibayar ? '' : 'display: none;' }}">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <div>
                            <strong>PERINGATAN!</strong>
                            <p class="mb-0">Status transaksi akan diubah menjadi <strong>SELESAI</strong> tetapi denda <strong>BELUM DIBAYAR</strong>.</p>
                            <p class="mb-0">Pastikan Anda telah menghitung denda dengan benar sebelum menyimpan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <div>
                <a href="{{ route('transaksi.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-1"></i> Batal
                </a>
                <a href="{{ route('transaksi.showDenda', $transaksi->id_transaksi) }}" class="btn btn-info">
                    <i class="fas fa-money-bill-wave me-1"></i> Detail Denda
                </a>
            </div>
            <div>
                <button type="button" class="btn btn-success me-2" onclick="hitungDendaOtomatis()">
                    <i class="fas fa-calculator me-1"></i> Hitung Denda Otomatis
                </button>
                <button type="button" class="btn btn-warning me-2" onclick="cekBatasWaktu()">
                    <i class="fas fa-clock me-1"></i> Cek Batas Waktu
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-1"></i> Update Transaksi
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Validasi stok buku saat edit
    const selectBuku = document.getElementById('id_pustaka');
    
    selectBuku.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const stock = parseInt(selectedOption.getAttribute('data-stock'));
        
        if (stock < 1) {
            alert('Buku ini tidak tersedia (stok habis)');
            this.value = '{{ $transaksi->id_pustaka }}';
        }
    });
    
    // Inisialisasi hitung denda saat halaman dimuat
    updateDendaDisplay();
    toggleDendaFields();
    
    // Event listener untuk input hari telat
    const hariTelatInput = document.getElementById('hari_telat');
    hariTelatInput.addEventListener('input', function() {
        hitungDendaManual();
        checkWarning();
    });
    
    // Event listener untuk status
    const statusSelect = document.getElementById('fp');
    statusSelect.addEventListener('change', function() {
        checkWarning();
    });
});

function toggleDendaFields() {
    const statusSelect = document.getElementById('fp');
    const status = statusSelect.value;
    const tglPengembalian = document.getElementById('tgl_pengembalian');
    const dendaSection = document.getElementById('dendaSection');
    
    if (status == '1' || status == '2') { // Selesai atau Hilang
        dendaSection.style.display = 'block';
        if (!tglPengembalian.value && status == '1') {
            tglPengembalian.value = new Date().toISOString().split('T')[0];
        }
        
        if (status == '2') { // Hilang
            // Otomatis centang denda hilang
            document.getElementById('denda_hilang_check').checked = true;
            toggleDendaHilang();
            
            // Set total denda minimal 100.000
            const currentDenda = parseInt(document.getElementById('total_denda').value) || 0;
            if (currentDenda < 100000) {
                document.getElementById('denda_hilang').value = 100000;
                hitungTotalDenda();
            }
            
            // Tampilkan peringatan
            if (!confirm('PERHATIAN: Mengubah status menjadi "Hilang" akan mengakibatkan denda minimal Rp 100.000. Lanjutkan?')) {
                statusSelect.value = '{{ $transaksi->fp }}';
                toggleDendaFields();
                return;
            }
        }
    } else {
        dendaSection.style.display = 'none';
    }
    
    // Update denda display
    updateDendaDisplay();
    checkWarning();
}

function cekBatasWaktu() {
    const tglPinjam = document.getElementById('tgl_pinjam').value;
    const tglPengembalian = document.getElementById('tgl_pengembalian').value;
    const tglKembali = document.getElementById('tgl_kembali').value;
    
    if (!tglPinjam || !tglPengembalian) {
        alert('Harap isi tanggal pinjam dan tanggal pengembalian terlebih dahulu');
        return;
    }
    
    const datePinjam = new Date(tglPinjam);
    const datePengembalian = new Date(tglPengembalian);
    const dateKembali = new Date(tglKembali);
    
    // Hitung selisih hari sejak pinjam
    const diffTimePinjam = datePengembalian - datePinjam;
    const diffDaysPinjam = Math.ceil(diffTimePinjam / (1000 * 60 * 60 * 24));
    
    // Hitung selisih hari dari tanggal kembali
    const diffTimeKembali = datePengembalian - dateKembali;
    const diffDaysKembali = Math.ceil(diffTimeKembali / (1000 * 60 * 60 * 24));
    
    let hariTelat = 0;
    let pesan = '';
    
    // Cek apakah melewati batas 3 hari
    if (diffDaysPinjam > 3) {
        hariTelat = diffDaysPinjam - 3;
        pesan = `Buku dipinjam selama ${diffDaysPinjam} hari (melewati batas 3 hari).\n`;
        pesan += `Keterlambatan: ${hariTelat} hari. Denda: Rp ${formatRupiah(hariTelat * 6000)}`;
    } else if (diffDaysKembali > 0) {
        hariTelat = diffDaysKembali;
        pesan = `Keterlambatan dari tanggal harus kembali: ${hariTelat} hari.\n`;
        pesan += `Denda: Rp ${formatRupiah(hariTelat * 6000)}`;
    } else {
        pesan = 'Tidak ada keterlambatan. Buku dikembalikan sesuai batas waktu.';
    }
    
    if (hariTelat > 0) {
        document.getElementById('hari_telat').value = hariTelat;
        hitungDendaManual();
    }
    
    alert(pesan);
    checkWarning();
}

function hitungDendaOtomatis() {
    const tglPinjam = document.getElementById('tgl_pinjam').value;
    const tglKembali = document.getElementById('tgl_kembali').value;
    const tglPengembalian = document.getElementById('tgl_pengembalian').value;
    
    if (!tglPengembalian) {
        alert('Harap isi tanggal pengembalian terlebih dahulu');
        return;
    }
    
    const datePinjam = new Date(tglPinjam);
    const dateKembali = new Date(tglKembali);
    const datePengembalian = new Date(tglPengembalian);
    
    // Hitung selisih dari tanggal kembali
    const diffTimeKembali = datePengembalian - dateKembali;
    const diffDaysKembali = Math.ceil(diffTimeKembali / (1000 * 60 * 60 * 24));
    
    // Hitung selisih dari tanggal pinjam
    const diffTimePinjam = datePengembalian - datePinjam;
    const diffDaysPinjam = Math.ceil(diffTimePinjam / (1000 * 60 * 60 * 24));
    
    let hariTelat = 0;
    let pesan = '';
    
    // Prioritas: cek apakah melewati batas 3 hari sejak pinjam
    if (diffDaysPinjam > 3) {
        hariTelat = diffDaysPinjam - 3;
        pesan = `Melewati batas 3 hari peminjaman.\nTerlambat ${hariTelat} hari. Denda: Rp ${formatRupiah(hariTelat * 6000)}`;
    } else if (diffDaysKembali > 0) {
        hariTelat = diffDaysKembali;
        pesan = `Terlambat ${hariTelat} hari dari tanggal harus kembali.\nDenda: Rp ${formatRupiah(hariTelat * 6000)}`;
    } else {
        hariTelat = 0;
        pesan = 'Tidak ada keterlambatan';
    }
    
    document.getElementById('hari_telat').value = hariTelat;
    hitungDendaManual();
    checkWarning();
    alert(pesan);
}

function toggleDendaHilang() {
    const dendaHilangCheck = document.getElementById('denda_hilang_check');
    const dendaHilangInput = document.getElementById('denda_hilang_input');
    const dendaHilangValue = document.getElementById('denda_hilang');
    
    if (dendaHilangCheck.checked) {
        dendaHilangInput.style.display = 'block';
        dendaHilangValue.value = 100000;
    } else {
        dendaHilangInput.style.display = 'none';
        dendaHilangValue.value = 0;
    }
    
    hitungTotalDenda();
    checkWarning();
}

function hitungDendaManual() {
    const hariTelat = parseInt(document.getElementById('hari_telat').value) || 0;
    const dendaPerHari = 6000;
    const dendaTelat = hariTelat * dendaPerHari;
    
    // Update tampilan dan hidden input
    document.getElementById('denda_telat_display').value = formatRupiah(dendaTelat);
    document.getElementById('denda_telat').value = dendaTelat;
    
    hitungTotalDenda();
}

function hitungTotalDenda() {
    const dendaTelat = parseInt(document.getElementById('denda_telat').value) || 0;
    const dendaHilang = parseInt(document.getElementById('denda_hilang').value) || 0;
    const totalDenda = dendaTelat + dendaHilang;
    
    document.getElementById('total_denda_display').innerHTML = formatRupiah(totalDenda);
    document.getElementById('total_denda').value = totalDenda;
    
    // Update warna alert berdasarkan jumlah denda
    const totalDendaAlert = document.querySelector('#dendaSection .alert');
    if (totalDenda > 0) {
        totalDendaAlert.classList.remove('alert-success', 'alert-warning');
        totalDendaAlert.classList.add('alert-warning');
    } else {
        totalDendaAlert.classList.remove('alert-warning', 'alert-success');
        totalDendaAlert.classList.add('alert-success');
    }
}

function updateDendaDisplay() {
    hitungDendaManual();
    hitungTotalDenda();
}

function updateStatusBayar() {
    const dendaDibayar = document.getElementById('denda_dibayar').checked;
    const totalDenda = parseInt(document.getElementById('total_denda').value) || 0;
    const totalDendaAlert = document.querySelector('#dendaSection .alert');
    
    if (totalDenda > 0) {
        if (dendaDibayar) {
            totalDendaAlert.classList.remove('alert-warning');
            totalDendaAlert.classList.add('alert-success');
        } else {
            totalDendaAlert.classList.remove('alert-success');
            totalDendaAlert.classList.add('alert-warning');
        }
    }
    checkWarning();
}

function checkWarning() {
    const status = document.getElementById('fp').value;
    const totalDenda = parseInt(document.getElementById('total_denda').value) || 0;
    const dendaDibayar = document.getElementById('denda_dibayar').checked;
    const warningDiv = document.getElementById('warningBelumBayar');
    
    if (status == '1' && totalDenda > 0 && !dendaDibayar) {
        warningDiv.style.display = 'block';
    } else {
        warningDiv.style.display = 'none';
    }
}

function formatRupiah(angka) {
    return 'Rp ' + angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Event listener untuk submit form - PERBAIKAN UTAMA
document.getElementById('editForm').addEventListener('submit', function(e) {
    const status = document.getElementById('fp').value;
    const totalDenda = parseInt(document.getElementById('total_denda').value) || 0;
    const dendaDibayar = document.getElementById('denda_dibayar').checked;
    const tglPengembalian = document.getElementById('tgl_pengembalian').value;
    
    // Validasi: Jika status Selesai, harus ada tanggal pengembalian
    if (status == '1' && !tglPengembalian) {
        alert('Status Selesai membutuhkan tanggal pengembalian!');
        e.preventDefault();
        return false;
    }
    
    // Validasi: Jika status Selesai dan ada denda, berikan peringatan
    if (status == '1' && totalDenda > 0 && !dendaDibayar) {
        if (!confirm(`PERINGATAN: Status akan diubah menjadi SELESAI dengan denda Rp ${formatRupiah(totalDenda)} yang BELUM DIBAYAR.\n\nApakah Anda yakin?`)) {
            e.preventDefault();
            return false;
        }
    }
    
    // Validasi: Jika status Hilang, pastikan denda hilang dicentang
    if (status == '2') {
        const dendaHilangCheck = document.getElementById('denda_hilang_check').checked;
        if (!dendaHilangCheck) {
            if (!confirm('Status diubah menjadi Hilang tetapi denda hilang tidak dicentang. Lanjutkan?')) {
                e.preventDefault();
                return false;
            }
        }
    }
    
    // Validasi: Jika denda sudah dibayar dipilih, pastikan ada denda
    if (dendaDibayar && totalDenda == 0) {
        alert('Tidak bisa mencentang "Denda sudah dibayar" jika tidak ada denda!');
        e.preventDefault();
        return false;
    }
    
    return true;
});
</script>

<style>
.input-group-text {
    min-width: 45px;
    justify-content: center;
}
.form-check-input {
    margin-top: 0.3rem;
}
.card-header {
    background-color: #f8f9fa !important;
}
#warningBelumBayar {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0% { opacity: 0.8; }
    50% { opacity: 1; }
    100% { opacity: 0.8; }
}
</style>
@endsection