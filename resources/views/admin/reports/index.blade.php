<x-admin.layout :title="'Lumina Media - Laporan Penjualan'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Laporan Penjualan</h1>
                <p class="text-slate-500 font-medium">Kelola dan pantau seluruh data transaksi penjualan dalam periode berjalan.</p>
            </div>
            <a href="{{ route('admin.reports.exportPdf', request()->query()) }}" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
                <x-heroicon-s-document-text class="mr-2 size-6" /> Ekspor PDF
            </a>
        </div>

        {{-- Filters & Search --}}
        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl mb-8 p-4">
            <form action="{{ route('admin.reports.index') }}" method="GET" id="filterForm">
                <div class="flex flex-col md:flex-row items-center gap-4">
                    
                    {{-- Search --}}
                    <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus-within:border-lumina-blue focus-within:ring-2 focus-within:ring-lumina-blue/20 transition-all flex-grow w-full md:w-auto">
                        <x-heroicon-o-magnifying-glass class="text-slate-400 size-6 shrink-0" />
                        <input type="text" name="search"
                               class="bg-transparent border-0 w-full focus:ring-0 p-0 text-sm font-medium text-slate-700 placeholder-slate-400"
                               placeholder="Cari Order ID atau pelanggan..."
                               value="{{ request('search') }}">
                    </div>

                    <div class="flex items-center gap-3 w-full md:w-auto">
                        {{-- Status Select --}}
                        <select name="status" class="px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-sm font-medium text-slate-700 outline-none cursor-pointer" onchange="this.form.submit()">
                            <option value="semua" {{ request('status', 'semua') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Berhasil</option>
                            <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        </select>

                        {{-- Date Picker --}}
                        <div class="relative">
                            <button type="button" id="datePickerTrigger" class="w-12 h-12 flex items-center justify-center rounded-xl border transition-colors {{ request('start_date') ? 'bg-lumina-blue border-lumina-blue text-white' : 'bg-slate-50 border-slate-200 text-slate-500 hover:text-lumina-blue hover:bg-white' }}" title="{{ request('start_date') ? request('start_date') . ' – ' . request('end_date') : 'Pilih Rentang Tanggal' }}">
                                <x-heroicon-o-calendar-days class="size-6" />
                            </button>
                            <input type="text" id="dateRangePicker" class="absolute w-0 h-0 opacity-0 pointer-events-none">
                            <input type="hidden" name="start_date" id="start_date" value="{{ request('start_date') }}">
                            <input type="hidden" name="end_date" id="end_date" value="{{ request('end_date') }}">
                        </div>

                        {{-- Sort Dropdown (Alpine) --}}
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" @click="open = !open" @click.away="open = false" class="w-12 h-12 flex items-center justify-center rounded-xl border transition-colors {{ (request('sort') && request('sort') !== 'latest') ? 'bg-lumina-blue border-lumina-blue text-white' : 'bg-slate-50 border-slate-200 text-slate-500 hover:text-lumina-blue hover:bg-white' }}">
                                <x-heroicon-o-funnel class="size-6" />
                            </button>
                            
                            <div x-show="open" style="display: none;" x-transition.opacity class="absolute right-0 mt-2 w-48 bg-white border border-slate-200 shadow-lg rounded-2xl overflow-hidden z-50">
                                <a href="#" @click.prevent="setSort('latest'); open = false" class="block px-4 py-2.5 text-sm font-medium transition-colors {{ !request('sort') || request('sort') == 'latest' ? 'bg-lumina-blue text-white' : 'text-slate-700 hover:bg-slate-50' }}">Terbaru</a>
                                <a href="#" @click.prevent="setSort('oldest'); open = false" class="block px-4 py-2.5 text-sm font-medium transition-colors {{ request('sort') == 'oldest' ? 'bg-lumina-blue text-white' : 'text-slate-700 hover:bg-slate-50' }}">Terlama</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <a href="#" @click.prevent="setSort('highest'); open = false" class="block px-4 py-2.5 text-sm font-medium transition-colors {{ request('sort') == 'highest' ? 'bg-lumina-blue text-white' : 'text-slate-700 hover:bg-slate-50' }}">Harga Tertinggi</a>
                                <a href="#" @click.prevent="setSort('lowest'); open = false" class="block px-4 py-2.5 text-sm font-medium transition-colors {{ request('sort') == 'lowest' ? 'bg-lumina-blue text-white' : 'text-slate-700 hover:bg-slate-50' }}">Harga Terendah</a>
                            </div>
                            <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'latest') }}">
                        </div>

                        {{-- Reset Button --}}
                        @php
                            $hasActiveFilter = request()->filled('search')
                                || request()->filled('start_date')
                                || (request()->filled('status') && request('status') !== 'semua')
                                || (request()->filled('sort') && request('sort') !== 'latest');
                        @endphp
                        @if($hasActiveFilter)
                            <a href="{{ route('admin.reports.index') }}" class="w-12 h-12 flex items-center justify-center rounded-xl bg-rose-50 border border-rose-200 text-rose-500 hover:bg-rose-500 hover:text-white transition-colors" title="Reset semua filter">
                                <x-heroicon-o-x-mark class="size-5" />
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <x-admin.table>
            <x-slot:head>
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Order ID</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Pelanggan</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-1/4">Produk</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Jumlah</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status</th>
                </tr>
            </x-slot:head>

            @foreach($orders as $order)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-100 last:border-0">
                    <td class="px-6 py-4">
                        <span class="font-bold text-lumina-blue text-sm">
                            #ORD-{{ str_pad((string)$order->id, 8, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-slate-500">
                        {{ $order->tanggal_pesan->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-lumina-blue/10 text-lumina-blue flex items-center justify-center font-bold text-xs shrink-0 border border-lumina-blue/20">
                                {{ strtoupper(substr($order->user->nama, 0, 2)) }}
                            </div>
                            <div class="font-bold text-slate-800 text-sm group-hover:text-lumina-blue transition-colors truncate max-w-[150px]">{{ $order->user->nama }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @php $firstItem = $order->orderDetails->first(); @endphp
                        <div class="text-sm font-medium text-slate-700 truncate max-w-[200px]">
                            {{ $firstItem ? $firstItem->book->judul : '-' }}
                            @if($order->orderDetails->count() > 1)
                                <span class="text-xs font-bold text-slate-400 ml-1">(+{{ $order->orderDetails->count() - 1 }})</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800 text-right">
                        Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <x-badge :status="$order->status" />
                    </td>
                </tr>
            @endforeach

            <x-slot:emptyState>
                <div class="flex flex-col items-center justify-center py-8">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <x-heroicon-o-inbox class="size-10 text-slate-300" />
                    </div>
                    <div class="font-bold text-slate-800 text-lg mb-1">Belum ada data transaksi</div>
                    <div class="text-slate-500 text-sm">Transaksi yang selesai akan muncul di sini.</div>
                </div>
            </x-slot:emptyState>

            <x-slot:pagination>
                @if($orders->hasPages())
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <span class="text-slate-500 text-sm">Menampilkan <span class="font-semibold text-slate-700">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $orders->total() }}</span> transaksi</span>
                        <div class="flex gap-2">
                            @if ($orders->onFirstPage())
                                <span class="px-4 py-2 border border-slate-200 text-slate-400 bg-slate-50 rounded-xl text-sm font-semibold cursor-not-allowed">Sebelumnya</span>
                            @else
                                <a href="{{ $orders->previousPageUrl() }}" class="px-4 py-2 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Sebelumnya</a>
                            @endif

                            @if ($orders->hasMorePages())
                                <a href="{{ $orders->nextPageUrl() }}" class="px-4 py-2 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Selanjutnya</a>
                            @else
                                <span class="px-4 py-2 border border-slate-200 text-slate-400 bg-slate-50 rounded-xl text-sm font-semibold cursor-not-allowed">Selanjutnya</span>
                            @endif
                        </div>
                    </div>
                @endif
            </x-slot:pagination>
        </x-admin.table>

        <div class="text-center mt-8 mb-4">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                &copy; {{ date('Y') }} LUMINA MEDIA DASHBOARD. ALL RIGHTS RESERVED.
            </p>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <style>
        .flatpickr-calendar {
            font-family: 'Inter', sans-serif;
            border: 1px solid #e2e8f0;
            border-radius: 1rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        }
        .flatpickr-day.selected {
            background: #1a4fd9 !important;
            border-color: #1a4fd9 !important;
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
        });
    </script>
    @endpush
</x-admin.layout>
