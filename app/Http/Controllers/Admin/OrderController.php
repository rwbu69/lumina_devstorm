<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $query = Order::with(['user', 'payment'])
            ->latest('tanggal_pesan');

        // Filter berdasarkan status
        if ($request->has('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Pencarian berdasarkan nama pembeli
        if ($request->has('search') && $request->search) {
            $query->whereHas('user', function ($q) {
                $q->where('nama', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%');
            });
        }

        $orders = $query->paginate(5);
        $stats = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'verified' => Order::where('status', 'verified')->count(),
            'rejected' => Order::where('status', 'rejected')->count(),
        ];

        return view('admin.orders.index', compact('orders', 'stats'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'orderDetails.book', 'payment']);
        return view('admin.orders.show', compact('order'));
    }

    public function verify(Request $request, Order $order)
    {
        $action = $request->input('action');

        if (!$order->payment) {
            return redirect()->back()->with('error', 'Belum ada pembayaran untuk pesanan ini.');
        }

        if ($action === 'approve') {
            $order->payment->update(['status_verifikasi' => 'approved']);
            $order->update(['status' => 'verified']);
            return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi.');
        } elseif ($action === 'reject') {
            $order->payment->update(['status_verifikasi' => 'rejected']);
            $order->update(['status' => 'rejected']);
            return redirect()->back()->with('success', 'Pembayaran berhasil ditolak.');
        }

        return redirect()->back();
    }

    public function exportPdf(): Response
    {
        return response('Admin OrderController@exportPdf (TODO)', 501);
    }
}
