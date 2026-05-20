<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        // 1. Ambil data buku utama untuk tabel (menggunakan pagination 10 data)
        $books = Book::latest()->paginate(10);
        
        // 2. Ambil semua data buku dari DB untuk menghitung statistik secara aman
        $allBooks = Book::all();

        // 3. Hitung statistik menggunakan properti dinamis (mengantisipasi kolom 'stok' vs 'stock')
        $totalJudul = $allBooks->count();
        
        $stokRendah = $allBooks->filter(function ($book) {
            // Memeriksa apakah database kamu memakai nama kolom 'stok' atau 'stock'
            $jumlahStok = $book->stok ?? $book->stock ?? 0;
            return $jumlahStok < 15;
        })->count();

        $totalTerjual = $allBooks->sum(function ($book) {
            return $book->terjual ?? $book->sold ?? 0;
        });
        
        $valuasiStok = $allBooks->sum(function ($book) {
            $jumlahStok = $book->stok ?? $book->stock ?? 0;
            return ($book->price ?? 0) * $jumlahStok;
        });

        // 4. Kirim seluruh variabel ke file view blade
        return view('admin.books.index', compact(
            'books', 
            'totalJudul', 
            'stokRendah', 
            'totalTerjual', 
            'valuasiStok'
        ));
    }

    public function create(): View
    {
        return view('admin.books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        Book::create($validated);

        return redirect()->route('admin.books.index');
    }

    public function show(Book $book): View
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);

        $book->update($validated);

        return redirect()->route('admin.books.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Buku berhasil dihapus secara real-time.'
            ]);
        }

        return redirect()->route('admin.books.index');
    }
}