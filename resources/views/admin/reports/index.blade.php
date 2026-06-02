<<<<<<< HEAD
<x-admin.layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 fw-bold text-primary mb-0">Laporan Penjualan</h1>
            <p class="text-muted x-small mb-0">Kelola dan pantau seluruh data transaksi penjualan dalam periode berjalan.</p>
        </div>
        <a href="{{ route('admin.reports.exportPdf', request()->query()) }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm fw-bold btn-sm">
            <i class="bi bi-file-earmark-pdf-fill"></i>
            <span>Ekspor PDF</span>
        </a>
    </div>

    {{-- Filters & Search --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body px-4 py-3">
            <form action="{{ route('admin.reports.index') }}" method="GET" id="filterForm">
                <div class="d-flex align-items-center gap-3">

                    {{-- Search icon + input (flex-grow) --}}
                    <div class="d-flex align-items-center gap-2 flex-grow-1 text-muted">
                        <i class="bi bi-search" style="font-size: 0.85rem; flex-shrink: 0;"></i>
                        <input type="text" name="search"
                               class="form-control border-0 shadow-none p-0 bg-transparent"
                               placeholder="Cari Order ID atau pelanggan..."
                               value="{{ request('search') }}"
                               style="font-size: 0.85rem; height: auto; line-height: 1.4;">
                    </div>

                    {{-- Vertical divider --}}
                    <div style="width: 1px; height: 22px; background: #E5E7EB; flex-shrink: 0;"></div>

                    {{-- Status Select --}}
                    <div class="d-flex align-items-center gap-1" style="flex-shrink: 0; cursor: pointer;">
                        <select name="status"
                                class="form-select border-0 shadow-none p-0 pe-4 bg-transparent"
                                style="font-size: 0.85rem; height: auto; width: auto; min-width: 110px; cursor: pointer; background-position: right 0 center;"
                                onchange="this.form.submit()">
                            <option value="semua" {{ request('status', 'semua') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Berhasil</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>
                    </div>

                    {{-- Vertical divider --}}
                    <div style="width: 1px; height: 22px; background: #E5E7EB; flex-shrink: 0;"></div>

                    {{-- Date Picker trigger --}}
                    <button type="button" id="datePickerTrigger"
                            class="btn p-0 d-flex align-items-center justify-content-center border-0 bg-transparent"
                            style="width: 28px; height: 28px; flex-shrink: 0; color: {{ request('start_date') ? '#1a4fd9' : '#9CA3AF' }};"
                            title="{{ request('start_date') ? request('start_date') . ' – ' . request('end_date') : 'Pilih Rentang Tanggal' }}">
                        <i class="bi bi-calendar" style="font-size: 1rem;"></i>
                    </button>
                    <input type="text" id="dateRangePicker" style="position: absolute; width: 0; height: 0; opacity: 0; pointer-events: none;">
                    <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
                    <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">

                    {{-- Sort / Filter trigger --}}
                    <div class="dropdown" style="flex-shrink: 0;">
                        <button type="button"
                                class="btn p-0 d-flex align-items-center justify-content-center border-0 bg-transparent"
                                style="width: 28px; height: 28px; color: #9CA3AF;"
                                data-bs-toggle="dropdown">
                            <i class="bi bi-filter" style="font-size: 1.15rem;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0 mt-2 p-2" style="min-width: 155px; font-size: 0.85rem; font-family: inherit;">
                            <li><a class="dropdown-item rounded-2 py-2 {{ !request('sort') || request('sort') == 'latest' ? 'active' : '' }}" href="#" onclick="setSort('latest'); return false;">Terbaru</a></li>
                            <li><a class="dropdown-item rounded-2 py-2 {{ request('sort') == 'oldest' ? 'active' : '' }}" href="#" onclick="setSort('oldest'); return false;">Terlama</a></li>
                            <li><hr class="dropdown-divider my-1 mx-1"></li>
                            <li><a class="dropdown-item rounded-2 py-2 {{ request('sort') == 'highest' ? 'active' : '' }}" href="#" onclick="setSort('highest'); return false;">Harga Tertinggi</a></li>
                            <li><a class="dropdown-item rounded-2 py-2 {{ request('sort') == 'lowest' ? 'active' : '' }}" href="#" onclick="setSort('lowest'); return false;">Harga Terendah</a></li>
                        </ul>
                        <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'latest') }}">
                    </div>

                    {{-- Reset Button (conditional) --}}
                    @php
                        $hasActiveFilter = request()->filled('search')
                            || request()->filled('start_date')
                            || (request()->filled('status') && request('status') !== 'semua')
                            || (request()->filled('sort') && request('sort') !== 'latest');
                    @endphp
                    @if($hasActiveFilter)
                        <a href="{{ route('admin.reports.index') }}"
                           class="btn p-0 border-0 bg-transparent text-muted"
                           style="font-size: 0.75rem; flex-shrink: 0;"
                           title="Reset semua filter">
                            <i class="bi bi-x-circle" style="font-size: 1rem;"></i>
                        </a>
                    @endif

                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F9FAFB;">
                    <tr>
                        <th class="px-4 py-3 text-uppercase fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Order ID</th>
                        <th class="px-4 py-3 text-uppercase fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Tanggal</th>
                        <th class="px-4 py-3 text-uppercase fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Pelanggan</th>
                        <th class="px-4 py-3 text-uppercase fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Produk</th>
                        <th class="px-4 py-3 text-uppercase fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Jumlah</th>
                        <th class="px-4 py-3 text-uppercase fw-bold text-muted ls-wide border-0 text-center" style="font-size: 0.7rem;">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($orders as $order)
                        <tr class="border-bottom bg-white">
                            <td class="px-4 py-3 bg-white">
                                <span class="fw-bold text-primary" style="font-size: 0.85rem;">
                                    #ORD-{{ str_pad((string)$order->id, 8, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-muted fw-medium bg-white" style="font-size: 0.85rem;">
                                {{ $order->tanggal_pesan->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 bg-white">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                         style="width: 32px; height: 32px; min-width: 32px; font-size: 0.65rem; background-color: #E8F0FE; color: #1a4fd9;">
                                        {{ strtoupper(substr($order->user->nama, 0, 2)) }}
                                    </div>
                                    <div class="fw-medium text-dark text-truncate" style="font-size: 0.85rem; max-width: 150px;">
                                        {{ $order->user->nama }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-muted bg-white" style="font-size: 0.85rem; max-width: 180px;">
                                @php $firstItem = $order->orderDetails->first(); @endphp
                                <span class="text-truncate d-block">
                                    {{ $firstItem ? $firstItem->book->judul : '-' }}
                                    @if($order->orderDetails->count() > 1)
                                        <span class="text-muted" style="font-size: 0.75rem;">(+{{ $order->orderDetails->count() - 1 }})</span>
                                    @endif
                                </span>
                            </td>
                            <td class="px-4 py-3 fw-bold text-dark bg-white" style="font-size: 0.85rem; white-space: nowrap;">
                                Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-center bg-white">
                                <x-badge :status="$order->status" />
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-5 text-center text-muted bg-white small">
                                Tidak ada data transaksi ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Pagination Footer --}}
        <div class="card-footer p-3 border-top bg-white" style="background-color: #F9FAFB !important;">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted" style="font-size: 0.75rem;">
                    Menampilkan {{ $orders->firstItem() ?? 0 }}-{{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} transaksi
                </div>
                <div class="d-flex gap-2">
                    @if ($orders->onFirstPage())
                        <span class="btn btn-light px-3 py-1 rounded-2 text-muted disabled border-0" style="font-size: 0.75rem;">Sebelumnya</span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}" class="btn btn-light px-3 py-1 rounded-2 text-muted border-0" style="font-size: 0.75rem;">Sebelumnya</a>
                    @endif

                    @if ($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}" class="btn btn-primary px-3 py-1 rounded-2 shadow-sm border-0 fw-bold" style="font-size: 0.75rem;">Selanjutnya</a>
                    @else
                        <span class="btn btn-primary px-3 py-1 rounded-2 shadow-sm border-0 fw-bold disabled opacity-50" style="font-size: 0.75rem;">Selanjutnya</span>
                    @endif
=======
<x-admin.layout :title="'Lumina Media - Laporan Penjualan'">
    @push('styles')
        <style>
            .report-shell {
                background: linear-gradient(180deg, #f7f2e7 0%, #f3eddc 100%);
                border-radius: 28px;
                padding: 18px;
            }

            .report-header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 1rem;
                margin-bottom: 14px;
            }

            .report-title {
                margin: 0;
                color: #1559c7;
                font-size: clamp(1.75rem, 3vw, 2.35rem);
                font-weight: 800;
                line-height: 1.1;
                letter-spacing: -0.03em;
            }

            .report-subtitle {
                margin-top: .45rem;
                color: rgba(17, 24, 39, .68);
                max-width: 58rem;
            }

            .report-export-btn {
                height: 44px;
                border-radius: 999px;
                padding: 0 1.1rem;
                box-shadow: 0 10px 20px rgba(21, 89, 199, .16);
                margin-top: .35rem;
            }

            .report-toolbar,
            .report-card {
                border: 1px solid rgba(15, 23, 42, .08);
                border-radius: 18px;
                background: rgba(255, 255, 255, .92);
                box-shadow: 0 14px 28px rgba(15, 23, 42, .05);
            }

            .report-toolbar {
                padding: 14px;
            }

            .report-input,
            .report-select,
            .report-date {
                min-height: 44px;
                border-radius: 14px;
                background: #f7f9fc;
                border-color: rgba(15, 23, 42, .08);
                box-shadow: none !important;
            }

            .report-input {
                padding-left: 1rem;
            }

            .report-icon-btn {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                border: 1px solid rgba(15, 23, 42, .08);
                background: #fff;
                color: #697386;
            }

            .report-card {
                overflow: hidden;
            }

            .report-card .card-header {
                padding: 14px 16px 10px;
                background: transparent;
                border-bottom: 1px solid rgba(15, 23, 42, .06);
            }

            .report-card .table-responsive {
                overflow-x: auto;
                overflow-y: hidden;
                -webkit-overflow-scrolling: touch;
            }

            .report-card table {
                margin-bottom: 0;
                table-layout: fixed;
                min-width: 980px;
            }

            .report-scroll-hint {
                display: none;
                align-items: center;
                gap: .5rem;
                color: rgba(17, 24, 39, .58);
                font-size: .82rem;
                margin-top: .5rem;
            }

            .report-card thead th {
                background: #f8fafc;
                color: #7a8594;
                font-size: .75rem;
                letter-spacing: .08em;
                padding: 14px 16px;
                border-bottom: 1px solid rgba(15, 23, 42, .08) !important;
            }

            .report-card tbody td {
                padding: 16px;
                vertical-align: middle;
                border-color: rgba(15, 23, 42, .05);
            }

            .report-card tbody tr:hover {
                background: rgba(13, 110, 253, .02);
            }

            .report-id {
                color: #1559c7;
                font-weight: 800;
                line-height: 1.05;
                letter-spacing: -.03em;
            }

            .report-avatar {
                width: 32px;
                height: 32px;
                border-radius: 999px;
                display: grid;
                place-items: center;
                background: #d7e6ff;
                color: #4678d2;
                font-size: .72rem;
                font-weight: 800;
                flex: 0 0 auto;
            }

            .report-meta {
                color: rgba(17, 24, 39, .55);
                font-size: .82rem;
            }

            .report-amount {
                font-weight: 800;
                color: #111827;
            }

            .report-badge {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 84px;
                padding: .35rem .75rem;
                border-radius: 999px;
                font-size: .8rem;
                font-weight: 700;
                white-space: nowrap;
            }

            .report-badge--success { background: #e8f8ee; color: #27ae60; }
            .report-badge--warning { background: #fff3d8; color: #c58a19; }
            .report-badge--danger  { background: #fde8eb; color: #d65a73; }
            .report-badge--secondary { background: #eef2f6; color: #6b7280; }

            .report-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 1rem;
                padding: 10px 16px 14px;
                border-top: 1px solid rgba(15, 23, 42, .06);
                color: rgba(17, 24, 39, .55);
                font-size: .86rem;
                flex-wrap: wrap;
            }

            .report-pager {
                display: inline-flex;
                align-items: center;
                gap: .5rem;
            }

            .report-pager .btn {
                min-height: 34px;
                padding-inline: .9rem;
                border-radius: 999px;
                font-size: .85rem;
            }

            .report-summary {
                white-space: nowrap;
            }

            .filter-modal .modal-content {
                border: 0;
                border-radius: 20px;
                box-shadow: 0 24px 48px rgba(15, 23, 42, .2);
            }

            .filter-modal .modal-header {
                border-bottom: 1px solid rgba(15, 23, 42, .06);
            }

            @media (max-width: 991.98px) {
                .report-shell {
                    border-radius: 20px;
                    padding: 14px;
                }

                .report-header {
                    flex-direction: column;
                }

                .report-export-btn {
                    align-self: flex-start;
                }

                .report-scroll-hint {
                    display: inline-flex;
                }

                .report-footer {
                    align-items: flex-start;
                }
            }

            @media (max-width: 767.98px) {
                .report-toolbar {
                    padding: 12px;
                }

                .report-card .card-header,
                .report-card .table thead th,
                .report-card .table tbody td {
                    padding-inline: 14px;
                }

                .report-pager {
                    width: 100%;
                    justify-content: space-between;
                }

                .report-pager .btn {
                    flex: 1 1 0;
                }
            }
        </style>
    @endpush

    <div class="report-shell">
        <div class="report-header">
            <div>
                <h1 class="report-title">Laporan Penjualan</h1>
                <div class="report-subtitle">Kelola dan pantau seluruh data transaksi penjualan Lumina Media dalam periode berjalan.</div>
            </div>

            <button type="button" class="btn btn-primary report-export-btn" id="export-pdf-button">
                <i class="bi bi-file-earmark-pdf me-2"></i>
                Ekspor PDF
            </button>
        </div>

        <div id="report-alert"></div>

        <div class="report-toolbar mt-3">
            <form id="report-filter-form" method="GET" action="{{ route('admin.reports.index') }}">
                <input type="hidden" name="tanggal_awal" value="{{ $filters['tanggal_awal'] }}">
                <input type="hidden" name="tanggal_akhir" value="{{ $filters['tanggal_akhir'] }}">
                <input type="hidden" name="metode_pembayaran" value="{{ $filters['metode_pembayaran'] }}">

                <div class="row g-3 align-items-center">
                    <div class="col-12 col-xl-6">
                        <label for="search" class="visually-hidden">Cari</label>
                        <div class="input-group">
                            <span class="input-group-text border-0 bg-transparent pe-0 ps-3 rounded-start-4">
                                <i class="bi bi-search text-secondary"></i>
                            </span>
                            <input
                                type="search"
                                class="form-control report-input"
                                id="search"
                                name="search"
                                value="{{ $filters['search'] }}"
                                placeholder="Cari Order ID atau pelanggan..."
                            >
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-xl-2">
                        <label for="status" class="visually-hidden">Status</label>
                        <select class="form-select report-select" id="status" name="status">
                            <option value="">Semua Status</option>
                            <option value="pending" @selected($filters['status'] === 'pending')>Proses</option>
                            <option value="verified" @selected($filters['status'] === 'verified')>Berhasil</option>
                            <option value="cancelled" @selected($filters['status'] === 'cancelled')>Dibatalkan</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-6 col-xl-1">
                        <button type="button" class="report-icon-btn w-100" data-bs-toggle="modal" data-bs-target="#advancedFilterModal" aria-label="Tanggal dan metode pembayaran">
                            <i class="bi bi-calendar3"></i>
                        </button>
                    </div>

                    <div class="col-12 col-md-6 col-xl-1">
                        <button type="button" class="report-icon-btn w-100" data-bs-toggle="modal" data-bs-target="#advancedFilterModal" aria-label="Filter lanjutan">
                            <i class="bi bi-filter"></i>
                        </button>
                    </div>

                    <div class="col-12 col-xl-2 ms-xl-auto d-flex justify-content-xl-end gap-2">
                        <a href="{{ route('admin.reports.index') }}" class="btn btn-light border rounded-pill px-3">Reset</a>
                        <button type="submit" class="btn btn-outline-primary rounded-pill px-3">Terapkan</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="report-card mt-3">
            <x-admin.table :headers="['Order ID', 'Tanggal', 'Pelanggan', 'Produk', 'Jumlah', 'Status']" class="report-card">
                <x-slot:header>
                    <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                        <div>
                            <div class="fw-bold">Data Penjualan</div>
                            <div class="report-meta">Menampilkan {{ $reports->total() }} transaksi yang sesuai filter.</div>
                        </div>
                        <div class="report-badge report-badge--secondary">
                            {{ $reports->count() }} data di halaman ini
                        </div>
                    </div>
                    <div class="report-scroll-hint">
                        <i class="bi bi-arrow-left-right"></i>
                        Geser kiri kanan untuk melihat kolom lain.
                    </div>
                </x-slot:header>

                @forelse ($reports as $report)
                    <tr>
                        <td>
                            <div class="report-id">#ORD-{{ optional($report['tanggal_transaksi'])->format('Y') }}-{{ str_pad((string) $report['id_penjualan'], 3, '0', STR_PAD_LEFT) }}</div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $report['tanggal_label'] ?: '-' }}</div>
                            <div class="report-meta">{{ $report['jam_label'] ?: '-' }}</div>
                        </td>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <div class="report-avatar">
                                    {{ collect(explode(' ', (string) $report['nama_pelanggan']))->filter()->map(fn ($part) => mb_substr($part, 0, 1))->take(2)->implode('') ?: 'LM' }}
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ $report['nama_pelanggan'] }}</div>
                                    <div class="report-meta">Pelanggan</div>
                                </div>
                            </div>
                        </td>
                        <td class="text-secondary">{{ $report['produk'] ?: '-' }}</td>
                        <td>
                            <div class="report-meta fw-semibold">{{ $report['jumlah_barang'] }} item</div>
                        </td>
                        <td>
                            <x-badge :status="$report['status']" class="report-badge" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-5">
                            <div class="text-center">
                                <div class="fw-semibold">Data belum tersedia</div>
                                <div class="text-secondary small">Ubah filter untuk mencari transaksi yang sesuai.</div>
                            </div>
                        </td>
                    </tr>
                @endforelse

                <x-slot:pagination>
                    <div class="report-footer">
                        <div class="report-summary">
                            @if ($reports->count() > 0)
                                Menampilkan {{ $reports->firstItem() }}-{{ $reports->lastItem() }} dari {{ $reports->total() }} transaksi
                            @else
                                Menampilkan 0 transaksi
                            @endif
                        </div>

                        @if ($reports->hasPages())
                            <div class="report-pager">
                                <a href="{{ $reports->previousPageUrl() ?: '#' }}" class="btn btn-light border {{ $reports->onFirstPage() ? 'disabled' : '' }}" @if($reports->onFirstPage()) tabindex="-1" aria-disabled="true" @endif>Sebelumnya</a>
                                <a href="{{ $reports->nextPageUrl() ?: '#' }}" class="btn btn-primary {{ $reports->hasMorePages() ? '' : 'disabled' }}" @if(! $reports->hasMorePages()) tabindex="-1" aria-disabled="true" @endif>Selanjutnya</a>
                            </div>
                        @endif
                    </div>
                </x-slot:pagination>
            </x-admin.table>
        </div>
    </div>

    <div class="modal fade filter-modal" id="advancedFilterModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <h5 class="modal-title fw-bold mb-0">Filter Lanjutan</h5>
                        <div class="report-meta">Tanggal transaksi dan metode pembayaran</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label for="modal_tanggal_awal" class="form-label fw-semibold">Tanggal Awal</label>
                            <input type="date" class="form-control report-date" id="modal_tanggal_awal" value="{{ $filters['tanggal_awal'] }}">
                        </div>
                        <div class="col-12 col-md-6">
                            <label for="modal_tanggal_akhir" class="form-label fw-semibold">Tanggal Akhir</label>
                            <input type="date" class="form-control report-date" id="modal_tanggal_akhir" value="{{ $filters['tanggal_akhir'] }}">
                        </div>
                        <div class="col-12">
                            <label for="modal_metode_pembayaran" class="form-label fw-semibold">Metode Pembayaran</label>
                            <select class="form-select report-select" id="modal_metode_pembayaran">
                                <option value="">Semua Metode</option>
                                @foreach ($paymentMethods as $value => $label)
                                    <option value="{{ $value }}" @selected($filters['metode_pembayaran'] === $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border" id="modal-reset-filter">Reset</button>
                    <button type="button" class="btn btn-primary" id="modal-apply-filter">Terapkan</button>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
                </div>
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <div class="text-center mt-4 mb-2">
        <p class="text-muted text-uppercase opacity-50" style="font-size: 0.65rem; letter-spacing: 0.08em;">
            &copy; {{ date('Y') }} LUMINA MEDIA DASHBOARD. ALL RIGHTS RESERVED.
        </p>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .ls-wide { letter-spacing: 0.06em; }
        .x-small { font-size: 0.75rem; }
        .avatar-circle { border: 1.5px solid #fff; }
        .dropdown-item.active { background-color: #1a4fd9 !important; color: #fff !important; }
        .flatpickr-calendar.open {
            border-radius: 14px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.12) !important;
            border: 1px solid #eee;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function setSort(val) {
            document.getElementById('sortInput').value = val;
            document.getElementById('filterForm').submit();
        }

        document.addEventListener('DOMContentLoaded', function () {
            const triggerBtn = document.getElementById('datePickerTrigger');
            const fp = flatpickr('#dateRangePicker', {
                mode: 'range',
                dateFormat: 'Y-m-d',
                defaultDate: [
                    '{{ request('start_date') }}',
                    '{{ request('end_date') }}'
                ],
                onChange: function (selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        document.getElementById('start_date').value = instance.formatDate(selectedDates[0], 'Y-m-d');
                        document.getElementById('end_date').value   = instance.formatDate(selectedDates[1], 'Y-m-d');
                        document.getElementById('filterForm').submit();
                    }
                },
                positionElement: triggerBtn,
                position: 'below'
            });

            triggerBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                fp.open();
            });

            // Highlight calendar button if date filter is active
            @if(request('start_date'))
                triggerBtn.classList.remove('bg-white', 'text-muted');
                triggerBtn.classList.add('bg-primary', 'border-primary', 'text-white');
                triggerBtn.querySelector('i').className = 'bi bi-calendar-check text-white';
            @endif
        });
    </script>
=======
    @push('scripts')
        <script>
            (() => {
                const exportButton = document.getElementById('export-pdf-button');
                const filterForm = document.getElementById('report-filter-form');
                const alertContainer = document.getElementById('report-alert');
                const exportUrl = @json(route('admin.reports.exportPdf'));
                const modalTanggalAwal = document.getElementById('modal_tanggal_awal');
                const modalTanggalAkhir = document.getElementById('modal_tanggal_akhir');
                const modalMetodePembayaran = document.getElementById('modal_metode_pembayaran');
                const modalApplyFilter = document.getElementById('modal-apply-filter');
                const modalResetFilter = document.getElementById('modal-reset-filter');

                const renderAlert = (type, message) => {
                    alertContainer.innerHTML = `
                        <div class="alert alert-${type} alert-dismissible fade show mb-3" role="alert">
                            ${message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
                        </div>
                    `;
                };

                const syncAdvancedFilters = () => {
                    const tanggalAwalField = filterForm.querySelector('[name="tanggal_awal"]');
                    const tanggalAkhirField = filterForm.querySelector('[name="tanggal_akhir"]');
                    const metodePembayaranField = filterForm.querySelector('[name="metode_pembayaran"]');

                    if (tanggalAwalField) {
                        tanggalAwalField.value = modalTanggalAwal.value;
                    }

                    if (tanggalAkhirField) {
                        tanggalAkhirField.value = modalTanggalAkhir.value;
                    }

                    if (metodePembayaranField) {
                        metodePembayaranField.value = modalMetodePembayaran.value;
                    }
                };

                modalApplyFilter.addEventListener('click', () => {
                    syncAdvancedFilters();
                    const modal = bootstrap.Modal.getOrCreateInstance(document.getElementById('advancedFilterModal'));
                    modal.hide();
                    filterForm.submit();
                });

                modalResetFilter.addEventListener('click', () => {
                    modalTanggalAwal.value = '';
                    modalTanggalAkhir.value = '';
                    modalMetodePembayaran.value = '';
                });

                exportButton.addEventListener('click', () => {
                    syncAdvancedFilters();
                    const params = new URLSearchParams(new FormData(filterForm));
                    const url = `${exportUrl}?${params.toString()}`;

                        const link = document.createElement('a');
                        link.href = url;
                        link.target = '_blank';
                        link.rel = 'noopener noreferrer';
                        document.body.appendChild(link);
                        link.click();
                        link.remove();
                        renderAlert('success', 'PDF laporan sedang dibuka di tab baru.');
                });
            })();
        </script>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
    @endpush
</x-admin.layout>
