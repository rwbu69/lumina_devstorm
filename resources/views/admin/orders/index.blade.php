<x-admin.layout :title="'Lumina Media - Pesanan Admin'">
    @push('styles')
        <style>
            .orders-shell {
                background: linear-gradient(180deg, #f7f2e7 0%, #f3eddc 100%);
                border-radius: 28px;
                padding: 18px;
            }

            .orders-card {
                border: 1px solid rgba(15, 23, 42, .08);
                border-radius: 20px;
                background: rgba(255, 255, 255, .92);
                box-shadow: 0 14px 28px rgba(15, 23, 42, .05);
                overflow: hidden;
            }

            .orders-title {
                margin: 0;
                color: #1559c7;
                font-size: clamp(1.75rem, 3vw, 2.35rem);
                font-weight: 800;
                line-height: 1.05;
                letter-spacing: -.03em;
            }

            .orders-subtitle {
                margin-top: .4rem;
                color: rgba(17, 24, 39, .68);
            }

            .orders-table .card-header {
                padding: 14px 16px 10px;
            }

            .orders-table .table thead th {
                color: rgba(17, 24, 39, .52);
                font-size: .75rem;
                letter-spacing: .08em;
                padding-top: 14px;
                padding-bottom: 14px;
            }

            .orders-table .table-responsive {
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
            }

            .orders-table .table {
                min-width: 980px;
                margin-bottom: 0;
                table-layout: fixed;
            }

            .orders-table .table tbody td {
                padding-top: 16px;
                padding-bottom: 16px;
                vertical-align: middle;
                border-color: rgba(15, 23, 42, .05);
            }

            .orders-table tbody tr:hover {
                background: rgba(13, 110, 253, .02);
            }

            .orders-meta {
                color: rgba(17, 24, 39, .58);
                font-size: .84rem;
            }

            .orders-id {
                color: #1559c7;
                font-weight: 800;
                letter-spacing: -.03em;
            }

            .orders-scroll-hint {
                display: none;
                align-items: center;
                gap: .5rem;
                margin-top: .75rem;
                color: rgba(17, 24, 39, .58);
                font-size: .82rem;
            }

            @media (max-width: 991.98px) {
                .orders-shell {
                    border-radius: 20px;
                    padding: 14px;
                }

                .orders-scroll-hint {
                    display: inline-flex;
                }
            }

            @media (max-width: 767.98px) {
                .orders-table .card-header {
                    padding-inline: 14px;
                }

                .orders-table .table thead th,
                .orders-table .table tbody td {
                    padding-inline: 14px;
                }
            }
        </style>
    @endpush

    <div class="orders-shell">
        <x-admin.section-header
            title="Pesanan"
            subtitle="Daftar seluruh transaksi yang masuk ke sistem."
        >
            <a href="{{ route('admin.dashboard') }}" class="btn btn-light border rounded-3">
                <i class="bi bi-arrow-left me-2"></i>
                Kembali ke Dashboard
            </a>
        </x-admin.section-header>

        <div class="mt-4"></div>

        <x-admin.table :headers="['Order ID', 'Tanggal', 'Pelanggan', 'Produk', 'Total', 'Status']" class="orders-card orders-table">
            <x-slot:header>
                <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                    <div>
                        <div class="fw-bold text-dark">Semua Pesanan</div>
                        <div class="orders-meta">Menampilkan {{ $orders->total() }} transaksi.</div>
                    </div>
                </div>
                <div class="orders-scroll-hint">
                    <i class="bi bi-arrow-left-right"></i>
                    Geser kiri kanan untuk melihat kolom lain.
                </div>
            </x-slot:header>

            @forelse ($orders as $order)
                @php
                    $books = $order->orderDetails->map(fn ($detail) => $detail->book?->judul)->filter()->values();
                    $orderId = '#ORD-'.optional($order->tanggal_pesan)->format('Y').'-'.str_pad((string) $order->id, 3, '0', STR_PAD_LEFT);
                @endphp

                <tr>
                    <td>
                        <div class="orders-id">{{ $orderId }}</div>
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $order->tanggal_pesan?->translatedFormat('d M Y') ?? '-' }}</div>
                        <div class="orders-meta">{{ $order->tanggal_pesan?->format('H:i') ?? '-' }}</div>
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $order->user?->nama ?? '-' }}</div>
                        <div class="orders-meta">{{ $order->user?->email ?? '-' }}</div>
                    </td>
                    <td>
                        <div class="fw-semibold">{{ $books->take(2)->implode(', ') ?: '-' }}</div>
                        <div class="orders-meta">{{ $books->count() }} buku</div>
                    </td>
                    <td class="fw-semibold text-end">Rp {{ number_format((float) $order->total_tagihan, 0, ',', '.') }}</td>
                    <td><x-badge :status="$order->status" /></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-5">
                        <div class="text-center">
                            <div class="fw-semibold">Data belum tersedia</div>
                            <div class="orders-meta">Belum ada pesanan yang dapat ditampilkan.</div>
                        </div>
                    </td>
                </tr>
            @endforelse
        </x-admin.table>

        <div class="mt-3">
            {{ $orders->links() }}
        </div>
    </div>
</x-admin.layout>