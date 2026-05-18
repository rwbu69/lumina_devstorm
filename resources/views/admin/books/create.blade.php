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

    <x-admin.card>
        <div class="alert alert-info mb-0">
            Form tambah buku akan ditempatkan di sini (placeholder UI).
        </div>
    </x-admin.card>
</x-admin.layout>
