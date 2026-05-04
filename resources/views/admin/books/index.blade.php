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

    <div class="mt-4"></div>

    <x-table :headers="['Judul', 'Penulis', 'Kategori', 'Harga', 'Aksi']">
        @forelse($books as $book)
        <tr>
            <td class="fw-semibold">{{ $book->judul }}</td>
            <td class="text-secondary">{{ $book->penulis }}</td>
            <td><span class="badge text-bg-light border">{{ $book->category?->name ?? '-' }}</span></td>
            <td class="text-end fw-semibold">Rp {{ number_format($book->harga, 0, ',', '.') }}</td>
            <td class="text-end">
                <a href="{{ route('admin.books.edit', $book->id) }}" class="btn btn-sm btn-light border">Edit</a>

                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">Belum ada data buku.</td>
        </tr>
        @endforelse
    </x-table>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</x-admin.layout>
