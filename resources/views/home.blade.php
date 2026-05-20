@php
    use Illuminate\Support\Str;

    $rupiah = static function ($value): string {
        $number = is_numeric($value) ? (float) $value : 0;
        return 'Rp '.number_format($number, 0, ',', '.');
    };
@endphp

<x-app-layout>
    <div class="container py-5">
        {{-- A. Section Hero --}}
        <section class="py-4 py-lg-5">
            <div class="row align-items-center g-4 g-lg-5">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-semibold text-primary mb-3">Pusat Literatur Kristen</h1>
                    <p class="text-secondary mb-4">
                        Temukan koleksi buku rohani berkualitas, dari teologi mendalam hingga renungan harian yang memberkati kehidupan spiritual Anda.
                    </p>

                    <div class="d-flex gap-2 flex-wrap">
                        <x-btn variant="primary" :href="route('catalog.index')">Belanja Sekarang</x-btn>
                        <x-btn variant="outline" :href="route('catalog.index')">Lihat Katalog</x-btn>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="ratio ratio-16x9 rounded-4 bg-secondary-subtle border d-flex align-items-center justify-content-center">
                        <div class="text-secondary fw-semibold">FOTO</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- B. Section Buku Terbaru --}}
        <section class="py-4 py-lg-5">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h2 class="h4 fw-semibold text-primary mb-0">Buku Terbaru</h2>
                <a href="{{ route('catalog.index') }}" class="text-decoration-none fw-semibold">
                    Lihat Semua
                    <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <div class="row g-3 g-lg-4">
                @forelse ($latestBooks as $book)
                    @php
                        $synopsis = "Buku digital rohani karya {$book->penulis} untuk menemani pembacaan dan perenungan.";
                    @endphp

                    <div class="col-12 col-sm-6 col-lg-3">
                        <x-card layout="vertical" shadow="sm" hover>
                            <x-slot:header>
                                <div class="w-100 h-100 bg-primary-subtle d-flex align-items-center justify-content-center">
                                    <div class="text-primary fw-semibold">COVER</div>
                                </div>
                            </x-slot:header>

                            <div class="fw-semibold mb-1">{{ $book->judul }}</div>
                            <div class="small text-secondary mb-2">{{ $book->penulis }}</div>
                            <div class="small text-secondary mb-3">{{ Str::limit($synopsis, 90) }}</div>

                            <div class="fw-semibold text-primary">{{ $rupiah($book->harga) }}</div>
                        </x-card>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-secondary py-5">
                            Buku terbaru belum tersedia.
                        </div>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- C. Section Ayat Harian --}}
        <x-daily-verse :verse="$dailyVerse" />
    </div>
</x-app-layout>
