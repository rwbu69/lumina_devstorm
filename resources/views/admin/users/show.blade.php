<x-admin.layout>
    <nav aria-label="breadcrumb" class="mb-2">
        <ol class="breadcrumb mb-0" style="font-size: 0.78rem;">
            <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" class="text-decoration-none text-muted">Kelola User</a></li>
            <li class="breadcrumb-item active text-dark fw-medium" aria-current="page">{{ $user->nama }}</li>
        </ol>
    </nav>

    {{-- Page Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h4 fw-bold text-primary mb-0">Informasi Akun</h1>
            <p class="text-muted mb-0" style="font-size: 0.82rem;">Profil dan akses pengguna {{ $user->nama }}</p>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-white bg-white border rounded-3 px-3 py-1 shadow-sm d-flex align-items-center gap-2 btn-sm" style="font-size: 0.82rem;">
                <i class="bi bi-shield-lock text-muted small"></i>
                <span class="fw-medium">Reset Password</span>
            </button>
            <button class="btn btn-primary px-3 py-1 rounded-3 shadow-sm d-flex align-items-center gap-2 fw-bold btn-sm" style="font-size: 0.82rem;">
                <i class="bi bi-pencil-square small"></i>
                <span>Ubah Profil</span>
            </button>
        </div>
    </div>

    {{-- Profile Card --}}
    <div class="card border-0 shadow-sm rounded-4 mb-3 bg-white">
        <div class="card-body p-4">
            <div class="d-flex gap-4 align-items-center">
                {{-- Avatar --}}
                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center flex-shrink-0"
                     style="width: 72px; height: 72px; background-color: #F3F4F6;">
                    <i class="bi bi-person-fill text-muted" style="font-size: 2rem;"></i>
                </div>

                {{-- Info Grid --}}
                <div class="flex-grow-1">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.65rem; letter-spacing: 0.06em;">Nama Lengkap</div>
                            <div class="fw-bold text-dark" style="font-size: 0.9rem;">{{ $user->nama }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.65rem; letter-spacing: 0.06em;">Email</div>
                            <div class="fw-medium text-dark" style="font-size: 0.85rem;">{{ $user->email }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.65rem; letter-spacing: 0.06em;">Peran Akses</div>
                            <span class="badge rounded-pill px-3 py-1 fw-bold" style="background-color: #E8F0FE; color: #1a4fd9; font-size: 0.72rem;">
                                {{ strtoupper($user->role) }}
                            </span>
                        </div>
                        <div class="col-md-4">
                            <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.65rem; letter-spacing: 0.06em;">Tanggal Bergabung</div>
                            <div class="fw-medium text-dark" style="font-size: 0.85rem;">{{ $user->created_at->format('d F Y') }}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-uppercase fw-bold text-muted mb-1" style="font-size: 0.65rem; letter-spacing: 0.06em;">Password</div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="fw-bold text-dark" style="font-size: 0.85rem; letter-spacing: 0.1em;">••••••••••••</span>
                                <i class="bi bi-eye text-primary small" style="cursor: pointer;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Akses Buku Section --}}
    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <h6 class="fw-bold text-dark mb-0">Akses Buku</h6>
            <button class="btn btn-sm px-3 py-1 rounded-3 fw-bold d-flex align-items-center gap-1" style="background-color: #E8F0FE; color: #1a4fd9; font-size: 0.78rem;">
                <i class="bi bi-journal-plus small"></i>
                <span>Tambah Akses</span>
            </button>
        </div>

        <div class="card border-0 shadow-sm rounded-3 bg-white">
            <div class="card-body p-3">
                <div class="row g-2">
                    @forelse($books as $book)
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card border rounded-3 bg-light h-100" style="border-color: #eee !important;">
                                <div class="card-body p-2">
                                    <div class="d-flex gap-2 align-items-start">
                                        <div class="rounded-2 overflow-hidden flex-shrink-0" style="width: 42px; height: 58px; background-color: #e5e7eb;">
                                            @if($book->cover_image)
                                                <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-100 h-100" style="object-fit: cover;">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                                                    <i class="bi bi-book small"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1 overflow-hidden">
                                            <div class="fw-bold text-dark text-truncate" style="font-size: 0.8rem;">{{ $book->judul }}</div>
                                            <div class="text-muted text-truncate" style="font-size: 0.7rem;">{{ $book->id_buku ?? 'BUKU-' . $book->id }}</div>
                                            <div class="d-flex justify-content-between align-items-center mt-1">
                                                <span class="text-success fw-bold" style="font-size: 0.68rem;">● AKTIF</span>
                                                <button class="btn btn-link text-danger p-0 border-0" style="font-size: 0.75rem;">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 py-4 text-center text-muted">
                            <i class="bi bi-journal-x d-block mb-2 opacity-50" style="font-size: 1.8rem;"></i>
                            <span style="font-size: 0.82rem;">Belum ada akses buku untuk pengguna ini.</span>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- Danger Zone --}}
    <div class="card border-0 rounded-4" style="background-color: #FFF1F2;">
        <div class="card-body px-4 py-3 d-flex justify-content-between align-items-center">
            <div>
                <div class="fw-bold text-danger mb-0" style="font-size: 0.85rem;">Hapus Akun Pengguna</div>
                <div class="text-danger opacity-75" style="font-size: 0.75rem;">Tindakan ini permanen. Semua data akan dihapus.</div>
            </div>
            <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-outline-danger px-3 py-1 rounded-3 fw-bold bg-white btn-sm" style="font-size: 0.8rem;">
                    Hapus Akun
                </button>
            </form>
        </div>
    </div>

    @push('styles')
    <style>
        .cursor-pointer { cursor: pointer; }
        .breadcrumb-item + .breadcrumb-item::before { content: ">"; opacity: 0.5; }
    </style>
    @endpush
</x-admin.layout>
