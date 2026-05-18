<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReportController extends Controller
{
    private const PAYMENT_METHODS = [
        'transfer_bank' => 'Transfer Bank',
        'cod' => 'COD',
        'ewallet' => 'E-Wallet',
        'virtual_account' => 'Virtual Account',
    ];

    public function index(Request $request): View
    {
        $filters = $this->filters($request);
        $reports = $this->paginatedReportRows($filters, $request, 10);

        return view('admin.reports.index', [
            'reports' => $reports,
            'filters' => $filters,
            'paymentMethods' => self::PAYMENT_METHODS,
        ]);
    }

    public function exportPdf(Request $request)
    {
        $filters = $this->validatedFilters($request);
        $reports = $this->reportRows($filters);

        if ($reports->isEmpty()) {
            return $this->emptyReportFailure($request, 'Tidak ada data penjualan yang sesuai dengan filter yang dipilih.');
        }

        $fileName = 'laporan-penjualan-'.now()->format('Y-m-d').'.pdf';

        $pdf = Pdf::loadView('admin.reports.pdf', [
            'reports' => $reports,
            'filters' => $filters,
            'exportedAt' => now(),
            'appName' => config('app.name', 'Lumina Media'),
        ])->setPaper('a4', 'landscape');

        return response($pdf->output(), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$fileName.'"',
        ]);
    }

    private function reportQuery(array $filters): Builder
    {
        return Order::query()
            ->with(['user', 'orderDetails.book', 'payment'])
            ->when($filters['search'], function (Builder $query, string $search): void {
                $query->where(function (Builder $searchQuery) use ($search): void {
                    $searchQuery->where('id', 'like', '%'.$search.'%')
                        ->orWhereHas('user', function (Builder $userQuery) use ($search): void {
                            $userQuery->where('nama', 'like', '%'.$search.'%');
                        })
                        ->orWhereHas('orderDetails.book', function (Builder $bookQuery) use ($search): void {
                            $bookQuery->where('judul', 'like', '%'.$search.'%');
                        });
                });
            })
            ->when($filters['status'], function (Builder $query, string $status): void {
                $query->where('status', $status);
            })
            ->when($filters['tanggal_awal'], function (Builder $query, string $tanggalAwal): void {
                $query->whereDate('tanggal_pesan', '>=', Carbon::createFromFormat('Y-m-d', $tanggalAwal));
            })
            ->when($filters['tanggal_akhir'], function (Builder $query, string $tanggalAkhir): void {
                $query->whereDate('tanggal_pesan', '<=', Carbon::createFromFormat('Y-m-d', $tanggalAkhir));
            })
            ->when($filters['metode_pembayaran'], function (Builder $query, string $metodePembayaran): void {
                $query->whereHas('payment', function (Builder $paymentQuery) use ($metodePembayaran): void {
                    $paymentQuery->where('metode_pembayaran', $metodePembayaran);
                });
            })
            ->orderByDesc('tanggal_pesan');
    }

    private function reportRows(array $filters): Collection
    {
        return $this->reportQuery($filters)
            ->get()
            ->map(function (Order $order): array {
                $orderDetails = $order->orderDetails;

                return [
                    'id_penjualan' => $order->id,
                    'nama_pelanggan' => $order->user?->nama ?? '-',
                    'produk' => $orderDetails->map(fn ($detail) => $detail->book?->judul)->filter()->implode(', '),
                    'tanggal_label' => optional($order->tanggal_pesan)->translatedFormat('d M Y'),
                    'jam_label' => optional($order->tanggal_pesan)->format('H:i'),
                    'jumlah_barang' => $orderDetails->count(),
                    'total_harga' => (float) $order->total_tagihan,
                    'status' => $order->status,
                    'metode_pembayaran' => $order->payment?->metode_pembayaran ?? '-',
                    'tanggal_transaksi' => $order->tanggal_pesan,
                ];
            });
    }

    private function paginatedReportRows(array $filters, Request $request, int $perPage): LengthAwarePaginator
    {
        $rows = $this->reportRows($filters);
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $rows->forPage($currentPage, $perPage)->values();

        return new LengthAwarePaginator($items, $rows->count(), $perPage, $currentPage, [
            'path' => $request->url(),
            'query' => $request->query(),
        ]);
    }

    private function filters(Request $request): array
    {
        $search = trim($request->string('search')->toString());
        $status = trim($request->string('status')->toString());
        $tanggalAwal = $request->string('tanggal_awal')->toString();
        $tanggalAkhir = $request->string('tanggal_akhir')->toString();

        return [
            'search' => $search !== '' ? $search : null,
            'status' => in_array($status, ['pending', 'verified', 'cancelled'], true) ? $status : null,
            'tanggal_awal' => filled($tanggalAwal) && Carbon::hasFormat($tanggalAwal, 'Y-m-d') ? $tanggalAwal : null,
            'tanggal_akhir' => filled($tanggalAkhir) && Carbon::hasFormat($tanggalAkhir, 'Y-m-d') ? $tanggalAkhir : null,
            'metode_pembayaran' => $request->string('metode_pembayaran')->toString() ?: null,
        ];
    }

    private function validatedFilters(Request $request): array
    {
        $validator = Validator::make($request->all(), [
            'tanggal_awal' => ['nullable', 'date_format:Y-m-d'],
            'tanggal_akhir' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:tanggal_awal'],
            'metode_pembayaran' => ['nullable', 'in:'.implode(',', array_keys(self::PAYMENT_METHODS))],
        ], [
            'tanggal_awal.date_format' => 'Tanggal awal harus menggunakan format yang valid.',
            'tanggal_akhir.date_format' => 'Tanggal akhir harus menggunakan format yang valid.',
            'tanggal_akhir.after_or_equal' => 'Tanggal akhir harus sama atau setelah tanggal awal.',
            'metode_pembayaran.in' => 'Metode pembayaran tidak valid.',
        ]);

        if ($validator->fails()) {
            $message = $validator->errors()->first();

            if ($request->ajax()) {
                throw new HttpResponseException(response()->json([
                    'message' => $message,
                ], 422));
            }

            throw ValidationException::withMessages([
                'report' => $message,
            ]);
        }

        return $this->filters($request);
    }

    private function emptyReportFailure(Request $request, string $message): never
    {
        if ($request->ajax()) {
            throw new HttpResponseException(response()->json([
                'message' => $message,
            ], 422));
        }

        throw ValidationException::withMessages([
            'report' => $message,
        ]);
    }
}
