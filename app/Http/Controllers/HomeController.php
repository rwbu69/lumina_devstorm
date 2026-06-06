<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use App\Services\DailyVerseService;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Menampilkan halaman utama Lumina Media dengan 4 buku terbaru
     * dan ayat Alkitab harian secara dinamis.
     */
    public function index(DailyVerseService $dailyVerseService): View
    {
        $latestBooks = Book::query()    
            ->latest()
            ->take(4)
            ->get();

        $dailyVerse = $dailyVerseService->getDailyVerse();

        return view('home', [
            'latestBooks' => $latestBooks,
            'dailyVerse'  => $dailyVerse,
        ]);
    }
}