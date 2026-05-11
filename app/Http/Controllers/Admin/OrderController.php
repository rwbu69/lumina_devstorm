<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
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
