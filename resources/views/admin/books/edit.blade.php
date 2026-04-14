<x-admin.layout :title="'Lumina Media - Edit Buku'">
    <x-admin.section-header
        title="Edit Buku"
        subtitle="Perbarui informasi buku sebelum disimpan."
    >
        <a href="{{ route('admin.books.show', $book) }}" class="btn btn-light border rounded-3">
            <i class="bi bi-eye me-2"></i>
            Lihat
        </a>
        <a href="{{ route('admin.books.index') }}" class="btn btn-light border rounded-3">
            Kembali
        </a>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <x-admin.card>
        <div class="alert alert-warning mb-0">
            Form edit buku untuk <span class="fw-semibold">{{ $book->judul }}</span> akan ditempatkan di sini (placeholder UI).
        </div>
    </x-admin.card>
</x-admin.layout>
