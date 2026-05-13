<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Models\Order;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['user', 'orderDetails.book'])
            ->latest()
            ->paginate(10);

        return view('reports.index', compact('orders'));
    }

    public function exportPdf(): Response
    {
        return response('Admin ReportController@exportPdf (TODO)', 501);
    }
}
