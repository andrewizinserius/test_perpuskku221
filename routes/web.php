<?php

use App\Http\Controllers\ReservasiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\AnggotaController;
use App\Http\Controllers\admin\JenisAnggotaController;
use App\Http\Controllers\admin\DdcController;
use App\Http\Controllers\admin\FormatsController;
use App\Http\Controllers\admin\RakController;
use App\Http\Controllers\admin\PenerbitController;
use App\Http\Controllers\admin\PengarangController;
use App\Http\Controllers\admin\PustakaController;
use App\Http\Controllers\admin\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\WelcomeController;


// Public Routes
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('logout', function() {
    Auth::logout();
    return redirect()->route('welcome');
})->name('logout');

// User Routes (Authenticated Users)
Route::middleware(['auth'])->group(function () {
    // Dashboard User dengan tampilan buku langsung
    Route::get('/user/dashboard', [UserController::class, 'indexBuku'])->name('user.index');
    
    // Detail buku
    Route::get('/user/buku/{id}', [UserController::class, 'show'])->name('user.buku.show');
    
    // Riwayat transaksi
    Route::get('/user/transaksi', [ReservasiController::class, 'transaksi'])->name('buku.transaksi');

    // ============================
    // 🔥 ROUTE RESERVASI YANG DIPERBAIKI
    // ============================
    // Route untuk menampilkan form reservasi
    Route::get('/reservasi/{id}', [ReservasiController::class, 'create'])
        ->name('buku.formReservasi');
    
    // Route untuk menyimpan reservasi
    Route::post('/reservasi/{id}', [ReservasiController::class, 'reservasi'])
        ->name('buku.storeReservasi');
    
    // Route lama untuk kompatibilitas (opsional)
    Route::get('/buku/{id}', [BukuController::class, 'show'])->name('buku.detail');
});

// Admin Routes (Authenticated + Check Role)
Route::prefix('admin')->middleware(['auth', 'checkRole:Y'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    
    // Dashboard API routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/chart-data', [DashboardController::class, 'getChartDataApi']);
        Route::get('/stats', [DashboardController::class, 'getStatsApi']);
    });
    
    // CRUD Routes
    Route::resource('anggota', AnggotaController::class);
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::delete('/anggota/{id}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');
    
    Route::resource('jenisanggota', JenisAnggotaController::class);
    Route::resource('rak', RakController::class);
    Route::resource('ddc', DdcController::class);
    Route::resource('formats', FormatsController::class);
    Route::resource('penerbit', PenerbitController::class);
    Route::resource('pengarang', PengarangController::class);
    Route::resource('pustaka', PustakaController::class);
    
    // Transaksi Routes dengan fitur denda
    Route::resource('transaksi', TransaksiController::class);
    
    // Additional Transaksi Routes
    Route::post('transaksi/{id}/return', [TransaksiController::class, 'returnBook'])
        ->name('transaksi.returnBook');
        
    Route::post('transaksi/{id}/lost', [TransaksiController::class, 'markAsLost'])
        ->name('transaksi.markAsLost');
        
    Route::post('transaksi/{id}/pay-denda', [TransaksiController::class, 'payDenda'])
        ->name('transaksi.payDenda');
        
    Route::get('transaksi/{id}/denda', [TransaksiController::class, 'showDenda'])
        ->name('transaksi.showDenda');
        
    // Fitur reset ID
    Route::get('transaksi/reset-auto-increment', [TransaksiController::class, 'resetAutoIncrement'])
        ->name('transaksi.resetAutoIncrement');
        
    Route::get('transaksi/compact-ids', [TransaksiController::class, 'compactIds'])
        ->name('transaksi.compactIds');
});