@php
    $rupiah = static function ($value): string {
        $number = is_numeric($value) ? (float) $value : 0;
        return 'Rp ' . number_format($number, 0, ',', '.');
    };
@endphp

<x-app-layout>
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-primary mb-3">Katalog Buku</h1>
            <p class="text-secondary lead mx-auto" style="max-width: 700px;">
                Jelajahi koleksi literatur rohani pilihan kami untuk memperdalam iman dan memperkaya wawasan spiritual Anda.
            </p>
        </div>

        <div class="row g-4">
            @forelse ($books as $book)
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition-all rounded-4 overflow-hidden">
                        <div class="position-relative">
                            @if($book->file_buku)
                                <img src="{{ asset('storage/' . $book->file_buku) }}" class="card-img-top" alt="{{ $book->judul }}" style="height: 250px; object-fit: cover;">
                            @else
                                <div class="bg-primary-subtle d-flex align-items-center justify-content-center" style="height: 250px;">
                                    <i class="bi bi-book text-primary opacity-50 display-4"></i>
                                </div>
                            @endif
                            <div class="position-absolute top-0 end-0 m-2">
                                <span class="badge bg-white text-primary shadow-sm rounded-pill px-2 py-1">
                                    {{ $book->category->nama ?? 'Umum' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-primary mb-1 text-truncate">{{ $book->judul }}</h5>
                            <p class="small text-secondary mb-3">{{ $book->penulis }}</p>
                            <div class="d-flex align-items-center justify-content-between mt-auto">
                                <span class="fw-bold text-primary">{{ $rupiah($book->harga) }}</span>
                                <a href="{{ route('catalog.show', $book) }}" class="btn btn-outline-primary btn-sm rounded-pill px-3">Detail</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="py-5">
                        <i class="bi bi-journal-x display-1 text-secondary opacity-25"></i>
                        <p class="mt-3 text-secondary">Belum ada buku yang tersedia di katalog.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>

    <style>
        .hover-shadow:hover {
            transform: translateY(-5px);
            box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important;
        }
        .transition-all {
            transition: all 0.3s ease-in-out;
        }
    </style>
</x-app-layout>
