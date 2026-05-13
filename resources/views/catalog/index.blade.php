@php
    $rupiah = static function ($value): string {
        $number = is_numeric($value) ? (float) $value : 0;
        return 'Rp ' . number_format($number, 0, ',', '.');
    };
@endphp

<x-app-layout>
    <div class="container py-5">
        <form action="{{ route('catalog.index') }}" method="GET" id="filterForm">
            <div class="row g-4 g-lg-5">
                {{-- Sidebar --}}
                <aside class="col-lg-3">
                    <div class="mb-5">
                        <h5 class="fw-bold text-primary mb-3">Kategori</h5>
                        <div class="d-flex flex-column gap-2">
                            @foreach($categories as $category)
                                <div class="form-check d-flex align-items-center justify-content-between">
                                    <div>
                                        <input class="form-check-input border-primary" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat-{{ $category->id }}" 
                                            {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}
                                            onchange="document.getElementById('filterForm').submit()">
                                        <label class="form-check-label text-secondary small ms-2" for="cat-{{ $category->id }}">
                                            {{ $category->nama_kategori }}
                                        </label>
                                    </div>
                                    <span class="text-secondary opacity-50 small">({{ $category->books_count }})</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-bold text-primary mb-3">Rentang Harga</h5>
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <input type="number" name="min_price" class="form-control form-control-sm border-opacity-25" placeholder="Min Rp" value="{{ request('min_price') }}">
                            <span class="text-secondary">-</span>
                            <input type="number" name="max_price" class="form-control form-control-sm border-opacity-25" placeholder="Max Rp" value="{{ request('max_price') }}">
                        </div>
                        <button type="submit" class="btn btn-outline-primary btn-sm w-100 rounded-pill fw-bold">Terapkan</button>
                    </div>
                </aside>

                {{-- Main Content --}}
                <main class="col-lg-9">
                    {{-- Toolbar --}}
                    <div class="d-flex align-items-center justify-content-between mb-4 pb-3">
                        <div class="text-secondary small">
                            Menampilkan {{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }} dari {{ $books->total() }} buku
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center gap-2">
                                <span class="text-secondary small">Urutkan:</span>
                                <select name="sort" class="form-select form-select-sm border-opacity-25 rounded-pill" style="width: 150px;" onchange="document.getElementById('filterForm').submit()">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Terlama</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                </select>
                            </div>
                            <div class="d-flex gap-1">
                                <button type="button" class="btn btn-sm btn-primary p-1 px-2 rounded-1"><i class="bi bi-grid-fill"></i></button>
                                <button type="button" class="btn btn-sm btn-light border p-1 px-2 rounded-1"><i class="bi bi-list"></i></button>
                            </div>
                        </div>
                    </div>

                    {{-- Book Grid --}}
                    <div class="row g-4">
                        @forelse ($books as $book)
                            <div class="col-md-6 col-lg-4">
                                <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">
                                    <div class="bg-light p-3" style="aspect-ratio: 3/4;">
                                        @if($book->file_buku && Storage::disk('public')->exists($book->file_buku))
                                            <img src="{{ asset('storage/' . $book->file_buku) }}" class="w-100 h-100 object-fit-cover rounded-3 shadow-sm" alt="{{ $book->judul }}">
                                        @else
                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary-subtle rounded-3">
                                                <i class="bi bi-book text-secondary opacity-25 fs-1"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="text-uppercase text-secondary x-small fw-bold mb-1" style="font-size: 0.65rem; letter-spacing: 0.5px;">
                                            {{ $book->category->nama_kategori ?? 'UMUM' }}
                                        </div>
                                        <h6 class="card-title fw-bold text-primary mb-1 text-truncate" style="font-size: 1rem;">
                                            <a href="{{ route('catalog.show', $book) }}" class="text-decoration-none text-primary">{{ $book->judul }}</a>
                                        </h6>
                                        <p class="text-secondary small mb-3">{{ $book->penulis }}</p>
                                        
                                        <div class="fw-bold mb-3" style="color: #d4a017;">{{ $rupiah($book->harga) }}</div>
                                        
                                        <a href="{{ route('catalog.show', $book) }}" class="btn btn-primary w-100 rounded-pill py-2 fw-bold" style="background-color: #2b65f6; border-color: #2b65f6; font-size: 0.85rem;">
                                            Beli
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <i class="bi bi-journal-x display-1 text-secondary opacity-25"></i>
                                <p class="mt-3 text-secondary">Tidak ada buku yang sesuai dengan kriteria pencarian Anda.</p>
                                <a href="{{ route('catalog.index') }}" class="btn btn-link text-primary">Reset Filter</a>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-5 d-flex justify-content-center">
                        {{ $books->links('pagination::bootstrap-5') }}
                    </div>
                </main>
            </div>
        </form>
    </div>

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.08) !important;
        }
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
        .form-check-input:checked {
            background-color: #2b65f6;
            border-color: #2b65f6;
        }
        .x-small {
            font-size: 0.75rem;
        }
        .pagination {
            --bs-pagination-border-radius: 0.5rem;
            --bs-pagination-active-bg: #2b65f6;
            --bs-pagination-active-border-color: #2b65f6;
        }
    </style>
</x-app-layout>
