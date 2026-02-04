<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pustaka;
use App\Models\Anggota;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function indexBuku()
    {
        // Ambil semua buku dari database
        $books = Pustaka::with(['pengarang', 'penerbit', 'ddc'])
            ->where('jml_book', '>', 0) // Hanya buku yang tersedia
            ->orderBy('judul_pustaka', 'asc')
            ->get();
        
        // Hitung statistik
        $availableBooks = Pustaka::where('jml_book', '>', 0)->count();
        $borrowedBooks = Transaksi::where('fp', 0)->count();
        $totalCategories = 8; // Dummy data kategori
        
        // Categorize books based on keyword or other criteria
        $books->each(function($book) {
            // Determine category based on keyword or title
            $keyword = strtolower($book->keyword ?? '');
            $title = strtolower($book->judul_pustaka);
            
            if (str_contains($keyword, 'novel') || str_contains($title, 'novel')) {
                $book->kategori = 'novel';
            } elseif (str_contains($keyword, 'pelajaran') || str_contains($title, 'matematika') || str_contains($title, 'fisika') || str_contains($title, 'kimia')) {
                $book->kategori = 'pelajaran';
            } elseif (str_contains($keyword, 'ilmiah') || str_contains($title, 'sains')) {
                $book->kategori = 'ilmiah';
            } elseif (str_contains($keyword, 'sejarah') || str_contains($title, 'sejarah')) {
                $book->kategori = 'sejarah';
            } elseif (str_contains($keyword, 'teknologi') || str_contains($title, 'komputer') || str_contains($title, 'programming')) {
                $book->kategori = 'teknologi';
            } elseif (str_contains($keyword, 'fiksi') || str_contains($title, 'fantasi')) {
                $book->kategori = 'fiksi';
            } elseif (str_contains($keyword, 'biografi') || str_contains($title, 'biografi')) {
                $book->kategori = 'biografi';
            } else {
                $book->kategori = 'lainnya';
            }
        });

        return view('user.index', compact('books', 'availableBooks', 'borrowedBooks', 'totalCategories'));
    }
    
    public function show($id)
    {
        $book = Pustaka::with(['pengarang', 'penerbit', 'ddc'])->findOrFail($id);
        return view('user.book-detail', compact('book'));
    }
}