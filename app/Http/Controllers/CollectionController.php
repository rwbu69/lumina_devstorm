<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CollectionController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();

        $books = Book::query()
            ->whereHas('orderDetails.order', function ($query) use ($userId): void {
                $query->where('user_id', $userId)
                    ->where('status', 'verified');
            })
            ->with('category')
            ->get();

        return view('collection.index', [
            'books' => $books,
        ]);
    }
}
