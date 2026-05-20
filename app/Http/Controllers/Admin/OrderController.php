<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        return response('Admin OrderController@index (TODO)', 200);
    }

    public function exportPdf(): Response
    {
        return response('Admin OrderController@exportPdf (TODO)', 501);
    }
}
