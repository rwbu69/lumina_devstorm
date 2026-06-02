<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        // ── KPI Cards ─────────────────────────────────────────────────────
        $now        = Carbon::now();
        $thisMonth  = $now->copy()->startOfMonth();
        $lastMonth  = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();

        // Total penjualan (hanya verified)
        $totalPenjualan     = Order::where('status', 'verified')->sum('total_tagihan');
        $penjualanBulanIni  = Order::where('status', 'verified')->where('tanggal_pesan', '>=', $thisMonth)->sum('total_tagihan');
        $penjualanBulanLalu = Order::where('status', 'verified')
                                ->whereBetween('tanggal_pesan', [$lastMonth, $lastMonthEnd])
                                ->sum('total_tagihan');

        $penjualanGrowth = $penjualanBulanLalu > 0
            ? round((($penjualanBulanIni - $penjualanBulanLalu) / $penjualanBulanLalu) * 100, 1)
            : 0;

        // Total pengguna aktif (role = user)
        $totalPengguna     = User::where('role', 'user')->count();
        $penggunaBulanIni  = User::where('role', 'user')->where('created_at', '>=', $thisMonth)->count();
        $penggunaBulanLalu = User::where('role', 'user')
                                ->whereBetween('created_at', [$lastMonth, $lastMonthEnd])
                                ->count();
        $penggunaGrowth = $penggunaBulanLalu > 0
            ? round((($penggunaBulanIni - $penggunaBulanLalu) / $penggunaBulanLalu) * 100, 1)
            : 0;

        // Total buku
        $totalBuku = Book::count();

        // ── Monthly Revenue Chart (last 6 months) ─────────────────────────
        $monthlyRevenue = [];
        $monthLabels    = [];

        for ($i = 5; $i >= 0; $i--) {
            $month       = $now->copy()->subMonths($i);
            $monthLabels[] = $month->translatedFormat('M Y');

            $revenue = Order::where('status', 'verified')
                ->whereYear('tanggal_pesan',  $month->year)
                ->whereMonth('tanggal_pesan', $month->month)
                ->sum('total_tagihan');

            $monthlyRevenue[] = (int) $revenue;
        }

        // ── Total Inventaris (all verified orders) ─────────────────────────
        $totalInventaris = Order::where('status', 'verified')->sum('total_tagihan');

        // ── Recent Activities (last 5 orders) ─────────────────────────────
        $recentOrders = Order::with(['user', 'orderDetails.book'])
            ->latest('tanggal_pesan')
            ->take(5)
            ->get();

        // ── Mapping Variables for Modern Dashboard View ──────────────────
        $pageTitle = 'Dashboard';
        $periodLabel = $now->translatedFormat('F Y');

        $metrics = [
            [
                'label' => 'Total Penjualan',
                'value' => 'Rp ' . number_format((float)$totalPenjualan, 0, ',', '.'),
                'trend' => [
                    'tone' => $penjualanGrowth >= 0 ? 'success' : 'danger',
                    'label' => ($penjualanGrowth >= 0 ? '+' : '') . $penjualanGrowth . '%',
                    'note' => 'vs bulan lalu'
                ],
                'icon' => 'bi-credit-card'
            ],
            [
                'label' => 'Pengguna Aktif',
                'value' => number_format((int)$totalPengguna, 0, ',', '.'),
                'trend' => [
                    'tone' => $penggunaGrowth >= 0 ? 'success' : 'danger',
                    'label' => ($penggunaGrowth >= 0 ? '+' : '') . $penggunaGrowth . '%',
                    'note' => 'vs bulan lalu'
                ],
                'icon' => 'bi-person-check'
            ],
            [
                'label' => 'Total Buku',
                'value' => number_format((int)$totalBuku, 0, ',', '.'),
                'trend' => [
                    'tone' => 'muted',
                    'label' => '-',
                    'note' => 'judul tersedia'
                ],
                'icon' => 'bi-journal-bookmark'
            ]
        ];

        $inventoryValue = 'Rp ' . number_format((float)$totalInventaris, 0, ',', '.');

        $maxRev = empty($monthlyRevenue) ? 1 : max($monthlyRevenue);
        if ($maxRev == 0) $maxRev = 1;
        
        $monthlyRevenueData = [];
        foreach ($monthlyRevenue as $i => $rev) {
            $monthlyRevenueData[] = [
                'height' => ($rev / $maxRev) * 100,
                'label' => $monthLabels[$i],
                'amountLabel' => 'Rp ' . number_format($rev, 0, ',', '.')
            ];
        }

        $recentActivities = [];
        foreach ($recentOrders as $order) {
            $firstItem = $order->orderDetails->first();
            $bookSummary = $firstItem ? $firstItem->book->judul : '-';
            if ($order->orderDetails->count() > 1) {
                $bookSummary .= ' (+' . ($order->orderDetails->count() - 1) . ')';
            }
            $recentActivities[] = [
                'customer' => $order->user->nama ?? 'Unknown',
                'dateLabel' => $order->tanggal_pesan->translatedFormat('d M Y H:i'),
                'bookSummary' => $bookSummary,
                'bookCount' => $order->orderDetails->count(),
                'paymentLabel' => 'Transfer',
                'status' => $order->status,
                'amount' => 'Rp ' . number_format((float)$order->total_tagihan, 0, ',', '.')
            ];
        }

        return view('admin.dashboard', [
            'pageTitle' => $pageTitle,
            'periodLabel' => $periodLabel,
            'metrics' => $metrics,
            'inventoryValue' => $inventoryValue,
            'monthlyRevenue' => $monthlyRevenueData,
            'chartLabels' => $monthLabels,
            'chartData' => $monthlyRevenue,
            'recentActivities' => $recentActivities,
        ]);
    }
}
