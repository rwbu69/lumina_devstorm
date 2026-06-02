<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function index(Request $request, CartService $cartService): View
    {
        $query = Book::query()->with('category');

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($subQuery) use ($q): void {
                $subQuery->where('judul', 'like', "%{$q}%")
                    ->orWhere('penulis', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $books = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::all();

        return view('catalog.index', [
            'books' => $books,
            'categories' => $categories,
            'cartService' => $cartService,
        ]);
    }

    public function show(Book $book, CartService $cartService): View
    {
        $book->load('category');
        
        $relatedBooks = Book::query()
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->take(4)
            ->get();

        return view('catalog.show', [
            'book' => $book,
            'relatedBooks' => $relatedBooks,
            'cartService' => $cartService,
        ]);
    }
}
