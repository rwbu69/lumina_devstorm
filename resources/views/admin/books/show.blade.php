<x-admin.layout :title="'Lumina Media - Detail Buku'">
    <x-admin.section-header
        title="Detail Buku"
        subtitle="Ringkasan informasi buku yang dipilih."
    >
        <a href="{{ route('admin.books.edit', $book) }}" class="btn btn-primary rounded-3">
            <i class="bi bi-pencil-square me-2"></i>
            Edit
        </a>
        <a href="{{ route('admin.books.index') }}" class="btn btn-light border rounded-3">
            Kembali
        </a>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="card lm-card rounded-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="fw-semibold">Judul</div>
                    <div class="lm-muted">{{ $book->judul }}</div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="fw-semibold">Harga</div>
                    <div class="lm-muted">Rp {{ number_format((float) $book->harga, 0, ',', '.') }}</div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="fw-semibold">Penulis</div>
                    <div class="lm-muted">{{ $book->penulis }}</div>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="fw-semibold">Kategori</div>
                    <div class="lm-muted">{{ $book->category?->nama_kategori ?? '-' }}</div>
                </div>
                <div class="col-12">
                    <div class="fw-semibold">File Buku</div>
                    <div class="lm-muted">{{ $book->file_buku }}</div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
