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
        <tr>
            <td class="fw-semibold">Dasar-Dasar Laravel 11</td>
            <td class="text-secondary">Dewi Prameswari</td>
            <td><span class="badge text-bg-light border">Teknologi</span></td>
            <td class="text-end fw-semibold">Rp 150.000</td>
            <td class="text-end">
                <a href="#" class="btn btn-sm btn-light border">Edit</a>
                <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
            </td>
        </tr>
        <tr>
            <td class="fw-semibold">Strategi Bisnis Digital</td>
            <td class="text-secondary">Rizky Maulana</td>
            <td><span class="badge text-bg-light border">Bisnis</span></td>
            <td class="text-end fw-semibold">Rp 95.000</td>
            <td class="text-end">
                <a href="#" class="btn btn-sm btn-light border">Edit</a>
                <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
            </td>
        </tr>
    </x-table>
</x-admin.layout>
