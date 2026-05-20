<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ReportController extends Controller
{
    public function index(): Response
    {
        return response('Admin ReportController@index (TODO)', 200);
    }

    public function exportPdf(): Response
    {
        return response('Admin ReportController@exportPdf (TODO)', 501);
    }
}
