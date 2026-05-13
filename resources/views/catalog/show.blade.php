@php
    $rupiah = static function ($value): string {
        $number = is_numeric($value) ? (float) $value : 0;
        return 'Rp ' . number_format($number, 0, ',', '.');
    };
@endphp

<x-app-layout>
    <div class="container py-4">
        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-secondary text-decoration-none">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('catalog.index') }}" class="text-secondary text-decoration-none">{{ $book->category->nama_kategori ?? 'Kategori' }}</a></li>
                <li class="breadcrumb-item active fw-bold text-dark" aria-current="page">{{ $book->judul }}</li>
            </ol>
        </nav>

        <div class="row g-4 g-lg-5">
            {{-- Left: Book Cover --}}
            <div class="col-md-5 col-lg-5">
                <div class="rounded-4 shadow-sm overflow-hidden bg-light border-0" style="aspect-ratio: 3/4;">
                    @if($book->file_buku && Storage::disk('public')->exists($book->file_buku))
                        <img src="{{ asset('storage/' . $book->file_buku) }}" class="w-100 h-100 object-fit-cover" alt="{{ $book->judul }}">
                    @else
                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary-subtle">
                             <div class="text-secondary opacity-25">
                                 <i class="bi bi-book" style="font-size: 8rem;"></i>
                             </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Right: Book Info --}}
            <div class="col-md-7 col-lg-7">
                <div class="ps-md-2">
                    <h1 class="display-5 fw-bold text-dark mb-1" style="font-family: 'Playfair Display', serif;">{{ $book->judul }}</h1>
                    <p class="text-uppercase small mb-4">
                        <span class="text-secondary">OLEH</span> 
                        <a href="#" class="text-primary text-decoration-none fw-bold">{{ $book->penulis }}</a>
                    </p>

                    <h2 class="h2 fw-bold text-dark mb-4">{{ $rupiah($book->harga) }}</h2>

                    <div class="d-flex align-items-center gap-3 mb-5">
                        <div class="input-group" style="width: 130px;">
                            <button class="btn btn-outline-secondary border-opacity-25 rounded-start-pill px-3" type="button" onclick="this.nextElementSibling.stepDown()">-</button>
                            <input type="number" class="form-control text-center border-opacity-25" value="1" min="1" readonly>
                            <button class="btn btn-outline-secondary border-opacity-25 rounded-end-pill px-3" type="button" onclick="this.previousElementSibling.stepUp()">+</button>
                        </div>
                        
                        <button class="btn btn-primary px-5 py-2 fw-bold rounded-pill shadow-sm flex-grow-1 flex-md-grow-0" style="background-color: #2b65f6; border-color: #2b65f6;">
                            <i class="bi bi-cart3 me-2"></i> Tambah ke Keranjang
                        </button>

                        <button class="btn btn-outline-secondary rounded-pill border-opacity-25 p-2 px-3">
                            <i class="bi bi-heart"></i>
                        </button>
                    </div>

                    {{-- Tabs --}}
                    <ul class="nav nav-tabs border-bottom-0 mb-3" id="bookTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active border-0 text-primary fw-bold px-0 me-4 position-relative" id="synopsis-tab" data-bs-toggle="tab" data-bs-target="#synopsis" type="button" role="tab">
                                Sinopsis
                                <div class="position-absolute bottom-0 start-0 w-100 bg-primary rounded-pill" style="height: 3px;"></div>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 text-secondary fw-bold px-0 me-4" id="detail-tab" data-bs-toggle="tab" data-bs-target="#detail" type="button" role="tab">
                                Detail
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link border-0 text-secondary fw-bold px-0 me-4" id="author-tab" data-bs-toggle="tab" data-bs-target="#author" type="button" role="tab">
                                Pengarang
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="bookTabContent">
                        <div class="tab-pane fade show active" id="synopsis" role="tabpanel">
                            <p class="text-secondary lh-lg small">
                                {{ $book->deskripsi ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet posuere orci, ac vestibulum tortor. Nullam ullamcorper pharetra nunc sit amet facilisis. Quisque lacinia pulvinar justo quis ullamcorper. Phasellus eu arcu gravida, cursus mi ac, fermentum metus. Suspendisse commodo pretium convallis. Cras a turpis porttitor, tincidunt nunc aliquet, finibus ante. Proin risus mauris, ultrices at magna non, pulvinar pharetra nibh. Vivamus convallis turpis purus, quis efficitur nunc posuere rutrum. Maecenas volutpat rutrum arcu nec fermentum. Etiam id faucibus tellus. Curabitur eget massa ut felis pharetra hendrerit. Cres dignissim, arcu vel consectetur tristique, massa nulla feugiat nunc, eget euismod mauris libero sed sem. Quisque vestibulum eleifend vehicula.' }}
                            </p>
                        </div>
                        <div class="tab-pane fade" id="detail" role="tabpanel">
                            <div class="row g-2 small">
                                <div class="col-4 text-secondary">Kategori</div>
                                <div class="col-8 fw-semibold">{{ $book->category->nama_kategori ?? 'Umum' }}</div>
                                <div class="col-4 text-secondary">Tahun Terbit</div>
                                <div class="col-8 fw-semibold">{{ $book->created_at->year }}</div>
                                <div class="col-4 text-secondary">Format</div>
                                <div class="col-8 fw-semibold">Digital (PDF)</div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="author" role="tabpanel">
                            <p class="text-secondary small">Informasi tentang pengarang {{ $book->penulis }} akan ditampilkan di sini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .breadcrumb-item + .breadcrumb-item::before {
            content: ">";
            font-size: 0.8rem;
            vertical-align: middle;
            color: #adb5bd;
        }
        .nav-tabs .nav-link:not(.active) {
            color: #6c757d !important;
            opacity: 0.8;
        }
        .nav-tabs .nav-link.active {
            background-color: transparent !important;
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #dee2e6;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</x-app-layout>
