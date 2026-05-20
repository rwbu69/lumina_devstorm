<x-admin.layout :title="'Lumina Media - Informasi Akun'">
    <div class="mb-3 text-muted" style="font-size: 13px;">
        Kelola User &nbsp;›&nbsp; <span class="text-dark fw-medium">Siti Aminah</span>
    </div>

    <x-admin.section-header
        title="Informasi Akun"
        subtitle="Informasi lengkap profil dan akses pengguna Siti Aminah"
    >
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-white border border-secondary-subtle rounded-3 px-3 py-2 text-dark bg-white shadow-sm d-flex align-items-center gap-2" style="font-size: 13px; font-weight: 500;">
                <i class="bi bi-arrow-counterclockwise"></i> Reset Password
            </button>
            <button type="button" class="btn btn-primary rounded-3 px-3 py-2 shadow-sm d-flex align-items-center gap-2" style="font-size: 13px; background-color: #0A5AD1; font-weight: 500; border: 0;">
                <i class="bi bi-pencil"></i> Ubah Profil
            </button>
        </div>
    </x-admin.section-header>

    <div class="mt-4"></div>

    <div class="card border-0 rounded-4 shadow-sm mb-5" style="background-color: #ffffff;">
        <div class="card-body p-4 d-flex align-items-center gap-5 flex-wrap flex-md-nowrap">
            <div class="rounded-circle shrink-0 flex-none" style="width: 120px; height: 120px; background-color: #CCCCCC;"></div>
            
            <div class="row g-4 flex-grow-1 w-100">
                <div class="col-6 col-md-5">
                    <label class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 10px; color: #999999 !important;">Nama Lengkap</label>
                    <div class="fw-bold text-dark mt-1" style="font-size: 16px;">Siti Aminah</div>
                </div>
                <div class="col-6 col-md-7">
                    <label class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 10px; color: #999999 !important;">Email</label>
                    <div class="fw-semibold text-dark mt-1" style="font-size: 15px;">siti.aminah@gmail.com</div>
                </div>
                <div class="col-6 col-md-5">
                    <label class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 10px; color: #999999 !important;">Tanggal Bergabung</label>
                    <div class="fw-bold text-dark mt-1" style="font-size: 15px;">12 Januari 2023</div>
                </div>
                <div class="col-6 col-md-7">
                    <label class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 10px; color: #999999 !important;">Peran Akses</label>
                    <div class="mt-1">
                        <span class="badge rounded-pill text-primary bg-primary-subtle bg-opacity-25 px-3 py-1.5 font-semibold border-0" style="font-size: 10px; background-color: #E8F0FE; color: #1967D2 !important;">
                            Admin Konten
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <label class="text-uppercase text-muted fw-bold tracking-wider" style="font-size: 10px; color: #999999 !important;">Password</label>
                    <div class="d-flex align-items-center gap-2 mt-1">
                        <span class="text-dark font-monospace fw-bold" style="letter-spacing: 4px; font-size: 15px;">•••••••••••••</span>
                        <button type="button" class="btn btn-link p-0 text-primary mb-1"><i class="bi bi-eye"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
        <h4 class="fw-bold text-dark m-0" style="font-size: 20px;">Akses Buku</h4>
        <button type="button" class="btn btn-light border border-0 rounded-3 text-primary shadow-sm d-flex align-items-center gap-1 px-3 py-2" style="font-size: 12px; font-weight: 500; background-color: #D2E3FC; color: #1967D2 !important;">
            <i class="bi bi-journal-plus"></i> Tambah Akses Buku
        </button>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-12 col-md-4">
            <div class="card border-0 rounded-3 shadow-sm" style="background-color: #ffffff;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-2" style="width: 50px; height: 65px; background-color: #CCCCCC;"></div>
                        <div>
                            <div class="fw-bold text-dark mb-0" style="font-size: 14px;">Judul</div>
                            <div class="text-muted font-monospace" style="font-size: 11px;">ID: BUKU-0012</div>
                            <span class="text-success fw-bold text-uppercase d-block mt-1" style="font-size: 10px; tracking-wider: 1px;">Aktif</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-link text-muted p-0"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 rounded-3 shadow-sm" style="background-color: #ffffff;">
                <div class="card-body p-3 d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-2" style="width: 50px; height: 65px; background-color: #CCCCCC;"></div>
                        <div>
                            <div class="fw-bold text-dark mb-0" style="font-size: 14px;">Judul</div>
                            <div class="text-muted font-monospace" style="font-size: 11px;">ID: BUKU-0045</div>
                            <span class="text-success fw-bold text-uppercase d-block mt-1" style="font-size: 10px; tracking-wider: 1px;">Aktif</span>
                        </div>
                    </div>
                    <button type="button" class="btn btn-link text-muted p-0"><i class="bi bi-trash"></i></button>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="card border-0 rounded-3 d-flex align-items-center justify-content-center p-3 text-muted text-center h-100" style="background-color: #ffffff; min-height: 85px; border: 1px dashed #E0E0E0 !important;">
                <div style="font-size: 13px; color: #A0A0A0;">
                    Belum ada buku lain
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 rounded-4 mb-5" style="background-color: #FCE8E6;">
        <div class="card-body p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <div class="fw-bold text-dark mb-1" style="font-size: 15px;">Hapus Akun Pengguna</div>
                <div class="text-muted" style="font-size: 13px; color: #555555;">Tindakan ini permanen. Semua data akses dan profil akan dihapus dari sistem.</div>
            </div>
            <button type="button" class="btn btn-outline-danger bg-white fw-bold rounded-3 px-4 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" style="font-size: 13px; border-color: #F87171; color: #EF4444;">
                Hapus Akun
            </button>
        </div>
    </div>

    <div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 360px;">
            <div class="modal-content rounded-4 border-0 shadow-lg p-3" style="background-color: #ffffff;">
                <div class="modal-body text-center p-2">
                    <div class="mx-auto text-danger rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 50px; height: 50px; background-color: #FCE8E6;">
                        <i class="bi bi-exclamation-triangle fs-4" style="color: #EF4444;"></i>
                    </div>
                    
                    <h6 class="fw-bold text-dark mb-2" id="deleteModalLabel" style="font-size: 16px;">Konfirmasi Hapus Akun</h6>
                    <p class="text-muted px-2 mb-1" style="font-size: 12px; line-height: 1.5;">
                        Apakah Anda yakin ingin menghapus akun <span class="fw-bold text-dark">[Siti Aminah]</span>? Tindakan ini akan menghapus semua data akses buku dan <span class="text-danger fw-semibold">tidak dapat dibatalkan</span>.
                    </p>

                    <div class="row g-2 mt-4">
                        <div class="col-6">
                            <button type="button" class="btn btn-white border border-secondary-subtle w-100 py-2 rounded-2 text-dark bg-white fw-semibold" data-bs-dismiss="modal" style="font-size: 13px;">
                                Batal
                            </button>
                        </div>
                        <div class="col-6">
                            <form action="{{ route('admin.users.destroy', 2) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100 py-2 rounded-2 fw-semibold shadow-sm" style="font-size: 13px; background-color: #EF4444; border: 0;">
                                    Hapus Akun
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>