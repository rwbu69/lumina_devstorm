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
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
