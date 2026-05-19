<x-admin.layout :title="'Lumina Media - Detail Pesanan #' . $order->id">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary rounded-3 mb-4">
        <i class="bi bi-arrow-left me-2"></i>
        Kembali
    </a>

    <div class="row g-4">
        <!-- Order Info -->
        <div class="col-md-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">Informasi Pesanan #{{ $order->id }}</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Nama Pembeli</p>
                            <p class="fw-semibold">{{ $order->user->nama }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Email</p>
                            <p class="fw-semibold">{{ $order->user->email }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Tanggal Pesan</p>
                            <p class="fw-semibold">{{ $order->tanggal_pesan->format('d M Y H:i') }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted small mb-1">Status Pesanan</p>
                            <p class="fw-semibold">
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">PENDING</span>
                                @elseif($order->status === 'verified')
                                    <span class="badge bg-success">VERIFIED</span>
                                @else
                                    <span class="badge bg-danger">REJECTED</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">Daftar Buku</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light border-bottom">
                            <tr>
                                <th class="px-4 py-3 fw-semibold">JUDUL BUKU</th>
                                <th class="px-4 py-3 fw-semibold text-end" style="width: 20%;">HARGA SAAT BELI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->orderDetails as $detail)
                                <tr class="align-middle">
                                    <td class="px-4 py-3">
                                        <div>
                                            <p class="fw-semibold mb-1">{{ $detail->book->judul }}</p>
                                            <p class="text-muted small mb-0">Penulis: {{ $detail->book->penulis }}</p>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-end">
                                        <span class="fw-semibold">Rp {{ number_format($detail->harga_saat_beli, 0, ',', '.') }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sidebar: Payment Info & Actions -->
        <div class="col-md-4">
            <!-- Payment Status Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light border-bottom">
                    <h5 class="mb-0">Status Pembayaran</h5>
                </div>
                <div class="card-body">
                    @if($order->payment)
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Status Verifikasi</p>
                            <div class="mb-2">
                                @if($order->payment->status_verifikasi === 'approved')
                                    <span class="badge bg-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle me-1"></i> VERIFIED
                                    </span>
                                @elseif($order->payment->status_verifikasi === 'rejected')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-x-circle me-1"></i> DITOLAK
                                    </span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">
                                        <i class="bi bi-hourglass-split me-1"></i> PENDING
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <div class="mb-3">
                            <p class="text-muted small mb-1">Tanggal Upload</p>
                            <p class="fw-semibold">{{ $order->payment->tanggal_upload?->format('d M Y H:i') ?? '-' }}</p>
                        </div>

                        @if($order->payment->file_bukti)
                            <div class="mb-3">
                                <p class="text-muted small mb-1">Bukti Pembayaran</p>
                                <a href="{{ Storage::url($order->payment->file_bukti) }}" target="_blank" class="btn btn-sm btn-light border w-100 rounded-2">
                                    <i class="bi bi-file-earmark-image me-1"></i> Lihat Bukti
                                </a>
                            </div>
                        @endif

                        <hr>

                        @if($order->payment->status_verifikasi === 'pending')
                            <form method="POST" action="{{ route('admin.orders.verify', $order) }}" class="mb-2">
                                @csrf
                                <button type="submit" name="action" value="approve" class="btn btn-success rounded-2 w-100 mb-2">
                                    <i class="bi bi-check-circle me-1"></i> Verifikasi
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.orders.verify', $order) }}">
                                @csrf
                                <button type="submit" name="action" value="reject" class="btn btn-danger rounded-2 w-100">
                                    <i class="bi bi-x-circle me-1"></i> Tolak
                                </button>
                            </form>
                        @endif
                    @else
                        <div class="alert alert-info rounded-3" role="alert">
                            <i class="bi bi-info-circle me-2"></i>
                            Belum ada pembayaran yang diupload untuk pesanan ini.
                        </div>
                    @endif
                </div>
            </div>

            <!-- Total Summary -->
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-muted mb-0">Subtotal</p>
                        <p class="fw-semibold mb-0">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</p>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <p class="text-muted mb-0">Pajak (0%)</p>
                        <p class="fw-semibold mb-0">Rp 0</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <p class="fw-semibold mb-0">Total Bayar</p>
                        <h5 class="mb-0 text-primary">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
