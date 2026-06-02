<x-admin.layout :title="'Lumina Media - Kelola Buku'">
    @push('styles')
        <style>
            .books-shell {
                
                border-radius: 20px;
                padding: 16px;
            }

            .books-card {
                border: 1px solid rgba(15, 23, 42, .05);
                border-radius: 16px;
                background: #ffffff;
                box-shadow: 0 4px 12px rgba(15, 23, 42, .04);
            }

            .books-title {
                color: #1a4fd9;
                font-size: 1.75rem;
                font-weight: 800;
                letter-spacing: -0.03em;
                margin-bottom: 0.15rem;
            }
            
            .stat-card {
                padding: 1.5rem;
                transition: transform 0.2s;
            }
            
            .stat-card:hover {
                transform: translateY(-4px);
            }
            
            .stat-icon {
                width: 42px;
                height: 42px;
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
            }
            
            .book-cover {
                width: 48px;
                height: 64px;
                background-color: #000;
                color: #fff;
                border-radius: 6px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.6rem;
                font-weight: bold;
                letter-spacing: 1px;
            }
            
            .stock-badge {
                padding: 0.35rem 0.75rem;
                border-radius: 20px;
                font-size: 0.75rem;
                font-weight: 700;
            }
            
            .stock-high { background-color: #d1fae5; color: #065f46; }
            .stock-med { background-color: #fef3c7; color: #92400e; }
            .stock-low { background-color: #fee2e2; color: #991b1b; }
        </style>
    @endpush

    <div class="books-shell">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="books-title">Kelola Buku</h1>
                <p class="text-secondary fw-medium mb-0" style="font-size: 0.95rem; color: #1a4fd9 !important;">Kelola dan atur stok buku pada Lumina Media</p>
            </div>
            <button class="btn btn-primary px-3 py-2 rounded-3 fw-bold btn-sm" style="background-color: #1a4fd9; border: none;" data-bs-toggle="modal" data-bs-target="#modalTambahBuku">
                Tambah Buku
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-4 mb-4 border-0 shadow-sm" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4 mb-5">
            <!-- Total Judul -->
            <div class="col-md-3">
                <div class="books-card stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-secondary fw-semibold">Total Judul</span>
                        <div class="stat-icon" style="background-color: #eff6ff; color: #3b82f6;">
                            <i class="bi bi-journals"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark mb-0">{{ number_format($totalJudul, 0, ',', '.') }}</h2>
                </div>
            </div>
            
            <!-- Stok Rendah -->
            <div class="col-md-3">
                <div class="books-card stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-secondary fw-semibold">Stok Rendah</span>
                        <div class="stat-icon" style="background-color: #fffbeb; color: #d97706;">
                            <i class="bi bi-exclamation-triangle"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark mb-0">{{ number_format($stokRendah, 0, ',', '.') }}</h2>
                </div>
            </div>

            <!-- Terjual Bulan ini -->
            <div class="col-md-3">
                <div class="books-card stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-secondary fw-semibold">Terjual (Bulan ini)</span>
                        <div class="stat-icon" style="background-color: #ecfdf5; color: #10b981;">
                            <i class="bi bi-graph-up-arrow"></i>
                        </div>
                    </div>
                    <h2 class="fw-bold text-dark mb-0">{{ number_format($terjualBulanIni, 0, ',', '.') }}</h2>
                </div>
            </div>

            <!-- Valuasi Stok -->
            <div class="col-md-3">
                <div class="books-card stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <span class="text-secondary fw-semibold">Valuasi Stok</span>
                        <div class="stat-icon" style="background-color: #eff6ff; color: #3b82f6;">
                            <i class="bi bi-cash-stack"></i>
                        </div>
                    </div>
                    @php
                        $valuasiFormat = $valuasiStok;
                        $suffix = '';
                        if ($valuasiStok >= 1000000000) {
                            $valuasiFormat = round($valuasiStok / 1000000000, 1);
                            $suffix = 'M';
                        } elseif ($valuasiStok >= 1000000) {
                            $valuasiFormat = round($valuasiStok / 1000000, 1);
                            $suffix = 'Jt';
                        }
                    @endphp
                    <h2 class="fw-bold text-dark mb-0">Rp {{ $valuasiFormat }}{{ $suffix }}</h2>
                </div>
            </div>
        </div>

        <x-admin.table class="books-card overflow-hidden">
            <x-slot:header>
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom" style="background-color: #F8FAFC;">
                    <h5 class="fw-bold text-primary mb-0" style="color: #1a4fd9 !important;"><i class="bi bi-list-ul me-2"></i>Daftar Inventaris Buku</h5>
                    <div class="d-flex gap-2">
                        <button class="btn btn-light bg-white border text-secondary"><i class="bi bi-filter"></i></button>
                        <button class="btn btn-light bg-white border text-secondary"><i class="bi bi-download"></i></button>
                    </div>
                </div>
            </x-slot:header>

            <x-slot:head>
                    <tr>
                        <th class="px-3 py-3 text-uppercase text-muted fw-bold border-0" style="background-color: #F8FAFC; font-size: 0.75rem; letter-spacing: 1px;">Judul Buku</th>
                        <th class="px-3 py-3 text-uppercase text-muted fw-bold border-0" style="background-color: #F8FAFC; font-size: 0.75rem; letter-spacing: 1px;">Penulis</th>
                        <th class="px-3 py-3 text-uppercase text-muted fw-bold border-0" style="background-color: #F8FAFC; font-size: 0.75rem; letter-spacing: 1px;">Stok</th>
                        <th class="px-3 py-3 text-uppercase text-muted fw-bold border-0" style="background-color: #F8FAFC; font-size: 0.75rem; letter-spacing: 1px;">Harga</th>
                        <th class="px-3 py-3 text-uppercase text-muted fw-bold border-0 text-end" style="background-color: #F8FAFC; font-size: 0.75rem; letter-spacing: 1px;">Aksi</th>
                    </tr>
                </x-slot:head>

                @foreach($books as $book)
                            <tr class="border-bottom">
                                <td class="px-3 py-3" style="background-color: #F8FAFC;">
                                    <div class="d-flex align-items-center gap-3">
                                        @if($book->cover_buku)
                                            <div class="book-cover overflow-hidden bg-transparent border border-slate-200" style="padding: 0;">
                                                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="Cover" class="w-100 h-100" style="object-fit: cover;">
                                            </div>
                                        @else
                                            <div class="book-cover">COVER</div>
                                        @endif
                                        <span class="fw-bold text-dark" style="font-size: 1rem;">{{ $book->judul }}</span>
                                    </div>
                                </td>
                                <td class="px-3 py-3 text-muted fw-medium" style="background-color: #F8FAFC; font-size: 0.85rem;">{{ strtoupper($book->penulis) }}</td>
                                <td class="px-3 py-3" style="background-color: #F8FAFC;">
                                    @php
                                        $stockClass = 'stock-high';
                                        if ($book->stok < 20) $stockClass = 'stock-low';
                                        elseif ($book->stok < 50) $stockClass = 'stock-med';
                                    @endphp
                                    <span class="stock-badge {{ $stockClass }}">{{ $book->stok ?? 0 }}</span>
                                </td>
                                <td class="px-3 py-3 fw-bold text-primary" style="background-color: #F8FAFC; font-size: 0.9rem; color: #1a4fd9 !important;">
                                    Rp {{ number_format($book->harga, 0, ',', '.') }}
                                </td>
                                <td class="px-3 py-3 text-end" style="background-color: #F8FAFC;">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-white border btn-xs px-3 py-1 rounded-2 fw-bold text-muted shadow-sm bg-white" style="font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#modalEditBuku-{{ $book->id }}">
                                            Ubah
                                        </button>
                                        <button type="button" class="btn btn-outline-danger btn-xs px-3 py-1 rounded-2 fw-bold border-0" style="font-size: 0.7rem;" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $book->id }}">
                                            Hapus
                                        </button>
                                    </div>

                                </td>
                            </tr>
                @endforeach

                <x-slot:emptyState>
                    <div class="text-center py-4">
                        <i class="bi bi-book fs-1 text-secondary opacity-50"></i>
                        <div class="fw-bold mt-3 text-dark fs-5">Belum ada buku</div>
                        <div class="text-muted mt-1">Tambahkan buku pertama untuk ditampilkan di sini.</div>
                    </div>
                </x-slot:emptyState>
            <x-slot:pagination>
                @if($books->hasPages())
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">Menampilkan {{ $books->firstItem() }}-{{ $books->lastItem() }} dari {{ $books->total() }} buku</span>
                        <div class="d-flex gap-2">
                            @if ($books->onFirstPage())
                                <button class="btn btn-light bg-white border text-muted px-3 py-1 rounded-3 small" disabled>Sebelumnya</button>
                            @else
                                <a href="{{ $books->previousPageUrl() }}" class="btn btn-light bg-white border text-primary fw-medium px-3 py-1 rounded-3 small">Sebelumnya</a>
                            @endif

                            @if ($books->hasMorePages())
                                <a href="{{ $books->nextPageUrl() }}" class="btn btn-light bg-white border text-primary fw-medium px-3 py-1 rounded-3 small">Selanjutnya</a>
                            @else
                                <button class="btn btn-light bg-white border text-muted px-3 py-1 rounded-3 small" disabled>Selanjutnya</button>
                            @endif
                        </div>
                    </div>
                @endif
            </x-slot:pagination>
        </x-admin.table>
    </div>

    {{-- Modal Tambah Buku --}}
    <div class="modal fade" id="modalTambahBuku" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header border-bottom-0 bg-light px-4 py-3">
                    <h5 class="modal-title fw-bold text-primary" style="font-size: 1.1rem;">Tambah Buku</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body px-4 py-4" style="background-color: #F8FAFC;">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label x-small text-muted fw-bold mb-1">Judul Buku</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small text-muted fw-bold mb-1">Penulis</label>
                                <input type="text" name="penulis" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small text-muted fw-bold mb-1">Kategori</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">Pilih Kategori...</option>
                                    @foreach($categories ?? [] as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label x-small text-muted fw-bold mb-1">Harga</label>
                                <input type="number" name="harga" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label x-small text-muted fw-bold mb-1">Stok</label>
                                <input type="number" name="stok" class="form-control" min="0" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label x-small text-muted fw-bold mb-1">Sinopsis</label>
                                <textarea name="sinopsis" class="form-control" rows="3"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small text-muted fw-bold mb-1">Upload Cover Buku</label>
                                <input type="file" name="cover_buku" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg" onchange="previewImage(this, 'previewTambah')">
                                <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP (Maks 2MB)</small>
                                <div class="mt-2">
                                    <img id="previewTambah" src="" class="img-thumbnail rounded-3" style="max-height: 120px; object-fit: cover; display:none;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label x-small text-muted fw-bold mb-1">Upload File E-Book (PDF)</label>
                                <input type="file" name="file_buku" class="form-control" accept="application/pdf">
                                <small class="text-muted d-block mt-1">Format: PDF (Maks 10MB)</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 px-4 py-3 bg-white">
                        <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-bold small" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 fw-bold small shadow-sm">Simpan Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($books as $book)
        <x-confirm-modal
            :id="'deleteModal-' . $book->id"
            title="Konfirmasi Hapus"
            :message="'Apakah kamu yakin ingin menghapus buku \'' . $book->judul . '\'? Tindakan ini tidak dapat dibatalkan.'"
            :action="route('admin.books.destroy', $book->id)"
            method="DELETE"
            theme="danger"
        />

        {{-- Modal Edit Buku --}}
        <div class="modal fade" id="modalEditBuku-{{ $book->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content border-0 shadow-lg rounded-4">
                    <div class="modal-header border-bottom-0 bg-light px-4 py-3">
                        <h5 class="modal-title fw-bold text-primary" style="font-size: 1.1rem;">Ubah Buku</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body px-4 py-4" style="background-color: #F8FAFC;">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Judul Buku</label>
                                    <input type="text" name="judul" class="form-control" value="{{ $book->judul }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Penulis</label>
                                    <input type="text" name="penulis" class="form-control" value="{{ $book->penulis }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Kategori</label>
                                    <select name="category_id" class="form-select" required>
                                        <option value="">Pilih Kategori...</option>
                                        @foreach($categories ?? [] as $cat)
                                            <option value="{{ $cat->id }}" {{ $book->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Harga</label>
                                    <input type="number" name="harga" class="form-control" value="{{ (int)$book->harga }}" min="0" required>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Stok</label>
                                    <input type="number" name="stok" class="form-control" value="{{ $book->stok }}" min="0" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Sinopsis</label>
                                    <textarea name="sinopsis" class="form-control" rows="3">{{ $book->sinopsis }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Upload Cover Baru (Opsional)</label>
                                    <input type="file" name="cover_buku" class="form-control" accept="image/jpeg,image/png,image/webp,image/jpg" onchange="previewImage(this, 'previewEdit{{ $book->id }}')">
                                    <small class="text-muted d-block mt-1">Format: JPG, PNG, WEBP (Maks 2MB)</small>
                                    <div class="mt-2">
                                        <img id="previewEdit{{ $book->id }}" src="{{ $book->cover_buku ? asset('storage/' . $book->cover_buku) : '' }}" class="img-thumbnail rounded-3" style="max-height: 120px; object-fit: cover; {{ $book->cover_buku ? '' : 'display:none;' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label x-small text-muted fw-bold mb-1">Upload File E-Book PDF Baru (Opsional)</label>
                                    <input type="file" name="file_buku" class="form-control" accept="application/pdf">
                                    <small class="text-muted d-block mt-1">Format: PDF (Maks 10MB)</small>
                                    @if($book->file_buku)
                                        <div class="mt-2 text-success small"><i class="bi bi-check-circle-fill me-1"></i> File PDF tersedia.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer border-top-0 px-4 py-3 bg-white">
                            <button type="button" class="btn btn-light border px-4 py-2 rounded-3 fw-bold small" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 fw-bold small shadow-sm">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    @push('scripts')
    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            } else {
                if (!preview.src.includes('storage')) {
                    preview.src = '';
                    preview.style.display = 'none';
                }
            }
        }
    </script>
    @endpush
</x-admin.layout>
