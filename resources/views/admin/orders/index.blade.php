<<<<<<< HEAD
<x-admin.layout :title="'Lumina Media - Pesanan'">
    <x-admin.section-header
        title="Pesanan"
        subtitle="Kelola dan verifikasi transaksi pelanggan Lumina Media secara efisien."
    >
        <a href="{{ route('admin.orders.exportPdf') }}" class="btn text-white px-4 py-2 rounded-3 d-flex align-items-center gap-2" style="background-color: #1D4ED8; font-weight: 500; border: none; font-size: 14px; border-radius: 8px !important;">
            <i class="bi bi-download"></i>
            Ekspor
        </a>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="card border-0 mb-4" style="background-color: #F8F9FA; border-radius: 16px; padding: 24px;">
        <div class="position-relative mb-3">
            <span class="position-absolute top-50 translate-middle-y text-muted" style="left: 18px;">
                <i class="bi bi-search" style="color: #9CA3AF;"></i>
            </span>
            <input 
                type="text" 
                name="search" 
                class="form-control border-0 py-2.5" 
                style="padding-left: 48px; height: 48px; background-color: #fff; font-size: 14px; border-radius: 10px; color: #4B5563;"
                placeholder="Cari berdasarkan nama pelanggan atau ID pesanan..."
                value="{{ request('search') }}"
            >
        </div>
        
        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('admin.orders.index', ['status' => 'semua']) }}" 
               class="btn rounded-pill px-4 py-1.5 fw-medium text-sm transition-all" 
               style="{{ !request('status') || request('status') === 'semua' ? 'background-color: #fff; border: 1px solid #E5E7EB; color: #111827; font-size: 13px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);' : 'background-color: transparent; border: 1px solid transparent; color: #4B5563; font-size: 13px;' }}">
                Semua Pesanan
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" 
               class="btn rounded-pill px-4 py-1.5 fw-medium text-sm transition-all" 
               style="{{ request('status') === 'pending' ? 'background-color: #fff; border: 1px solid #E5E7EB; color: #111827; font-size: 13px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);' : 'background-color: transparent; border: 1px solid transparent; color: #4B5563; font-size: 13px;' }}">
                Pending
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'verified']) }}" 
               class="btn rounded-pill px-4 py-1.5 fw-medium text-sm transition-all" 
               style="{{ request('status') === 'verified' ? 'background-color: #fff; border: 1px solid #E5E7EB; color: #111827; font-size: 13px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);' : 'background-color: transparent; border: 1px solid transparent; color: #4B5563; font-size: 13px;' }}">
                Terverifikasi
            </a>
            <a href="{{ route('admin.orders.index', ['status' => 'rejected']) }}" 
               class="btn rounded-pill px-4 py-1.5 fw-medium text-sm transition-all" 
               style="{{ request('status') === 'rejected' ? 'background-color: #fff; border: 1px solid #E5E7EB; color: #111827; font-size: 13px; box-shadow: 0 1px 2px rgba(0,0,0,0.05);' : 'background-color: transparent; border: 1px solid transparent; color: #4B5563; font-size: 13px;' }}">
                Dibatalkan
            </a>
        </div>
    </div>

    <div class="card border-0 bg-white p-4 mb-4 shadow-sm" style="border-radius: 16px;">
        
        <div class="d-none d-md-flex pb-3 mb-2 text-secondary fw-bold align-items-center" style="font-size: 12px; letter-spacing: 0.8px; color: #6B7280 !important;">
            <div style="width: 25%;">NAMA PEMBELI</div>
            <div style="width: 20%;">TANGGAL PESAN</div>
            <div style="width: 20%;">TOTAL BAYAR</div>
            <div style="width: 20%;">STATUS PEMBAYARAN</div>
            <div style="width: 15%; text-align: right;" class="pe-3">AKSI</div>
        </div>

        @forelse($orders as $order)
            @php
                // Logika Inisial Nama (Ahmad Fauzi -> AF)
                $namaUser = $order->user->nama ?? 'User';
                $words = explode(' ', $namaUser);
                $initials = strtoupper(substr($words[0], 0, 1) . (isset($words[1]) ? substr($words[1], 0, 1) : ''));
                
                // Format tanggal rapi ala Indonesia (24 Mei 2024)
                $tanggalFormatted = $order->tanggal_pesan ? \Carbon\Carbon::parse($order->tanggal_pesan)->translatedFormat('d M Y') : '-';
            @endphp
            
            <div class="d-flex flex-column flex-md-row align-items-start align-items-md-center py-3">
                
                <div style="width: 25%;" class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center justify-content-center rounded-circle fw-semibold" 
                         style="width: 40px; height: 40px; background-color: #EBF2FC; color: #4B729F; font-size: 13px; flex-shrink: 0;">
                        {{ $initials }}
                    </div>
                    <div>
                        <span class="fw-bold text-dark" style="font-size: 15px; color: #111827 !important;">{{ $namaUser }}</span>
                    </div>
                </div>

                <div style="width: 20%; font-size: 14px; color: #374151;">
                    {{ $tanggalFormatted }}
                </div>

                <div style="width: 20%; font-size: 15px; color: #111827 !important;" class="fw-bold">
                    Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                </div>

                <div style="width: 20%;">
                    @php
                        $status = $order->payment ? $order->payment->status_verifikasi : 'pending';
                    @endphp

                    @if($status === 'approved' || $status === 'verified')
                        <span class="badge rounded-pill fw-bold d-inline-flex align-items-center gap-1" style="background-color: #E6F9F0; color: #10B981; padding: 6px 14px; font-size: 11px; border: none; letter-spacing: 0.5px;">
                            <span style="font-size: 8px; margin-right: 2px;">●</span> VERIFIED
                        </span>
                    @elseif($status === 'rejected')
                        <span class="badge rounded-pill fw-bold d-inline-flex align-items-center gap-1" style="background-color: #FEE2E2; color: #EF4444; padding: 6px 14px; font-size: 11px; border: none; letter-spacing: 0.5px;">
                            <span style="font-size: 8px; margin-right: 2px;">●</span> DIBATALKAN
                        </span>
                    @else
                        <span class="badge rounded-pill fw-bold d-inline-flex align-items-center gap-1" style="background-color: #FEF3C7; color: #F59E0B; padding: 6px 14px; font-size: 11px; border: none; letter-spacing: 0.5px;">
                            <span style="font-size: 8px; margin-right: 2px;">●</span> PENDING
                        </span>
                    @endif
                </div>

                <div style="width: 15%;" class="d-flex flex-column gap-1 align-items-md-end justify-content-center pe-3">
                    <a href="{{ route('admin.orders.show', $order) }}" 
                       class="btn btn-sm bg-white border text-dark fw-medium d-flex align-items-center justify-content-center" 
                       style="font-size: 11px; width: 95px; height: 28px; border-radius: 6px; box-shadow: 0px 1px 2px rgba(0,0,0,0.05); border-color: #E5E7EB !important; color: #374151 !important;">
                        Lihat Detail
                    </a>
                    @if(!$order->payment || $order->payment->status_verifikasi === 'pending')
                        <a href="{{ route('admin.orders.show', $order) }}" 
                           class="btn btn-sm bg-white border text-dark fw-medium d-flex align-items-center justify-content-center" 
                           style="font-size: 11px; width: 95px; height: 28px; border-radius: 6px; box-shadow: 0px 1px 2px rgba(0,0,0,0.05); border-color: #E5E7EB !important; color: #374151 !important;">
                            Verifikasi
                        </a>
                    @endif
                </div>

            </div>
        @empty
            <div class="text-center text-muted py-5">
                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                Tidak ada pesanan ditemukan
            </div>
        @endforelse

        @if($orders->hasPages())
            <div class="mt-4 d-flex justify-content-between align-items-center pt-3" style="border-top: 1px solid #F3F4F6;">
                <p class="text-muted small mb-0" style="color: #6B7280 !important; font-size: 13px;">
                    Menampilkan {{ $orders->firstItem() }}-{{ $orders->lastItem() }} dari {{ $orders->total() }} pesanan
                </p>
                <div class="d-flex gap-2">
                    @if($orders->onFirstPage())
                        <span class="btn btn-sm bg-white border text-muted disabled px-3 py-1" style="font-size: 13px; border-radius: 6px; border-color: #E5E7EB !important;">Sebelumnya</span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}" class="btn btn-sm bg-white border text-dark px-3 py-1" style="font-size: 13px; border-radius: 6px; border-color: #E5E7EB !important;">Sebelumnya</a>
                    @endif

                    @if($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}" class="btn btn-sm bg-white border px-3 py-1 fw-medium" style="font-size: 13px; border-radius: 6px; border-color: #1D4ED8 !important; color: #1D4ED8 !important;">Selanjutnya</a>
                    @else
                        <span class="btn btn-sm bg-white border text-muted disabled px-3 py-1" style="font-size: 13px; border-radius: 6px; border-color: #E5E7EB !important;">Selanjutnya</span>
                    @endif
                </div>
            </div>
        @endif

=======
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
>>>>>>> 119abaed4471ed88d14553c91de94961bcc5ce60
    </div>
</x-admin.layout>