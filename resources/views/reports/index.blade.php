<x-admin.layout title="Lumina Media - Laporan Penjualan">
    <div class="container py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-2" style="color: #0047ba; font-size: 2.5rem; font-weight: bold;">Laporan Penjualan</h1>
                <p class="text-secondary mb-0">Kelola dan pantau seluruh data transaksi penjualan Lumina Media dalam periode berjalan.</p>
            </div>
            <button type="button" class="btn btn-primary px-4 py-2 d-flex align-items-center rounded-3 shadow-sm border-0" style="background-color: #0047ba;">
                <i class="bi bi-file-earmark-pdf me-2 fs-5"></i>
                <span class="fw-semibold">Ekspor PDF</span>
            </button>
        </div>

        <!-- Search & Filter Bar -->
        <div class="card border-0 shadow-sm rounded-4 mb-4" style="background-color: #ffffff;">
            <div class="card-body p-3">
                <div class="row g-3 align-items-center">
                    <div class="col">
                        <div class="input-group bg-light rounded-3 border-0">
                            <span class="input-group-text bg-transparent border-0 pe-0 ps-3">
                                <i class="bi bi-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control bg-transparent border-0 py-2 shadow-none" placeholder="Cari Order ID atau pelanggan..." style="font-size: 0.9rem;">
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex align-items-center gap-3">
                            <select class="form-select border-0 bg-light rounded-3 py-2 shadow-none" style="min-width: 150px; cursor: pointer;">
                                <option selected>Semua Status</option>
                                <option>Berhasil</option>
                                <option>Proses</option>
                                <option>Dibatalkan</option>
                            </select>
                            <div class="vr text-muted opacity-25" style="height: 24px;"></div>
                            <button class="btn btn-light bg-transparent border-0 p-1">
                                <i class="bi bi-calendar3 fs-5 text-muted"></i>
                            </button>
                            <button class="btn btn-light bg-transparent border-0 p-1">
                                <i class="bi bi-filter fs-5 text-muted"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Section -->
        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
            <div class="table-responsive">
                <table class="table mb-0 align-middle bg-white">
                    <thead class="bg-white">
                        <tr>
                            <th class="ps-4 py-4 small fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">ORDER ID</th>
                            <th class="py-4 small fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">TANGGAL</th>
                            <th class="py-4 small fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">PELANGGAN</th>
                            <th class="py-4 small fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">PRODUK</th>
                            <th class="py-4 small fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">JUMLAH</th>
                            <th class="pe-4 py-4 small fw-bold text-muted text-uppercase" style="font-size: 0.75rem; letter-spacing: 0.05em;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                            @php
                                $names = explode(' ', $order->user->nama);
                                $initials = strtoupper(substr($names[0], 0, 1) . (isset($names[1]) ? substr($names[1], 0, 1) : ''));
                                
                                // Map status to colors
                                $statusMap = [
                                    'verified' => ['bg' => '#dcfce7', 'text' => '#166534', 'label' => 'Berhasil'],
                                    'pending'  => ['bg' => '#fef9c3', 'text' => '#854d0e', 'label' => 'Proses'],
                                    'cancelled' => ['bg' => '#fee2e2', 'text' => '#991b1b', 'label' => 'Dibatalkan'],
                                ];
                                $status = $statusMap[$order->status] ?? ['bg' => '#f1f5f9', 'text' => '#475569', 'label' => $order->status];
                            @endphp
                            <tr class="border-bottom">
                                <td class="ps-4 py-4">
                                    <span class="fw-bold" style="color: #0047ba;">#ORD-{{ $order->tanggal_pesan->format('Y') }}-{{ str_pad((string)$order->id, 3, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td class="py-4 text-muted">{{ $order->tanggal_pesan->translatedFormat('d M Y') }}</td>
                                <td class="py-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle me-2 d-flex align-items-center justify-content-center text-primary fw-bold" style="width: 36px; height: 36px; background-color: #e0f2fe; font-size: 0.8rem;">
                                            {{ $initials }}
                                        </div>
                                        <span class="fw-semibold text-dark">{{ $order->user->nama }}</span>
                                    </div>
                                </td>
                                <td class="py-4 text-muted">
                                    {{ $order->orderDetails->first()?->book->judul ?? '-' }}
                                    @if($order->orderDetails->count() > 1)
                                        <span class="small text-muted">(+{{ $order->orderDetails->count() - 1 }})</span>
                                    @endif
                                </td>
                                <td class="py-4">
                                    <span class="fw-bold">Rp {{ number_format((float)$order->total_tagihan, 0, ',', '.') }}</span>
                                </td>
                                <td class="pe-4 py-4">
                                    <span class="badge rounded-pill px-3 py-2 fw-medium" style="background-color: {{ $status['bg'] }}; color: {{ $status['text'] }};">
                                        {{ $status['label'] }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Belum ada data transaksi.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Footer Section inside card -->
            <div class="card-footer bg-white border-0 p-4">
                <div class="d-flex justify-content-end align-items-center">

                    <div class="pagination-container">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 mb-4">
        <p class="small text-uppercase fw-bold text-muted" style="letter-spacing: 0.1em; font-size: 0.7rem; opacity: 0.5;">
            &copy; 2024 LUMINA MEDIA DASHBOARD. ALL RIGHTS RESERVED.
        </p>
    </div>

    @push('styles')
    <style>
        body { background-color: #fdfbf7; }
        .table thead th { border-bottom: none; }
        .table tbody tr:last-child { border-bottom: none !important; }
        .form-select { background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e"); }
        .btn-outline-primary:hover { background-color: #1e40af; color: white; border-color: #1e40af; }
        .pagination { margin-bottom: 0; gap: 4px; }
        .page-link { 
            border-radius: 8px !important; 
            padding: 6px 12px; 
            min-width: 38px;
            text-align: center;
            font-size: 0.9rem; 
            color: #64748b; 
            border: 1px solid #f1f5f9; 
            background-color: #ffffff;
            transition: all 0.2s ease;
            box-shadow: none !important;
        }
        .page-item.active .page-link { 
            background-color: #0047ba; 
            border-color: #0047ba; 
            color: #ffffff;
            font-weight: 500;
        }
        .page-item:not(.active) .page-link:hover { 
            background-color: #f8fafc; 
            color: #0047ba; 
            border-color: #e2e8f0;
        }
        .page-item.disabled .page-link {
            background-color: #f1f5f9;
            border-color: #f1f5f9;
            color: #94a3b8;
        }
    </style>
    @endpush
    <style>
        .table {
            --bs-table-bg: #ffffff;
            background-color: #ffffff !important;
        }
        .table tbody tr td {
            background-color: #ffffff !important;
        }
    </style>
</x-admin.layout>