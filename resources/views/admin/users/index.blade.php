<x-admin.layout>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h1 class="h3 fw-bold text-primary mb-0">Kelola User</h1>
            <p class="text-muted small mb-0">Manajemen akun pengguna dan bantuan akses.</p>
        </div>
        <button class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 rounded-3 shadow-sm fw-bold btn-sm">
            <i class="bi bi-person-plus-fill"></i>
            <span>Tambah User</span>
        </button>
    </div>

    {{-- Filters & Search --}}
    <div class="card border-0 shadow-sm rounded-3 mb-3 bg-white">
        <div class="card-body p-3">
            <form action="{{ route('admin.users.index') }}" method="GET">
                <div class="input-group bg-white rounded-pill px-3 border shadow-sm" style="max-width: 500px;">
                    <span class="input-group-text bg-transparent border-0 text-muted px-2">
                        <i class="bi bi-search small"></i>
                    </span>
                    <input type="text" name="search" class="form-control bg-transparent border-0 py-2 shadow-none small" 
                           placeholder="Cari berdasarkan nama atau email..." 
                           value="{{ request('search') }}"
                           style="font-size: 0.85rem;">
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead style="background-color: #F9FAFB;">
                    <tr>
                        <th class="px-4 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0" style="width: 35%; font-size: 0.7rem;">Nama Pengguna</th>
                        <th class="px-4 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Alamat Email</th>
                        <th class="px-4 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0" style="font-size: 0.7rem;">Tanggal Bergabung</th>
                        <th class="px-4 py-3 text-uppercase x-small fw-bold text-muted ls-wide border-0 text-center" style="font-size: 0.7rem;">Aksi Bantuan</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    @forelse($users as $user)
                        <tr class="border-bottom bg-white">
                            <td class="px-4 py-3 bg-white">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="avatar-circle rounded-circle bg-primary-subtle text-primary d-grid place-items-center fw-bold" style="width: 36px; height: 36px; min-width: 36px; font-size: 0.7rem; background-color: #E8F0FE;">
                                        {{ strtoupper(substr($user->nama, 0, 2)) }}
                                    </div>
                                    <div class="fw-bold text-dark" style="font-size: 0.85rem;">{{ $user->nama }}</div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-muted fw-medium bg-white" style="font-size: 0.85rem;">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-3 text-muted fw-medium bg-white" style="font-size: 0.85rem;">
                                {{ $user->created_at->format('d M Y') }}
                            </td>
                            <td class="px-4 py-3 text-center bg-white">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-primary-subtle text-primary border-0 btn-xs px-3 py-1 rounded-2 fw-bold" style="background-color: #E8F0FE; font-size: 0.7rem;">
                                    Informasi Akun
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-5 text-center text-muted bg-white small">
                                Tidak ada data pengguna ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- Custom Pagination Footer --}}
        <div class="card-footer p-3 border-top" style="background-color: #F9FAFB;">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <div class="text-muted x-small" style="font-size: 0.75rem;">
                    Menampilkan {{ $users->firstItem() ?? 0 }}-{{ $users->lastItem() ?? 0 }} dari {{ $users->total() }} pengguna
                </div>
                <div class="d-flex gap-2">
                    @if ($users->onFirstPage())
                        <span class="btn btn-light btn-xs px-3 py-1 rounded-2 text-muted disabled border-0" style="font-size: 0.75rem;">Sebelumnya</span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" class="btn btn-light btn-xs px-3 py-1 rounded-2 text-muted border-0" style="font-size: 0.75rem;">Sebelumnya</a>
                    @endif

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" class="btn btn-primary btn-xs px-3 py-1 rounded-2 shadow-sm border-0 fw-bold" style="font-size: 0.75rem;">Selanjutnya</a>
                    @else
                        <span class="btn btn-primary btn-xs px-3 py-1 rounded-2 shadow-sm border-0 fw-bold disabled opacity-50" style="font-size: 0.75rem;">Selanjutnya</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .ls-wide { letter-spacing: 0.05em; }
        .avatar-circle { border: 1.5px solid #fff; }
        .btn-primary-subtle:hover { background-color: #dbeafe !important; }
        .btn-xs { padding: 0.25rem 0.5rem; font-size: 0.75rem; }
        .x-small { font-size: 0.75rem; }
    </style>
    @endpush
</x-admin.layout>
