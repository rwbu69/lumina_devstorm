<x-admin.layout :title="'Lumina Media - Kelola User'">
    <x-admin.section-header
        title="Kelola Pengguna"
        subtitle="Manajemen data profil, hak akses akun, dan penghapusan pengguna."
    >
        <button type="button" class="btn btn-primary rounded-3">
            <i class="bi bi-person-plus me-2"></i>Tambah Admin
        </button>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="row">
        <div class="col-12">
            <x-table :headers="['Nama Pengguna', 'Email Address', 'Hak Akses', 'Aksi']">
                <x-slot:header>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div class="fw-bold">Daftar Pengguna Aktif</div>
                        <span class="badge bg-secondary rounded-pill">2 Total User</span>
                    </div>
                </x-slot:header>

                <tr>
                    <td class="fw-semibold">Budi Santoso</td>
                    <td class="text-secondary">budi@example.com</td>
                    <td><span class="badge bg-light text-dark border">Pelanggan</span></td>
                    <td>
                        <a href="#" class="btn btn-sm btn-outline-secondary rounded-2">Detail</a>
                    </td>
                </tr>

                <tr>
                    <td class="fw-semibold">Siti Aminah</td>
                    <td class="text-secondary">siti.aminah@gmail.com</td>
                    <td><span class="badge bg-info-subtle text-info border border-info-subtle">Admin Kantor</span></td>
                    <td>
                        <a href="/admin/users/show" class="btn btn-sm btn-primary rounded-2 px-3">
                            Detail & Aksi
                        </a>
                    </td>
                </tr>
            </x-table>
        </div>
    </div>
</x-admin.layout>