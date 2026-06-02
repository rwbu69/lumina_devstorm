<x-admin.layout>
    <div style=" border-radius: 20px; padding: 16px;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="fw-bold mb-0" style="color: #1a4fd9; font-size: 1.75rem; font-weight: 800; letter-spacing: -0.03em;">Pesanan</h1>
                <p class="text-secondary fw-medium mb-0" style="font-size: 0.95rem; color: #1a4fd9 !important;">Kelola dan verifikasi transaksi pelanggan secara efisien.</p>
            </div>
            <a href="{{ route('admin.orders.exportPdf', request()->query()) }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm fw-bold btn-sm">
                <i class="bi bi-file-earmark-pdf-fill"></i>
                <span>Ekspor</span>
            </a>
        </div>

        {{-- Filters & Search --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
        <div class="card-body px-3 py-3">
            <form action="{{ route('admin.orders.index') }}" method="GET">
                {{-- Search bar (full width) --}}
                <div class="d-flex align-items-center gap-2 border-0 mb-3" style="">
                    <i class="bi bi-search text-muted" style="font-size: 0.85rem; flex-shrink: 0;"></i>
                    <input type="text" name="search"
                           class="form-control border-0 shadow-none p-0 bg-transparent"
                           placeholder="Cari berdasarkan nama pelanggan atau ID pesanan..."
                           value="{{ request('search') }}"
                           style="font-size: 0.85rem; height: auto; line-height: 1.4;">
                </div>

                {{-- Status filter tabs --}}
                <div class="d-flex gap-2 overflow-x-auto pb-1">
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
                           class="btn rounded-pill px-3 py-1 text-nowrap fw-semibold {{ $currentStatus == $value ? 'btn-primary' : 'btn-white bg-white text-muted border' }}"
                           style="font-size: 0.78rem;">
                            {{ $label }}
                        </a>
                    @endforeach
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <x-admin.table class="border-0 shadow-sm rounded-3 overflow-hidden">
        <x-slot:head>
            <tr>
                <th class="px-3 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0" style="background-color: #F8FAFC; width: 25%; font-size: 0.75rem;">Nama Pembeli</th>
                <th class="px-3 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0" style="background-color: #F8FAFC; font-size: 0.75rem;">Tanggal Pesan</th>
                <th class="px-3 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0" style="background-color: #F8FAFC; font-size: 0.75rem;">Total Bayar</th>
                <th class="px-3 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0 text-center" style="background-color: #F8FAFC; font-size: 0.75rem;">Status Pembayaran</th>
                <th class="px-3 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0 text-center" style="background-color: #F8FAFC; font-size: 0.75rem;">Aksi</th>
            </tr>
        </x-slot:head>

        @foreach($orders as $order)
                        <tr class="border-bottom" style="background-color: #F8FAFC;">
                            <td class="px-3 py-3" style="background-color: #F8FAFC;">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle rounded-circle bg-primary-subtle text-primary d-grid place-items-center fw-bold" style="width: 36px; height: 36px; min-width: 36px; font-size: 0.7rem; background-color: #E8F0FE;">
                                        {{ strtoupper(substr($order->user->nama, 0, 2)) }}
                                    </div>
                                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $order->user->nama }}</div>
                                </div>
                            </td>
                            <td class="px-3 py-3 text-muted fw-medium" style="background-color: #F8FAFC;" style="font-size: 0.85rem;">
                                {{ $order->tanggal_pesan->format('d M Y') }}
                            </td>
                            <td class="px-3 py-3 fw-bold text-dark" style="background-color: #F8FAFC;" style="font-size: 0.85rem;">
                                Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}
                            </td>
                            <td class="px-3 py-3 text-center" style="background-color: #F8FAFC;">
                                <x-badge :status="$order->status" />
                            </td>
                            <td class="px-3 py-3" style="background-color: #F8FAFC;">
                                <div class="d-flex flex-column gap-1 align-items-center">
                                    <button class="btn btn-white border btn-xs px-3 py-1 rounded-2 fw-bold text-muted w-100 shadow-sm bg-white" 
                                            style="max-width: 110px; font-size: 0.7rem;"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalDetail{{ $order->id }}">
                                        Lihat Detail
                                    </button>
                                    @if($order->status == 'pending')
                                        <button class="btn btn-primary btn-xs px-3 py-1 rounded-2 fw-bold w-100 shadow-sm" 
                                                style="max-width: 110px; font-size: 0.7rem;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#modalVerifikasi{{ $order->id }}">
                                            Verifikasi
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                    @endforeach

        <x-slot:emptyState>
            <div class="text-center py-4">
                <i class="bi bi-inbox fs-1 text-secondary opacity-50"></i>
                <div class="fw-bold mt-3 text-dark fs-5">Belum ada pesanan</div>
                <div class="text-muted mt-1">Pesanan yang masuk akan muncul di sini.</div>
            </div>
        </x-slot:emptyState>

        <x-slot:pagination>
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted x-small" style="font-size: 0.75rem;">
                    Menampilkan {{ $orders->firstItem() ?? 0 }}-{{ $orders->lastItem() ?? 0 }} dari {{ $orders->total() }} pesanan
                </div>
                <div class="d-flex gap-2">
                    @if ($orders->onFirstPage())
                        <span class="btn btn-light btn-xs px-3 py-1 rounded-2 text-muted disabled border-0" style="font-size: 0.75rem;">Sebelumnya</span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}" class="btn btn-light btn-xs px-3 py-1 rounded-2 text-muted border-0" style="font-size: 0.75rem;">Sebelumnya</a>
                    @endif

                    @if ($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}" class="btn btn-primary btn-xs px-3 py-1 rounded-2 shadow-sm border-0 fw-bold" style="font-size: 0.75rem;">Selanjutnya</a>
                    @else
                        <span class="btn btn-primary btn-xs px-3 py-1 rounded-2 shadow-sm border-0 fw-bold disabled opacity-50" style="font-size: 0.75rem;">Selanjutnya</span>
                    @endif
                </div>
            </div>
        </x-slot:pagination>
    </x-admin.table>

    </div>
    @push('styles')
    <style>
        .transition-all { transition: all 0.3s ease; }
        .ls-wide { letter-spacing: 0.05em; }
        .bg-gray-100 { background-color: #f3f4f6; }
        .x-small { font-size: 0.75rem; }
        .btn-xs { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
        
        .custom-scrollbar::-webkit-scrollbar { height: 3px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #e0e0e0; border-radius: 10px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #d0d0d0; }

        .proof-container { position: relative; transition: transform 0.3s ease; }
        .proof-container:hover { transform: scale(1.02); }
        
        .zoom-btn {
            position: absolute; bottom: 10px; right: 10px;
            background: white; color: #111827;
            width: 32px; height: 32px; border-radius: 50%;
            display: grid; place-items: center; text-decoration: none;
            opacity: 0; transition: opacity 0.3s ease;
        }
        .proof-container:hover .zoom-btn { opacity: 1; }

        .avatar-circle { font-size: 0.7rem; border: 1.5px solid #fff; }
        .btn-outline-danger:hover { background-color: #fff5f5 !important; color: #dc3545 !important; }
    </style>
    @endpush
    @foreach($orders as $order)
        {{-- Modal Detail Pesanan --}}
        <div class="modal fade" id="modalDetail{{ $order->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="modal-header border-bottom-0 bg-light px-4 py-3">
                        <h5 class="modal-title fw-bold text-primary" style="font-size: 1.1rem;">Detail Pesanan #LM-{{ str_pad((string)$order->id, 8, '0', STR_PAD_LEFT) }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 py-4" style="background-color: #F8FAFC;">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="x-small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem;">Nama Pelanggan</label>
                                    <div class="fw-bold fs-6">{{ $order->user->nama }}</div>
                                </div>
                                <div class="mb-3">
                                    <label class="x-small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem;">Tanggal Pemesanan</label>
                                    <div class="fw-bold fs-6">{{ $order->tanggal_pesan->format('d M Y, H:i') }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="x-small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem;">Status</label>
                                    <div><x-badge :status="$order->status" /></div>
                                </div>
                                <div class="mb-3">
                                    <label class="x-small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem;">Total Tagihan</label>
                                    <div class="fw-bold fs-5 text-primary">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="x-small text-muted text-uppercase fw-bold mb-2" style="font-size: 0.65rem;">Buku yang Dipesan</label>
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="px-3 py-2 text-uppercase text-muted fw-bold border-0" style="font-size: 0.65rem;">Judul Buku</th>
                                            <th class="px-3 py-2 text-uppercase text-muted fw-bold border-0 text-end" style="font-size: 0.65rem;">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->orderDetails as $detail)
                                            <tr>
                                                <td class="px-3 py-2 fw-medium" style="font-size: 0.85rem;">{{ $detail->book->judul ?? 'Buku Dihapus' }}</td>
                                                <td class="px-3 py-2 text-end fw-bold" style="font-size: 0.85rem;">Rp {{ number_format($detail->harga_saat_beli, 0, ',', '.') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-4 py-3 bg-white">
                        <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-bold small" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Verifikasi --}}
        @if($order->status == 'pending')
            <div class="modal fade" id="modalVerifikasi{{ $order->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                        <div class="row g-0">
                            {{-- Bukti Transfer --}}
                            <div class="col-md-6 bg-light border-end d-flex flex-column">
                                <div class="p-3 border-bottom bg-white text-center">
                                    <span class="text-uppercase x-small fw-bold text-muted ls-wide" style="font-size: 0.7rem;">Bukti Transfer</span>
                                </div>
                                <div class="p-4 flex-grow-1 d-flex align-items-center justify-content-center bg-gray-100" style="min-height: 400px;">
                                    @if($order->payment && $order->payment->file_bukti)
                                        <div class="position-relative proof-container">
                                            <img src="{{ asset('storage/' . $order->payment->file_bukti) }}" 
                                                 class="img-fluid rounded-3 shadow-sm" 
                                                 alt="Bukti Transfer"
                                                 style="max-height: 350px; object-fit: contain;">
                                            <a href="{{ asset('storage/' . $order->payment->file_bukti) }}" target="_blank" class="zoom-btn shadow-sm">
                                                <i class="bi bi-search"></i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="text-center py-5">
                                            <i class="bi bi-image text-muted display-4"></i>
                                            <p class="text-muted small mt-2">Bukti belum diunggah</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            {{-- Details & Actions --}}
                            <div class="col-md-6 d-flex flex-column" style="background-color: #FBF9F4;">
                                <div class="p-4 p-lg-5 flex-grow-1">
                                    <h4 class="fw-bold text-primary mb-4" style="font-family: 'Playfair Display', serif;">Verifikasi Pembayaran</h4>
                                    
                                    <div class="mb-3">
                                        <label class="x-small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem;">ID Pesanan</label>
                                        <div class="fw-bold fs-6">#LM-{{ str_pad((string)$order->id, 8, '0', STR_PAD_LEFT) }}</div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="x-small text-muted text-uppercase fw-bold mb-1" style="font-size: 0.65rem;">Nama Pelanggan</label>
                                        <div class="fw-bold fs-6">{{ $order->user->nama }}</div>
                                    </div>

                                    <div class="mb-4">
                                        <div class="p-3 bg-white rounded-3 border">
                                            <label class="x-small text-muted text-uppercase fw-bold mb-1 d-block" style="font-size: 0.65rem;">Total Pembayaran</label>
                                            <div class="fw-bold fs-4 text-primary">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</div>
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2">
                                        <form action="{{ route('admin.orders.verify', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-primary w-100 py-2 rounded-3 fw-bold shadow-sm small">
                                                Verifikasi & Akses
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.orders.reject', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-outline-danger w-100 py-2 rounded-3 fw-bold border-0 bg-white small">
                                                Tolak Pembayaran
                                            </button>
                                        </form>

                                        <button type="button" class="btn btn-link text-muted text-decoration-none py-1 small" data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
</x-admin-layout>
