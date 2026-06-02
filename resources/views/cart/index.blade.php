<<<<<<< HEAD
<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="container py-5">
        <h1 class="h3 fw-bold text-primary mb-4"><i class="bi bi-cart3 me-2"></i>Keranjang Belanja</h1>

        @if (session('success'))
            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if ($items->isEmpty())
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                <div class="py-4">
                    <i class="bi bi-cart-x display-1 text-secondary opacity-50 mb-3"></i>
                    <h4 class="fw-bold text-secondary">Keranjang Belanja Anda Kosong</h4>
                    <p class="text-secondary mb-4">Mari jelajahi pustaka kami dan temukan buku rohani pembangun iman Anda!</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary px-4 py-2.5 rounded-3 fw-bold"><i class="bi bi-arrow-left me-2"></i>Mulai Belanja</a>
                </div>
            </div>
        @else
            <div class="row g-4">
                <!-- Left Side: Items List -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <div class="list-group list-group-flush">
                            @foreach ($items as $item)
                                <div class="list-group-item p-4 border-slate-100">
                                    <div class="row align-items-center g-3">
                                        <!-- Cover Icon -->
                                        <div class="col-auto">
                                            <div class="bg-primary-subtle rounded-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 90px;">
                                                <i class="bi bi-book text-primary fs-3"></i>
                                            </div>
                                        </div>

                                        <!-- Item Details -->
                                        <div class="col">
                                            <span class="badge bg-secondary-subtle text-secondary mb-1">{{ $item->category->nama }}</span>
                                            <h5 class="fw-bold text-dark mb-1">{{ $item->judul }}</h5>
                                            <p class="text-secondary small mb-0">Penulis: <span class="fw-semibold">{{ $item->penulis }}</span></p>
                                        </div>

                                        <!-- Price & Delete Button -->
                                        <div class="col-sm-auto text-sm-end">
                                            <div class="fw-bold text-primary fs-5 mb-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
                                            
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger btn-sm border-0 rounded-3"><i class="bi bi-trash me-1"></i>Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Side: Order Summary -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white sticky-top" style="top: 80px;">
                        <h5 class="fw-bold text-dark mb-3">Ringkasan Pesanan</h5>
                        
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-secondary">Jumlah E-Book</span>
                            <span class="fw-semibold text-dark">{{ $items->count() }} item</span>
                        </div>
                        
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Format Pengiriman</span>
                            <span class="fw-semibold text-success">Unduhan Digital</span>
                        </div>

                        <hr class="text-slate-200 my-3">

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <span class="text-secondary fw-semibold">Total Tagihan</span>
                            <span class="fw-bold text-primary fs-4">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                                Proses Checkout <i class="bi bi-credit-card-2-back-fill ms-2 fs-5"></i>
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <a href="{{ route('catalog.index') }}" class="text-decoration-none small fw-semibold text-secondary"><i class="bi bi-plus-lg me-1"></i>Tambah e-book rohani lainnya</a>
=======
<x-app-layout>
    <div class="container py-5">
        <div class="mb-5">
            <h1 class="h3 fw-bold text-primary mb-2 font-serif">Keranjang Belanja</h1>
            <p class="text-secondary text-sm">Tinjau kembali pesanan Anda sebelum melakukan pembayaran.</p>
        </div>

        <div class="row g-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 mb-5">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="border-bottom">
                                    <tr>
                                        <th scope="col" class="py-3 px-4 text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Produk</th>
                                        <th scope="col" class="py-3 px-4 text-center text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Harga</th>
                                        <th scope="col" class="py-3 px-4 text-center text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Kuantitas</th>
                                        <th scope="col" class="py-3 px-4 text-end text-uppercase text-muted" style="font-size: 0.75rem; letter-spacing: 1px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom">
                                        <td class="p-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-link text-muted p-0 text-decoration-none shadow-none"><i class="bi bi-x"></i></button>
                                                <div class="bg-light rounded" style="width: 60px; height: 80px;"></div>
                                                <div>
                                                    <h6 class="fw-bold text-primary mb-1 font-serif">Judul</h6>
                                                    <p class="text-muted small mb-2">Penulis</p>
                                                    <span class="badge bg-primary bg-opacity-10 text-primary fw-normal rounded-pill px-2 py-1" style="font-size: 0.7rem;">Kategori</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-center text-secondary small">
                                            Rp 85.000
                                        </td>
                                        <td class="p-4">
                                            <div class="d-flex justify-content-center">
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary border-end-0 px-2" type="button"><i class="bi bi-dash"></i></button>
                                                    <input type="text" class="form-control text-center border-secondary border-start-0 border-end-0 px-0 fw-semibold" value="1" readonly>
                                                    <button class="btn btn-outline-secondary border-start-0 px-2" type="button"><i class="bi bi-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-end fw-bold text-primary">
                                            Rp 85.000
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td class="p-4">
                                            <div class="d-flex align-items-center gap-3">
                                                <button class="btn btn-link text-muted p-0 text-decoration-none shadow-none"><i class="bi bi-x"></i></button>
                                                <div class="bg-light rounded" style="width: 60px; height: 80px;"></div>
                                                <div>
                                                    <h6 class="fw-bold text-primary mb-1 font-serif">Judul</h6>
                                                    <p class="text-muted small mb-2">Penulis</p>
                                                    <span class="badge bg-warning bg-opacity-25 text-warning-emphasis fw-normal rounded-pill px-2 py-1" style="font-size: 0.7rem;">Kategori</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-center text-secondary small">
                                            Rp 65.000
                                        </td>
                                        <td class="p-4">
                                            <div class="d-flex justify-content-center">
                                                <div class="input-group input-group-sm" style="width: 100px;">
                                                    <button class="btn btn-outline-secondary border-end-0 px-2" type="button"><i class="bi bi-dash"></i></button>
                                                    <input type="text" class="form-control text-center border-secondary border-start-0 border-end-0 px-0 fw-semibold" value="1" readonly>
                                                    <button class="btn btn-outline-secondary border-start-0 px-2" type="button"><i class="bi bi-plus"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-end fw-bold text-primary">
                                            Rp 65.000
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <a href="{{ route('catalog.index') }}" class="btn btn-link text-primary text-decoration-none p-0 fw-semibold small">
                                <i class="bi bi-arrow-left me-1"></i> Lanjutkan Belanja
                            </a>
                            <button class="btn btn-link text-muted text-decoration-none p-0 small">Kosongkan Keranjang</button>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
                        </div>
                    </div>
                </div>
            </div>
<<<<<<< HEAD
        @endif
=======

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 2rem;">
                    <div class="card-body p-4">
                        <h5 class="fw-bold text-primary mb-4 font-serif">Ringkasan Pesanan</h5>

                        <div class="d-flex justify-content-between mb-3 text-secondary small">
                            <span>Subtotal (2 item)</span>
                            <span>Rp 150.000</span>
                        </div>

                        <hr class="my-4 text-muted">

                        <div class="d-flex justify-content-between mb-4">
                            <span class="fw-bold text-dark">Total</span>
                            <span class="fw-bold text-primary fs-5">Rp 150.000</span>
                        </div>

                        <a href="#" class="btn btn-primary w-100 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-lock-fill me-2"></i> Lanjut ke Checkout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rekomendasi -->
        <div class="mt-5 pt-5 border-top">
            <h4 class="fw-bold text-primary mb-4 font-serif">Rekomendasi Untuk Anda</h4>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-5 g-4">
                @for($i = 0; $i < 5; $i++)
                <div class="col">
                    <div class="card h-100 border-0 shadow-sm rounded-4">
                        @if($i == 4)
                            <div class="position-absolute top-0 end-0 mt-2 me-2">
                                <span class="badge bg-warning text-dark px-2 py-1 rounded-pill" style="font-size: 0.65rem;">TERBARU</span>
                            </div>
                        @endif
                        <div class="card-img-top bg-light rounded-top-4" style="height: 200px;"></div>
                        <div class="card-body p-3">
                            <div class="text-warning small text-uppercase fw-semibold mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">KATEGORI</div>
                            <h6 class="card-title fw-bold text-primary mb-1 text-truncate" style="font-size: 0.9rem;">JUDUL</h6>
                            <p class="card-text text-dark fw-semibold mb-0" style="font-size: 0.85rem;">Rp 75.000</p>
                        </div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
    </div>
</x-app-layout>
