<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Response;

class CatalogController extends Controller
{
    public function index(): Response
    {
        // Ganti teks TODO kemarin dengan memanggil file dashboard.blade.php
        return response(view('dashboard'));
    }

    public function show(Book $book): Response
    {
        return response('CatalogController@show book_id='.$book->id.' (TODO)', 200);
    }
}