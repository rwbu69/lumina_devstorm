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
                </div>
            </div>
        </div>
    </div>

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
    @endpush
</x-admin.layout>
