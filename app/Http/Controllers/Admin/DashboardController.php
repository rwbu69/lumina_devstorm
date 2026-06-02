<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\Order;
use App\Models\User;
use App\Models\Book;
use Illuminate\Support\Carbon;
=======
use App\Models\Book;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
<<<<<<< HEAD
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

        return view('admin.dashboard', compact(
            'totalPenjualan',
            'penjualanGrowth',
            'totalPengguna',
            'penggunaGrowth',
            'totalBuku',
            'monthlyRevenue',
            'monthLabels',
            'totalInventaris',
            'recentOrders',
        ));
=======
        $now = now();

        $currentMonthStart = $now->copy()->startOfMonth();
        $currentMonthEnd = $now->copy()->endOfMonth();
        $previousMonthStart = $now->copy()->subMonthNoOverflow()->startOfMonth();
        $previousMonthEnd = $now->copy()->subMonthNoOverflow()->endOfMonth();
        $chartStart = $now->copy()->subMonthsNoOverflow(5)->startOfMonth();
        $chartEnd = $currentMonthEnd;

        $currentRevenue = (float) Order::query()
            ->where('status', 'verified')
            ->whereBetween('tanggal_pesan', [$currentMonthStart, $currentMonthEnd])
            ->sum('total_tagihan');

        $previousRevenue = (float) Order::query()
            ->where('status', 'verified')
            ->whereBetween('tanggal_pesan', [$previousMonthStart, $previousMonthEnd])
            ->sum('total_tagihan');

        $totalBooks = Book::query()->count();
        $previousBooksTotal = Book::query()
            ->where('created_at', '<', $currentMonthStart)
            ->count();

        $activeUsers = User::query()
            ->where('role', 'user')
            ->whereHas('orders', function ($query) use ($currentMonthStart, $currentMonthEnd): void {
                $query->where('status', '!=', 'cancelled')
                    ->whereBetween('tanggal_pesan', [$currentMonthStart, $currentMonthEnd]);
            })
            ->count();

        $previousActiveUsers = User::query()
            ->where('role', 'user')
            ->whereHas('orders', function ($query) use ($previousMonthStart, $previousMonthEnd): void {
                $query->where('status', '!=', 'cancelled')
                    ->whereBetween('tanggal_pesan', [$previousMonthStart, $previousMonthEnd]);
            })
            ->count();

        $inventoryValue = (float) Book::query()->sum('harga');

        $chartOrders = Order::query()
            ->where('status', 'verified')
            ->whereBetween('tanggal_pesan', [$chartStart, $chartEnd])
            ->get();

        $monthlyRevenue = collect(range(5, 0))->map(function (int $offset) use ($now, $chartOrders): array {
            $date = $now->copy()->subMonthsNoOverflow($offset)->startOfMonth();
            $monthKey = $date->format('Y-m');

            $amount = (float) $chartOrders
                ->filter(function (Order $order) use ($monthKey): bool {
                    return $order->tanggal_pesan?->format('Y-m') === $monthKey;
                })
                ->sum('total_tagihan');

            return [
                'label' => $this->monthShortLabel($date),
                'amount' => $amount,
            ];
        });

        $maxRevenue = max(1.0, (float) $monthlyRevenue->max('amount'));

        $monthlyRevenue = $monthlyRevenue->map(function (array $point) use ($maxRevenue): array {
            $height = $point['amount'] > 0
                ? max(14, (int) round(($point['amount'] / $maxRevenue) * 100))
                : 8;

            return [
                'label' => $point['label'],
                'amount' => $point['amount'],
                'amountLabel' => $this->rupiah($point['amount']),
                'height' => $height,
            ];
        })->all();

        $recentActivities = Order::query()
            ->with(['user', 'orderDetails.book', 'payment'])
            ->latest('tanggal_pesan')
            ->take(5)
            ->get()
            ->map(function (Order $order): array {
                $bookTitles = $order->orderDetails
                    ->map(fn ($detail) => $detail->book?->judul)
                    ->filter()
                    ->values();

                return [
                    'customer' => $order->user?->nama ?? '-',
                    'bookSummary' => $bookTitles->isNotEmpty() ? $bookTitles->take(2)->implode(', ') : '-',
                    'bookCount' => $bookTitles->count(),
                    'status' => $order->status,
                    'amount' => $this->rupiah((float) $order->total_tagihan),
                    'dateLabel' => $order->tanggal_pesan?->format('d M Y, H:i') ?? '-',
                    'paymentLabel' => $order->payment?->metode_pembayaran,
                ];
            })
            ->all();

        return view('admin.dashboard', [
            'pageTitle' => 'Halaman Utama',
            'periodLabel' => $this->monthYearLabel($now),
            'metrics' => [
                [
                    'label' => 'Total Penjualan',
                    'value' => $this->rupiah($currentRevenue),
                    'trend' => $this->trendData($currentRevenue, $previousRevenue, 'vs bulan lalu', 'vs bulan lalu'),
                    'icon' => 'bi-credit-card',
                ],
                [
                    'label' => 'Pengguna Aktif',
                    'value' => number_format($activeUsers, 0, ',', '.'),
                    'trend' => $this->trendData((float) $activeUsers, (float) $previousActiveUsers, 'vs bulan lalu', 'vs bulan lalu'),
                    'icon' => 'bi-person-check',
                ],
                [
                    'label' => 'Total Buku',
                    'value' => number_format($totalBooks, 0, ',', '.'),
                    'trend' => $this->trendData((float) $totalBooks, (float) $previousBooksTotal, 'stok baru tersedia', 'stok menurun'),
                    'icon' => 'bi-journal-bookmark',
                ],
            ],
            'inventoryValue' => $this->rupiah($inventoryValue),
            'monthlyRevenue' => $monthlyRevenue,
            'recentActivities' => $recentActivities,
        ]);
    }

    private function trendData(float $current, float $previous, string $positiveNote, string $negativeNote): array
    {
        $change = $this->percentageChange($current, $previous);
        $isPositive = $change >= 0;
        $prefix = $change > 0 ? '+' : '';

        return [
            'label' => $prefix.number_format(abs($change), 1, ',', '.').'%',
            'tone' => $isPositive ? 'success' : 'danger',
            'note' => $isPositive ? $positiveNote : $negativeNote,
        ];
    }

    private function percentageChange(float $current, float $previous): float
    {
        if ($previous <= 0) {
            return $current > 0 ? 100.0 : 0.0;
        }

        return (($current - $previous) / $previous) * 100;
    }

    private function rupiah(float|int $value): string
    {
        return 'Rp '.number_format((float) $value, 0, ',', '.');
    }

    private function monthShortLabel(Carbon $date): string
    {
        return match ((int) $date->month) {
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des',
        };
    }

    private function monthYearLabel(Carbon $date): string
    {
        return $this->monthShortLabel($date).' '.$date->year;
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
    }
}
