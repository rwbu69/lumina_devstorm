<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $transaksiTerbaru = OrderDetail::with(['order.user', 'book'])
            ->latest('id')
            ->limit(10)
            ->get()
            ->map(fn ($item) => (object) [
                'nama_pelanggan' => $item->order->user->nama,
                'nama_buku' => $item->book->judul,
                'status' => $item->order->status,
                'total_harga' => $item->harga_saat_beli,
            ]);

        return view('admin.dashboard', compact('transaksiTerbaru'));
    }
}
