@php
    use Illuminate\Support\Str;

    $rupiah = static function ($value): string {
        $number = is_numeric($value) ? (float) $value : 0;
        return 'Rp '.number_format($number, 0, ',', '.');
    };
@endphp

<x-app-layout :hideNavbar="true">
    <x-user-navbar />
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        {{-- A. Section Hero --}}
        <section class="py-8 md:py-12">
            <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">
                <div class="lg:w-1/2">
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-semibold text-lumina-blue mb-6 tracking-tight">{{ \App\Models\Setting::getValue('hero_title', 'Pusat Literatur Kristen') }}</h1>
                    <p class="text-slate-500 text-lg md:text-xl mb-8 leading-relaxed">
                        {{ \App\Models\Setting::getValue('hero_subtitle', 'Temukan koleksi buku rohani berkualitas, dari teologi mendalam hingga renungan harian yang memberkati kehidupan spiritual Anda.') }}
                    </p>

                    <div class="flex flex-wrap gap-4">
                        <x-btn variant="primary" size="lg" :href="route('catalog.index')" class="shadow-sm">Belanja Sekarang</x-btn>
                        <x-btn variant="outline" size="lg" :href="route('catalog.index')" class="">Lihat Katalog</x-btn>
                    </div>
                </div>

                <div class="lg:w-1/2 w-full">
                    <div class="aspect-video rounded-3xl bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden shadow-sm relative">
                        <div class="absolute inset-0 bg-gradient-to-tr from-lumina-blue/10 to-transparent"></div>
                        <div class="text-slate-400 font-bold tracking-widest uppercase z-10">Foto / Ilustrasi Utama</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- B. Section Buku Terbaru --}}
        <section class="py-12 md:py-16 mt-8 border-t border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <h2 class="text-2xl md:text-3xl font-serif font-semibold text-lumina-blue">Buku Terbaru</h2>
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-lumina-blue font-bold hover:text-blue-800 transition-colors">
                    Lihat Semua
                    <x-heroicon-o-arrow-right class="ml-2 size-5" />
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                @forelse ($latestBooks as $book)
                    @php
                        $synopsis = "Buku digital rohani karya {$book->penulis} untuk menemani pembacaan dan perenungan.";
                    @endphp

                    <x-card layout="vertical" shadow="sm" class="h-full">
                        <x-slot:header>
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                @if($book->cover_buku)
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                                @else
                                    <div class="text-slate-400 font-bold tracking-widest text-sm">COVER</div>
                                @endif
                            </div>
                        </x-slot:header>

                        <div class="font-bold text-slate-800 text-lg mb-1.5 line-clamp-1" title="{{ $book->judul }}">{{ $book->judul }}</div>
                        <div class="text-sm text-lumina-blue font-medium mb-3">{{ $book->penulis }}</div>
                        <div class="text-sm text-slate-500 mb-4 line-clamp-2 leading-relaxed">{{ Str::limit($synopsis, 90) }}</div>

                        <div class="font-bold text-lumina-blue text-lg mt-auto">{{ $rupiah($book->harga) }}</div>
                    </x-card>
                @empty
                    <div class="col-span-full">
                        <div class="text-center text-slate-500 py-16 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
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
