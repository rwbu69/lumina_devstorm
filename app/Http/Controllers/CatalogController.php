<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Response;

class CatalogController extends Controller
{
    public function index(): Response
    {
        return response('CatalogController@index (TODO)', 200);
    }

    public function show(Book $book): Response
    {
        return response('CatalogController@show book_id='.$book->id.' (TODO)', 200);
    }
}
