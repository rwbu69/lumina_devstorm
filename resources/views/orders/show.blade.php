<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="container py-5">
        <!-- Back Link -->
        <div class="mb-4">
            <a href="{{ route('catalog.index') }}" class="text-decoration-none text-secondary fw-semibold">
                <i class="bi bi-arrow-left me-1"></i> Kembali Belanja
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="row g-4">
            <!-- Left Side: Invoice Details -->
            <div class="col-lg-7 col-xl-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                    <div class="d-flex justify-content-between align-items-start border-b border-slate-100 pb-4 mb-4 flex-wrap gap-2">
                        <div>
                            <span class="text-secondary small uppercase tracking-wider">Invoice Transaksi</span>
                            <h2 class="fw-bold text-primary mb-1">#INV-{{ str_pad((string)$order->id, 5, '0', STR_PAD_LEFT) }}</h2>
                            <p class="text-secondary small mb-0"><i class="bi bi-calendar3 me-1"></i>{{ $order->tanggal_pesan->format('d M Y, H:i') }}</p>
                        </div>
                        <div>
                            @if ($order->status === 'verified')
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-patch-check-fill me-1"></i>Selesai / Terverifikasi</span>
                            @elseif ($order->status === 'cancelled')
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-x-circle-fill me-1"></i>Dibatalkan</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning px-3 py-2 rounded-pill fw-semibold"><i class="bi bi-hourglass-split me-1"></i>Menunggu Verifikasi</span>
                            @endif
                        </div>
                    </div>

                    <!-- Items List -->
                    <h5 class="fw-bold text-dark mb-3">Item Pembelian</h5>
                    <div class="list-group list-group-flush border rounded-4 overflow-hidden mb-4">
                        @foreach ($order->orderDetails as $detail)
                            <div class="list-group-item p-3 d-flex align-items-center justify-content-between border-slate-100">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-primary-subtle rounded-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 60px;">
                                        <i class="bi bi-book text-primary"></i>
                                    </div>
                                    <div>
                                        <h6 class="fw-bold text-dark mb-0.5">{{ $detail->book->judul ?? 'Buku Tidak Tersedia' }}</h6>
                                        <small class="text-secondary">Oleh: {{ $detail->book->penulis ?? '-' }}</small>
                                    </div>
                                </div>
                                <span class="fw-bold text-primary">Rp {{ number_format($detail->harga_saat_beli, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Calculation -->
                    <div class="d-flex justify-content-between align-items-center border-t border-slate-100 pt-3">
                        <span class="text-secondary fw-semibold">Total Pembayaran</span>
                        <span class="fw-bold text-primary fs-3">Rp {{ number_format($order->total_tagihan, 0, ',', '.') }}</span>
                    </div>

                    <!-- Payment Information Instructions -->
                    @if ($order->status === 'pending')
                        <div class="mt-5 p-4 rounded-4 bg-light border border-slate-100">
                            <h5 class="fw-bold text-primary mb-3"><i class="bi bi-bank me-2"></i>Instruksi Pembayaran</h5>
                            <p class="text-secondary small mb-4">Silakan lakukan transfer dana sesuai total tagihan di atas ke salah satu rekening pembayaran resmi Lumina Media berikut:</p>
                            
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <div class="bg-white p-3 rounded-3 border border-slate-200 shadow-xs">
                                        <span class="badge bg-primary mb-2">BANK BCA</span>
                                        <div class="fw-bold text-dark fs-5 mb-1" id="bca-num">123-456-7890</div>
                                        <small class="text-secondary">a/n PT Lumina Media Nusantara</small>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="bg-white p-3 rounded-3 border border-slate-200 shadow-xs">
                                        <span class="badge bg-warning text-dark mb-2">GOPAY / OVO</span>
                                        <div class="fw-bold text-dark fs-5 mb-1">0812-3456-7890</div>
                                        <small class="text-secondary">a/n PT Lumina Media Nusantara</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Proof Upload Form / Proof Status -->
            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 80px;">
                    @if ($order->status === 'verified')
                        <div class="text-center py-4">
                            <div class="bg-success-subtle text-success rounded-full w-16 h-16 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%;">
                                <i class="bi bi-patch-check-fill display-5"></i>
                            </div>
                            <h5 class="fw-bold text-success mb-2">Transaksi Selesai</h5>
                            <p class="text-secondary small mb-4">Pembayaran Anda telah diverifikasi oleh admin. Buku digital Anda sudah siap dibaca!</p>
                            <a href="{{ route('collection.index') }}" class="btn btn-success w-100 py-2.5 rounded-3 fw-bold shadow-sm">
                                <i class="bi bi-journal-bookmark me-2"></i> Akses Koleksi Saya
                            </a>
                        </div>
                    @elseif ($order->status === 'cancelled')
                        <div class="text-center py-4">
                            <div class="bg-danger-subtle text-danger rounded-full w-16 h-16 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%;">
                                <i class="bi bi-x-circle-fill display-5"></i>
                            </div>
                            <h5 class="fw-bold text-danger mb-2">Pesanan Dibatalkan</h5>
                            <p class="text-secondary small mb-0">Pesanan ini telah dibatalkan karena kendala transaksi atau waktu pembayaran habis.</p>
                        </div>
                    @else
                        <!-- Order is Pending -->
                        @if ($order->payment)
                            <!-- Payment receipt uploaded, waiting for verification -->
                            <div class="text-center py-4">
                                <div class="bg-warning-subtle text-warning rounded-full w-16 h-16 d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 70px; height: 70px; border-radius: 50%;">
                                    <i class="bi bi-hourglass-split display-5"></i>
                                </div>
                                <h5 class="fw-bold text-warning mb-2">Menunggu Verifikasi</h5>
                                <p class="text-secondary small mb-4">Bukti transfer Anda menggunakan metode <span class="fw-bold text-dark">{{ $order->payment->metode_pembayaran }}</span> telah kami terima. Kami akan segera memeriksa transaksi Anda.</p>
                                
                                <div class="border rounded-3 overflow-hidden shadow-xs bg-light">
                                    <div class="py-2 bg-slate-200 text-secondary small fw-semibold">Bukti Pembayaran Anda</div>
                                    <img src="{{ asset('storage/' . $order->payment->file_bukti) }}" alt="Bukti Pembayaran" class="img-fluid" style="max-height: 250px; object-fit: contain;">
                                </div>

                                <div class="mt-4">
                                    <span class="text-secondary small d-block mb-1">Butuh mengunggah ulang bukti?</span>
                                    <button onclick="document.getElementById('upload-box').classList.toggle('d-none')" class="btn btn-outline-secondary btn-sm rounded-3">Unggah Ulang</button>
                                </div>
                            </div>
                        @endif

                        <!-- Payment Upload Form (hidden if uploaded, but shown by default if not) -->
                        <div id="upload-box" class="{{ $order->payment ? 'd-none mt-4' : '' }}">
                            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-cloud-arrow-up me-2"></i>Konfirmasi Pembayaran</h5>
                            
                            <form action="{{ route('orders.uploadPayment', $order->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                
                                <!-- Payment Method Select -->
                                <div class="mb-3">
                                    <label for="metode_pembayaran" class="form-label fw-semibold text-secondary small">Metode Pembayaran</label>
                                    <select name="metode_pembayaran" id="metode_pembayaran" class="form-select rounded-3 py-2" required>
                                        <option value="" disabled selected>-- Pilih Rekening Tujuan --</option>
                                        <option value="Transfer Bank BCA" {{ (old('metode_pembayaran') ?? ($order->payment->metode_pembayaran ?? '')) === 'Transfer Bank BCA' ? 'selected' : '' }}>Transfer Bank BCA</option>
                                        <option value="Gopay / OVO E-Wallet" {{ (old('metode_pembayaran') ?? ($order->payment->metode_pembayaran ?? '')) === 'Gopay / OVO E-Wallet' ? 'selected' : '' }}>Gopay / OVO E-Wallet</option>
                                    </select>
                                    @error('metode_pembayaran')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- File Upload -->
                                <div class="mb-4">
                                    <label for="file_bukti" class="form-label fw-semibold text-secondary small">Unggah Bukti Transfer</label>
                                    <input type="file" name="file_bukti" id="file_bukti" class="form-control rounded-3 py-2 @error('file_bukti') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg" required>
                                    <small class="text-secondary d-block mt-1">Format gambar: JPG, JPEG, PNG (Maks. 2MB)</small>
                                    @error('file_bukti')
                                        <div class="text-danger small mt-1"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-2.5 rounded-3 fw-bold shadow-sm">
                                    Kirim Konfirmasi <i class="bi bi-send ms-1"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
