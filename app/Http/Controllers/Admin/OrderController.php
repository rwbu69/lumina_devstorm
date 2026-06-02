<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Response;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::query()
            ->with(['user', 'orderDetails.book', 'payment'])
            ->latest('tanggal_pesan')
            ->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function exportPdf(): Response
    {
        return response('Admin OrderController@exportPdf (TODO)', 501);
    }
}
