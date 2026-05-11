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
                </div>
            </div>
        </div>
    </div>

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
    @endpush
</x-admin.layout>
