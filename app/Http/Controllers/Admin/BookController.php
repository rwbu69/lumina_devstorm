<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::query()
            ->with('category')
            ->orderBy('id', 'desc')
            ->paginate(15);

        $totalJudul = Book::count();
        $stokRendah = Book::where('stok', '<', 50)->count();
        
        $terjualBulanIni = \App\Models\OrderDetail::whereHas('order', function ($query) {
            $query->where('status', 'verified')
                  ->whereMonth('tanggal_pesan', now()->month)
                  ->whereYear('tanggal_pesan', now()->year);
        })->count();

        $valuasiStok = Book::sum(\Illuminate\Support\Facades\DB::raw('harga * stok'));
        $categories = Category::all();

        return view('admin.books.index', compact('books', 'totalJudul', 'stokRendah', 'terjualBulanIni', 'valuasiStok', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string',
            'format' => 'required|string|in:fisik,digital', 
            'file_buku' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', 
        ]);

        $data = $request->only(['judul', 'penulis', 'category_id', 'harga', 'stok', 'sinopsis', 'format']);

        if ($request->hasFile('file_buku')) {
            $data['file_buku'] = $request->file('file_buku')->store('books', 'public');
        }

        Book::create($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan!');
    }

    public function show(Book $book): View
    {
        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'sinopsis' => 'nullable|string',
            'format' => 'required|string|in:fisik,digital', 
            'file_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', 
        ]);

        $data = $request->only(['judul', 'penulis', 'category_id', 'harga', 'stok', 'sinopsis', 'format']);

        if ($request->hasFile('file_buku')) {
            if ($book->file_buku) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->file_buku);
            }
            $data['file_buku'] = $request->file('file_buku')->store('books', 'public');
        }

        $book->update($data);

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil diperbarui!');
    }

    public function destroy(Book $book): RedirectResponse
    {
        if ($book->file_buku) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->file_buku);
        }

        $book->orderDetails()->delete();
        $book->delete();

        return redirect()->route('admin.books.index')
            ->with('success', "Buku \"{$book->judul}\" berhasil dihapus.");
    }
}
