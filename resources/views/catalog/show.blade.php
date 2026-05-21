<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="container py-5">
        <!-- Back Link -->
        <div class="mb-4">
            <a href="{{ route('catalog.index') }}" class="text-decoration-none text-secondary fw-semibold">
                <i class="bi bi-chevron-left me-1"></i> Kembali ke Katalog
            </a>
        </div>

        <div class="row g-5">
            <!-- Left Side: Cover Display & Buy Card -->
            <div class="col-lg-5 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white mb-4">
                    <div class="bg-primary-subtle d-flex align-items-center justify-content-center p-5" style="height: 380px;">
                        <div class="text-primary text-center">
                            <i class="bi bi-book-half display-1 mb-3 d-block"></i>
                            <h3 class="fw-bold">{{ $book->judul }}</h3>
                            <p class="opacity-75 mb-0">E-Book Kristen</p>
                        </div>
                    </div>
                </div>

                <!-- Price and Add to Cart Card -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                    <div class="mb-3">
                        <span class="text-secondary small d-block mb-1">Harga Spesial Digital</span>
                        <h2 class="fw-bold text-primary mb-0">Rp {{ number_format($book->harga, 0, ',', '.') }}</h2>
                    </div>

                    <hr class="text-slate-200 my-3">

                    <div class="d-flex flex-column gap-2">
                        @php
                            $inCart = $cartService->has($book->id);
                        @endphp
                        
                        <form action="{{ route('cart.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @if ($inCart)
                                <a href="{{ route('cart.index') }}" class="btn btn-success w-100 py-3 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart-check-fill me-2 fs-5"></i> Lihat di Keranjang
                                </a>
                            @else
                                <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold shadow-sm d-flex align-items-center justify-content-center">
                                    <i class="bi bi-cart-plus me-2 fs-5"></i> Beli E-Book Sekarang
                                </button>
                            @endif
                        </form>
                        
                        <div class="text-center mt-2">
                            <span class="text-secondary small"><i class="bi bi-shield-check text-success me-1"></i>Akses instan selamanya setelah terverifikasi</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Details & Synopsis -->
            <div class="col-lg-7 col-xl-8">
                <!-- Book Title Metadata -->
                <div class="mb-4">
                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill fw-semibold mb-2">{{ $book->category->nama }}</span>
                    <h1 class="display-6 fw-bold text-dark mb-2">{{ $book->judul }}</h1>
                    <p class="fs-5 text-secondary">Ditulis oleh: <span class="fw-semibold text-primary">{{ $book->penulis }}</span></p>
                </div>

                <!-- Tabs/Section Info -->
                <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-5">
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-file-text me-2"></i>Tentang Buku Ini</h5>
                    <p class="text-secondary leading-relaxed" style="text-align: justify; line-height: 1.7;">
                        Buku rohani Kristen digital berkualitas tinggi ini ditulis secara mendalam oleh {{ $book->penulis }} untuk memperkaya pertumbuhan spiritual dan keimanan Anda sehari-hari. Melalui bab demi bab yang penuh inspirasi, Anda akan dibimbing untuk memahami pesan firman Tuhan dengan cara praktis, relevan, serta penuh damai sejahtera. 
                    </p>
                    <p class="text-secondary leading-relaxed" style="text-align: justify; line-height: 1.7;">
                        Sangat cocok dibaca di kala renungan pagi, evaluasi diri, maupun dalam kelompok sel untuk memperkuat dasar iman di tengah tantangan zaman modern. Dapatkan akses langsung untuk membaca secara fleksibel di laptop, tablet, atau smartphone Anda begitu pembayaran Anda disetujui oleh admin kami.
                    </p>

                    <div class="row g-3 mt-3">
                        <div class="col-6 col-sm-4">
                            <div class="border rounded-3 p-3 text-center bg-light">
                                <span class="text-secondary small d-block mb-1">Format</span>
                                <span class="fw-bold text-dark"><i class="bi bi-file-earmark-pdf text-danger me-1"></i>PDF / E-Book</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="border rounded-3 p-3 text-center bg-light">
                                <span class="text-secondary small d-block mb-1">Kategori</span>
                                <span class="fw-bold text-dark">{{ $book->category->nama }}</span>
                            </div>
                        </div>
                        <div class="col-6 col-sm-4">
                            <div class="border rounded-3 p-3 text-center bg-light">
                                <span class="text-secondary small d-block mb-1">Bahasa</span>
                                <span class="fw-bold text-dark">Indonesia</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Related Books Section -->
                @if ($relatedBooks->isNotEmpty())
                    <div>
                        <h4 class="fw-bold text-primary mb-3">Rekomendasi Serupa</h4>
                        <div class="row g-3">
                            @foreach ($relatedBooks as $rel)
                                <div class="col-sm-6">
                                    <a href="{{ route('catalog.show', $rel->id) }}" class="text-decoration-none card border-0 shadow-sm rounded-4 overflow-hidden bg-white hover-up transition-all h-100">
                                        <div class="row g-0 h-100">
                                            <div class="col-4 bg-primary-subtle d-flex align-items-center justify-content-center" style="min-height: 110px;">
                                                <i class="bi bi-book text-primary fs-3"></i>
                                            </div>
                                            <div class="col-8 p-3 d-flex flex-column justify-content-center">
                                                <h6 class="fw-bold text-dark text-truncate mb-1">{{ $rel->judul }}</h6>
                                                <p class="text-secondary small mb-1">{{ $rel->penulis }}</p>
                                                <span class="fw-bold text-primary small">Rp {{ number_format($rel->harga, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <style>
        .hover-up:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06) !important;
        }
    </style>
</x-app-layout>
