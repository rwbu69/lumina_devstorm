<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        return response('CartController@index (TODO)', 200);
    }
}
