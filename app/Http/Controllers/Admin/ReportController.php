<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'orderDetails.book'])
            ->whereIn('status', ['verified', 'cancelled']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($qu) use ($search) {
                      $qu->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Date Range Filter
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_pesan', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_pesan', '<=', $request->end_date);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'oldest' => $query->oldest('tanggal_pesan'),
            'highest' => $query->orderByDesc('total_tagihan'),
            'lowest' => $query->orderBy('total_tagihan'),
            default => $query->latest('tanggal_pesan'),
        };

        $orders = $query->paginate(10)->withQueryString();

        return view('admin.reports.index', compact('orders'));
    }

    public function exportPdf(Request $request)
    {
        $query = Order::with(['user', 'orderDetails.book'])
            ->whereIn('status', ['verified', 'cancelled']);

        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($qu) use ($search) {
                      $qu->where('nama', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status', $request->status);
        }

        // Date Range Filter
        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_pesan', '>=', $request->start_date);
        }
        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_pesan', '<=', $request->end_date);
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        match ($sort) {
            'oldest' => $query->oldest('tanggal_pesan'),
            'highest' => $query->orderByDesc('total_tagihan'),
            'lowest' => $query->orderBy('total_tagihan'),
            default => $query->latest('tanggal_pesan'),
        };

        $orders = $query->get();
        
        $pdf = Pdf::loadView('admin.reports.pdf', [
            'orders' => $orders,
            'title' => 'Laporan Penjualan Lumina Media',
            'date' => now()->format('d F Y')
        ]);

        return $pdf->download('laporan-penjualan-' . now()->format('Y-m-d') . '.pdf');
    }
}
