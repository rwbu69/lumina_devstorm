<x-admin.layout :title="'Lumina Media - Kelola Buku'">
    <x-admin.section-header
        title="Kelola Buku"
        subtitle="Tambah, ubah, dan arsipkan buku yang dijual di Lumina Media."
    >
        <a href="{{ route('admin.books.create') }}" class="btn btn-primary rounded-3">
            <i class="bi bi-plus-lg me-2"></i>
            Tambah Buku
        </a>
    </x-admin.section-header>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 mt-3" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mt-4"></div>

    <x-table :headers="['Judul', 'Penulis', 'Kategori', 'Harga', 'Aksi']">
        @forelse($books as $book)
        <tr>
            <td class="fw-semibold">{{ $book->judul }}</td>
            <td class="text-secondary">{{ $book->penulis }}</td>
            <td><span class="badge text-bg-light border">{{ $book->category->nama ?? '-' }}</span></td>
            <td class="text-end fw-semibold">Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
            <td class="text-end">
                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-light border">Edit</a>
                <button
                    type="button"
                    class="btn btn-sm btn-outline-danger"
                    data-bs-toggle="modal"
                    data-bs-target="#deleteModal-{{ $book->id }}"
                >
                    Hapus
                </button>

                <x-confirm-modal
                    :id="'deleteModal-' . $book->id"
                    title="Konfirmasi Hapus"
                    :message="'Apakah kamu yakin ingin menghapus buku &quot;' . $book->judul . '&quot;? Tindakan ini tidak dapat dibatalkan.'"
                    :action="route('admin.books.destroy', $book->id)"
                    method="DELETE"
                    theme="danger"
                />
            </td>
        </tr>
        @empty
        @endforelse

        <x-slot:emptyState>
            <div class="text-center py-4">
                <i class="bi bi-book fs-1 text-secondary"></i>
                <div class="fw-semibold mt-2">Belum ada buku</div>
                <div class="text-secondary small">Tambahkan buku pertama untuk ditampilkan di sini.</div>
            </div>
        </x-slot:emptyState>
    </x-table>

    @if($books->hasPages())
        <div class="mt-3">
            {{ $books->links() }}
        </div>
    @endif
</x-admin.layout>