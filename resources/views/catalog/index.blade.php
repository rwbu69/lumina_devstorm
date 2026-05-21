<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="container py-5">
        <div class="row g-4">
            
            <!-- Left Side: Filter Kategori (Sidebar) -->
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 80px; background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(8px);">
                    <h5 class="fw-bold text-primary mb-3"><i class="bi bi-filter-left me-2"></i>Filter</h5>
                    
                    <!-- Search Input for Mobile/Tablet -->
                    <form action="{{ route('catalog.index') }}" method="GET" class="mb-4 d-sm-none">
                        <div class="input-group border rounded-3 overflow-hidden">
                            <span class="input-group-text bg-white border-0"><i class="bi bi-search text-secondary"></i></span>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari buku..." class="form-control border-0 bg-white" style="box-shadow: none;">
                        </div>
                    </form>

                    <!-- Kategori List -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold text-secondary small uppercase tracking-wider mb-2">Kategori</label>
                        <div class="d-flex flex-column gap-2">
                            <a href="{{ route('catalog.index', ['q' => request('q')]) }}" 
                               class="d-flex justify-content-between align-items-center px-3 py-2 rounded-3 text-decoration-none transition-all {{ !request('category') ? 'bg-primary text-white fw-bold shadow-sm' : 'text-slate-700 bg-light-hover' }}">
                                <span>Semua Buku</span>
                                <span class="badge rounded-pill {{ !request('category') ? 'bg-white text-primary' : 'bg-secondary-subtle text-secondary' }}">
                                    {{ \App\Models\Book::count() }}
                                </span>
                            </a>
                            
                            @foreach ($categories as $cat)
                                <a href="{{ route('catalog.index', ['category' => $cat->id, 'q' => request('q')]) }}" 
                                   class="d-flex justify-content-between align-items-center px-3 py-2 rounded-3 text-decoration-none transition-all {{ request('category') == $cat->id ? 'bg-primary text-white fw-bold shadow-sm' : 'text-slate-700 bg-light-hover' }}">
                                    <span>{{ $cat->nama }}</span>
                                    <span class="badge rounded-pill {{ request('category') == $cat->id ? 'bg-white text-primary' : 'bg-secondary-subtle text-secondary' }}">
                                        {{ $cat->books()->count() }}
                                    </span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    @if(request()->anyFilled(['q', 'category']))
                        <a href="{{ route('catalog.index') }}" class="btn btn-outline-danger w-100 rounded-3"><i class="bi bi-trash me-2"></i>Bersihkan Filter</a>
                    @endif
                </div>
            </div>

            <!-- Right Side: E-book Grid -->
            <div class="col-lg-9">
                <!-- Header Katalog -->
                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-4 gap-3">
                    <div>
                        <h1 class="h3 fw-bold text-primary mb-1">Katalog Buku Digital</h1>
                        <p class="text-secondary mb-0">Menampilkan {{ $books->total() }} koleksi e-book bermutu</p>
                    </div>
                    
                    <!-- Search Input (Desktop) -->
                    <div class="d-none d-sm-block" style="width: 300px;">
                        <form action="{{ route('catalog.index') }}" method="GET">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            <div class="input-group border rounded-4 overflow-hidden bg-white shadow-sm">
                                <span class="input-group-text bg-white border-0 ps-3"><i class="bi bi-search text-secondary"></i></span>
                                <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari buku..." class="form-control border-0 py-2 ps-1" style="box-shadow: none; font-size: 0.9rem;">
                                @if(request('q'))
                                    <a href="{{ route('catalog.index', ['category' => request('category')]) }}" class="btn bg-white border-0 text-secondary pe-3 d-flex align-items-center"><i class="bi bi-x-circle-fill"></i></a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Buku Grid -->
                <div class="row g-4">
                    @forelse ($books as $book)
                        @php
                            $inCart = $cartService->has($book->id);
                        @endphp
                        <div class="col-md-4 col-sm-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-up transition-all">
                                <!-- Cover Placeholder -->
                                <div class="bg-primary-subtle d-flex align-items-center justify-content-center position-relative" style="height: 220px;">
                                    <div class="text-primary text-center px-3">
                                        <i class="bi bi-book-half display-6 mb-2 d-block"></i>
                                        <span class="fw-bold d-block text-truncate" style="max-width: 180px;">{{ $book->judul }}</span>
                                        <small class="opacity-75">{{ $book->penulis }}</small>
                                    </div>
                                    <span class="position-absolute top-3 start-3 badge bg-primary shadow-sm">{{ $book->category->nama }}</span>
                                </div>

                                <!-- Body -->
                                <div class="card-body p-4 d-flex flex-column justify-content-between">
                                    <div>
                                        <h5 class="card-title fw-bold text-dark mb-1 text-truncate" title="{{ $book->judul }}">{{ $book->judul }}</h5>
                                        <p class="card-text text-secondary small mb-3">Oleh: <span class="fw-semibold">{{ $book->penulis }}</span></p>
                                    </div>
                                    
                                    <div>
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <span class="text-secondary small">Harga E-Book</span>
                                            <span class="fw-bold text-primary fs-5">Rp {{ number_format($book->harga, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="d-flex gap-2">
                                            <a href="{{ route('catalog.show', $book->id) }}" class="btn btn-outline-primary w-50 rounded-3 py-2 fw-semibold btn-sm"><i class="bi bi-eye me-1"></i>Detail</a>
                                            
                                            <form action="{{ route('cart.store') }}" method="POST" class="w-50">
                                                @csrf
                                                <input type="hidden" name="book_id" value="{{ $book->id }}">
                                                @if ($inCart)
                                                    <a href="{{ route('cart.index') }}" class="btn btn-success w-100 rounded-3 py-2 fw-semibold btn-sm"><i class="bi bi-cart-check-fill"></i></a>
                                                @else
                                                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-2 fw-semibold btn-sm"><i class="bi bi-cart-plus me-1"></i>Beli</button>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="text-center py-5 bg-white rounded-4 shadow-sm">
                                <i class="bi bi-journal-x display-1 text-secondary opacity-50 mb-3"></i>
                                <h4 class="fw-bold text-secondary">Buku Tidak Ditemukan</h4>
                                <p class="text-secondary">Silakan coba cari dengan kata kunci lain atau bersihkan filter.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="mt-5 d-flex justify-content-center">
                    {{ $books->links() }}
                </div>

            </div>
        </div>
    </div>

    <style>
        .hover-up:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08) !important;
        }
        .bg-light-hover {
            color: #334155 !important;
            background-color: transparent;
        }
        .bg-light-hover:hover {
            background-color: #f1f5f9;
        }
    </style>
</x-app-layout>
