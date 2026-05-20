<x-admin.layout :title="'Lumina Media - Tambah Buku'">
    <x-admin.section-header
        title="Tambah Buku"
        subtitle="Lengkapi informasi buku baru sebelum dipublikasikan."
    >
        <a href="{{ route('admin.books.index') }}" class="btn btn-light border rounded-3">
            <i class="bi bi-arrow-left me-2"></i>
            Kembali
        </a>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="card lm-card rounded-4">
        <div class="card-body">
            <div class="alert alert-info mb-0">
                Form tambah buku akan ditempatkan di sini (placeholder UI).
            </div>
        </div>
    </div>
</x-admin.layout>
