<x-admin.layout :title="'Lumina Media - Kelola Pesanan'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Pesanan</h1>
                <p class="text-slate-500 font-medium">Kelola dan verifikasi transaksi pelanggan secara efisien.</p>
            </div>
            <a href="{{ route('admin.orders.exportPdf', request()->query()) }}" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
                <x-heroicon-s-document-text class="mr-2 size-6" /> Ekspor PDF
            </a>
        </div>

        {{-- Filters & Search --}}
        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl mb-8 p-4">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex flex-col gap-4">
                {{-- Search bar --}}
                <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus-within:border-lumina-blue focus-within:ring-2 focus-within:ring-lumina-blue/20 transition-all">
                    <x-heroicon-o-magnifying-glass class="text-slate-400 size-6" />
                    <input type="text" name="search"
                           class="bg-transparent border-0 w-full focus:ring-0 p-0 text-sm font-medium text-slate-700 placeholder-slate-400"
                           placeholder="Cari berdasarkan nama pelanggan atau ID pesanan..."
                           value="{{ request('search') }}">
                </div>

                {{-- Status filter tabs --}}
                <div class="flex gap-2 overflow-x-auto pb-2 scrollbar-hide">
                    @php
                        $currentStatus = request('status', 'semua');
                        $statuses = [
                            'semua'     => 'Semua Pesanan',
                            'pending'   => 'Pending',
                            'verified'  => 'Terverifikasi',
                            'cancelled' => 'Dibatalkan'
                        ];
                    @endphp
                    @foreach($statuses as $value => $label)
                        <a href="{{ route('admin.orders.index', array_merge(request()->query(), ['status' => $value])) }}"
                           class="px-5 py-2 rounded-full font-bold text-sm whitespace-nowrap transition-colors {{ $currentStatus == $value ? 'bg-lumina-blue text-white shadow-sm' : 'bg-white border border-slate-200 text-slate-500 hover:bg-slate-50' }}">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>

        {{-- Table --}}
        <x-admin.table>
            <x-slot:head>
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-1/4">Nama Pembeli</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Pesan</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Total Bayar</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Status Pembayaran</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Aksi</th>
                </tr>
            </x-slot:head>

            @foreach($orders as $order)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-100 last:border-0" x-data>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-lumina-blue/10 text-lumina-blue flex items-center justify-center font-bold text-sm shrink-0 border border-lumina-blue/20">
                                {{ strtoupper(substr($order->user->nama, 0, 2)) }}
                            </div>
                            <div class="font-bold text-slate-800 text-sm">{{ $order->user->nama }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-slate-500">
                        {{ $order->tanggal_pesan->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 font-bold text-slate-800">
                        Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <x-badge :status="$order->status" />
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-2 items-center">
                            <button @click="$dispatch('open-modal', 'modalDetail-{{ $order->id }}')" class="w-28 px-3 py-1.5 bg-white border border-slate-200 text-slate-600 hover:text-lumina-blue hover:border-lumina-blue/30 hover:bg-blue-50 rounded-lg text-xs font-bold shadow-sm">
                                Lihat Detail
                            </button>
                            @if($order->status == 'pending')
                                <button @click="$dispatch('open-modal', 'modalVerifikasi-{{ $order->id }}')" class="w-28 px-3 py-1.5 bg-lumina-blue hover:bg-blue-800 text-white rounded-lg text-xs font-bold transition-all shadow-sm">
                                    Verifikasi
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            <x-slot:emptyState>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <x-heroicon-o-inbox class="size-10 text-slate-300" />
                    </div>
                    <div class="font-bold text-slate-800 text-lg mb-1">Belum ada pesanan</div>
                    <div class="text-slate-500 text-sm">Pesanan yang masuk akan muncul di sini.</div>
                </div>
            </x-slot:emptyState>

            <x-slot:pagination>
                @if($orders->hasPages())
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <span class="text-slate-500 text-sm">Menampilkan <span class="font-semibold text-slate-700">{{ $orders->firstItem() }}-{{ $orders->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $orders->total() }}</span> pesanan</span>
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
    </div>

    {{-- Alpine Modals Container --}}
    <div x-data="{ activeModal: null }" @open-modal.window="activeModal = $event.detail" @close-modal.window="activeModal = null" @keydown.escape.window="activeModal = null">
        @foreach($orders as $order)
            {{-- Modal Detail Pesanan --}}
            <div x-show="activeModal === 'modalDetail-{{ $order->id }}'" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="activeModal === 'modalDetail-{{ $order->id }}'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

                <div class="flex min-h-full items-center justify-center p-4">
                    <div x-show="activeModal === 'modalDetail-{{ $order->id }}'" 
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-2xl overflow-hidden">
                        
                        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                            <h5 class="text-xl font-bold text-lumina-blue">Detail Pesanan #INV-{{ str_pad((string)$order->id, 5, '0', STR_PAD_LEFT) }}</h5>
                            <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                                <x-heroicon-o-x-mark class="size-5" />
                            </button>
                        </div>

                        <div class="p-6 md:p-8 max-h-[70vh] overflow-y-auto">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                                <div>
                                    <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Nama Pelanggan</label>
                                    <div class="font-bold text-slate-800 text-lg">{{ $order->user->nama }}</div>
                                </div>
                                <div>
                                    <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Status</label>
                                    <div><x-badge :status="$order->status" /></div>
                                </div>
                                <div>
                                    <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Tanggal Pemesanan</label>
                                    <div class="font-bold text-slate-800 text-lg">{{ $order->tanggal_pesan->format('d M Y, H:i') }}</div>
                                </div>
                                <div>
                                    <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Tagihan</label>
                                    <div class="font-bold text-lumina-blue text-2xl">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-4 border-b border-slate-100 pb-2">Buku yang Dipesan</label>
                                <div class="border border-slate-200 rounded-2xl overflow-hidden shadow-sm">
                                    <table class="w-full text-left border-collapse">
                                        <thead class="bg-slate-50/80 border-b border-slate-200">
                                            <tr>
                                                <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">Judul Buku</th>
                                                <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-100 bg-white">
                                            @foreach($order->orderDetails as $detail)
                                                <tr class="hover:bg-slate-50/50 transition-colors">
                                                    <td class="px-4 py-3 font-semibold text-slate-700 text-sm">{{ $detail->book->judul ?? 'Buku Dihapus' }}</td>
                                                    <td class="px-4 py-3 text-right font-bold text-slate-800 text-sm">Rp {{ number_format($detail->harga_saat_beli, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end">
                            <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Verifikasi --}}
            @if($order->status == 'pending')
                <div x-show="activeModal === 'modalVerifikasi-{{ $order->id }}'" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div x-show="activeModal === 'modalVerifikasi-{{ $order->id }}'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

                    <div class="flex min-h-full items-center justify-center p-4">
                        <div x-show="activeModal === 'modalVerifikasi-{{ $order->id }}'" 
                             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                             class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-4xl overflow-hidden flex flex-col md:flex-row h-auto max-h-[85vh]">
                            
                            {{-- Bukti Transfer --}}
                            <div class="md:w-1/2 bg-slate-50 border-b md:border-b-0 md:border-r border-slate-200 flex flex-col overflow-y-auto">
                                <div class="p-4 border-b border-slate-200 bg-white text-center sticky top-0 z-10">
                                    <span class="text-xs font-bold text-slate-500 uppercase tracking-widest">Bukti Transfer</span>
                                </div>
                                <div class="p-6 flex-grow flex items-center justify-center min-h-[300px]">
                                    @if($order->payment && $order->payment->file_bukti)
                                        <div class="relative group">
                                            <img src="{{ asset('storage/' . $order->payment->file_bukti) }}" class="max-w-full rounded-2xl shadow-md max-h-[60vh] object-contain transition-transform duration-300 group-hover:scale-[1.02]" alt="Bukti Transfer">
                                            <a href="{{ asset('storage/' . $order->payment->file_bukti) }}" target="_blank" class="absolute bottom-4 right-4 w-10 h-10 bg-white text-slate-800 rounded-full flex items-center justify-center shadow-lg opacity-0 group-hover:opacity-100 transition-opacity hover:bg-slate-50 hover:text-lumina-blue">
                                                <x-heroicon-o-magnifying-glass-plus class="size-6" />
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-center">
                                            <x-heroicon-o-photo class="size-16 text-slate-300 mb-3 block" />
                                            <p class="text-slate-500 font-medium">Bukti belum diunggah</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Details & Actions --}}
                            <div class="md:w-1/2 flex flex-col bg-white overflow-y-auto">
                                <div class="p-8 flex-grow">
                                    <div class="flex items-start justify-between mb-8">
                                        <h4 class="text-2xl font-serif font-bold text-lumina-blue">Verifikasi Pembayaran</h4>
                                        <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                                            <x-heroicon-o-x-mark class="size-6" />
                                        </button>
                                    </div>
                                    
                                    <div class="space-y-6">
                                        <div>
                                            <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">ID Pesanan</label>
                                            <div class="font-bold text-slate-800 text-lg">#INV-{{ str_pad((string)$order->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        </div>

                                        <div>
                                            <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-1">Nama Pelanggan</label>
                                            <div class="font-bold text-slate-800 text-lg">{{ $order->user->nama }}</div>
                                        </div>

                                        <div class="p-5 bg-blue-50 border border-blue-100 rounded-2xl">
                                            <label class="block text-[0.65rem] font-bold text-blue-500 uppercase tracking-wider mb-1">Total Pembayaran</label>
                                            <div class="font-bold text-lumina-blue text-3xl">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="p-6 border-t border-slate-100 bg-slate-50/50 space-y-3 sticky bottom-0">
                                    <form action="{{ route('admin.orders.verify', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white py-3.5 rounded-xl font-bold shadow-sm transition-colors text-sm">
                                            <x-heroicon-s-check-circle class="mr-2 size-6" /> Verifikasi & Berikan Akses
                                        </button>
                                    </form>
                                    
                                    <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full flex items-center justify-center bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 hover:border-rose-300 py-3.5 rounded-xl font-bold shadow-sm transition-colors text-sm">
                                            <x-heroicon-s-x-circle class="mr-2 size-6" /> Tolak Pembayaran
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-admin.layout>
