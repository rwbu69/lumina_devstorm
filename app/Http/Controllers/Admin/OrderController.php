<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
<<<<<<< HEAD
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
=======
use Illuminate\Http\Response;
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
use Illuminate\View\View;

class OrderController extends Controller
{
<<<<<<< HEAD
    public function index(Request $request): View
    {
        $query = Order::with(['user', 'payment']);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Search by user name or order ID
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('nama', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('orders'));
=======
    public function index(): View
    {
        $orders = Order::query()
            ->with(['user', 'orderDetails.book', 'payment'])
            ->latest('tanggal_pesan')
            ->paginate(10);

        return view('admin.orders.index', [
            'orders' => $orders,
        ]);
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
    }

    public function verify(Order $order): RedirectResponse
    {
        $order->update(['status' => 'verified']);
        
        if ($order->payment) {
            $order->payment->update(['status_verifikasi' => 'approved']);
        }

        return back()->with('success', 'Pembayaran berhasil diverifikasi.');
    }

    public function reject(Order $order): RedirectResponse
    {
        $order->update(['status' => 'cancelled']);

        if ($order->payment) {
            $order->payment->update(['status_verifikasi' => 'rejected']);
        }

        return back()->with('error', 'Pembayaran ditolak.');
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with(['user', 'payment']);

        // Filter by status if provided (same as index)
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Search by user name or order ID (same as index)
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($uq) use ($search) {
                    $uq->where('nama', 'like', "%{$search}%");
                })->orWhere('id', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->get();

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('admin.orders.pdf', compact('orders'));
        
        $filename = 'laporan-pesanan-' . now()->format('Y-m-d') . '.pdf';
        return $pdf->download($filename);
    }
}
