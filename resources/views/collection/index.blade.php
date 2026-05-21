<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="container py-5">
        <h1 class="h3 fw-bold text-primary mb-2"><i class="bi bi-journal-bookmark me-2"></i>Koleksi Saya</h1>
        <p class="text-secondary mb-4">Akses langsung ke seluruh e-book rohani Kristen & pembangunan diri yang telah Anda beli.</p>

        @if ($books->isEmpty())
            <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
                <div class="py-4">
                    <i class="bi bi-journal-x display-1 text-secondary opacity-50 mb-3"></i>
                    <h4 class="fw-bold text-secondary">Koleksi Anda Masih Kosong</h4>
                    <p class="text-secondary mb-4">Anda belum memiliki buku digital terverifikasi. Jelajahi katalog kami untuk memulai pertumbuhan iman Anda!</p>
                    <a href="{{ route('catalog.index') }}" class="btn btn-primary px-4 py-2.5 rounded-3 fw-bold">Jelajahi Katalog</a>
                </div>
            </div>
        @else
            <div class="row g-4">
                @foreach ($books as $book)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white hover-up transition-all">
                            <!-- Cover Placeholder -->
                            <div class="bg-primary-subtle d-flex align-items-center justify-content-center position-relative" style="height: 200px;">
                                <div class="text-primary text-center px-3">
                                    <i class="bi bi-file-earmark-pdf-fill display-5 mb-2 d-block text-danger"></i>
                                    <span class="fw-bold d-block text-truncate" style="max-width: 160px;">{{ $book->judul }}</span>
                                    <small class="opacity-75">{{ $book->penulis }}</small>
                                </div>
                                <span class="position-absolute top-3 start-3 badge bg-primary shadow-sm">{{ $book->category->nama }}</span>
                            </div>

                            <!-- Body -->
                            <div class="card-body p-4 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold text-dark mb-1 text-truncate" title="{{ $book->judul }}">{{ $book->judul }}</h5>
                                    <p class="text-secondary small mb-3">Oleh: {{ $book->penulis }}</p>
                                </div>
                                
                                <div class="d-flex flex-column gap-2 mt-2">
                                    <!-- Read Modal Trigger Button -->
                                    <button class="btn btn-primary w-100 rounded-3 py-2 fw-semibold btn-sm d-flex align-items-center justify-content-center" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#readModal-{{ $book->id }}">
                                        <i class="bi bi-book-open me-2"></i> Mulai Membaca
                                    </button>
                                    
                                    <!-- Download Book File Button -->
                                    @if($book->file_buku)
                                        <a href="{{ asset('storage/' . $book->file_buku) }}" download class="btn btn-outline-secondary w-100 rounded-3 py-2 fw-semibold btn-sm d-flex align-items-center justify-content-center">
                                            <i class="bi bi-download me-2"></i> Unduh PDF
                                        </a>
                                    @else
                                        <button class="btn btn-outline-secondary w-100 rounded-3 py-2 fw-semibold btn-sm d-flex align-items-center justify-content-center" disabled>
                                            <i class="bi bi-x-circle me-2"></i> PDF Belum Siap
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reader Modal for each book -->
                    <div class="modal fade" id="readModal-{{ $book->id }}" tabindex="-1" aria-labelledby="readModalLabel-{{ $book->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                            <div class="modal-content rounded-4 border-0 shadow-lg">
                                <div class="modal-header border-slate-100 px-4 py-3">
                                    <h5 class="modal-title fw-bold text-primary" id="readModalLabel-{{ $book->id }}"><i class="bi bi-book-open me-2"></i>Membaca: {{ $book->judul }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4 bg-light" style="max-height: 70vh;">
                                    <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm" style="font-family: 'Georgia', serif; font-size: 1.1rem; line-height: 1.8; text-align: justify; color: #334155;">
                                        <div class="text-center mb-4 border-bottom pb-4 border-slate-100">
                                            <h4 class="fw-bold mb-1">{{ $book->judul }}</h4>
                                            <p class="text-secondary">Oleh: {{ $book->penulis }}</p>
                                            <span class="badge bg-secondary-subtle text-secondary">{{ $book->category->nama }}</span>
                                        </div>

                                        <h5 class="fw-bold text-dark mb-3">Bab 1: Pendahuluan</h5>
                                        <p class="mb-4">
                                            Selamat datang di halaman pembacaan digital Lumina Media! Ini adalah pratinjau konten dari buku digital yang telah Anda beli secara resmi. Konten lengkap e-book ini juga dapat Anda unduh langsung dalam format berkas PDF dengan menekan tombol "Unduh PDF" pada menu koleksi Anda.
                                        </p>
                                        <p class="mb-4">
                                            Melalui literatur ini, Anda akan diarahkan untuk mendalami pertumbuhan iman Kristen serta memformulasikan mindset rohani yang tangguh dalam menghadapi problematika kehidupan modern. Setiap kutipan ayat dan teori pembangunan diri di dalamnya dirancang untuk memberikan inspirasi rohani serta evaluasi yang membangun spiritualitas secara konkrit.
                                        </p>
                                        <p>
                                            "Segala tulisan yang diilhamkan Allah memang bermanfaat untuk mengajar, untuk menyatakan kesalahan, untuk memperbaiki kelakuan dan untuk mendidik orang dalam kebenaran." — 2 Timotius 3:16.
                                        </p>
                                    </div>
                                </div>
                                <div class="modal-footer border-slate-100 px-4 py-3">
                                    <button type="button" class="btn btn-secondary rounded-3" data-bs-dismiss="modal">Tutup</button>
                                    @if($book->file_buku)
                                        <a href="{{ asset('storage/' . $book->file_buku) }}" download class="btn btn-primary rounded-3"><i class="bi bi-download me-1"></i>Unduh PDF Lengkap</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <style>
        .hover-up:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.08) !important;
        }
    </style>
</x-app-layout>
