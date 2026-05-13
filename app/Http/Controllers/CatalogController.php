<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Response;

class CatalogController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Book::query()->with('category');

        // Filter by Category
        if ($request->filled('categories')) {
            $query->whereIn('category_id', $request->categories);
        }

        // Filter by Price Range
        if ($request->filled('min_price')) {
            $query->where('harga', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('harga', '<=', $request->max_price);
        }

        // Sort
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'price_low':
                $query->orderBy('harga', 'asc');
                break;
            case 'price_high':
                $query->orderBy('harga', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $books = $query->paginate(9)->withQueryString();
        $categories = \App\Models\Category::withCount('books')->get();
        
        return view('catalog.index', compact('books', 'categories'));
    }

    public function show(Book $book)
    {
        $book->load('category');
        return view('catalog.show', compact('book'));
    }
}
