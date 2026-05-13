<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Response;

class CatalogController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->latest()->paginate(12);
        return view('catalog.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book->load('category');
        return view('catalog.show', compact('book'));
    }
}
