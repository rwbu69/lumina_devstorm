<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <!-- Back Link -->
        <div class="mb-8">
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center text-slate-500 hover:text-lumina-blue font-semibold transition-colors">
                Kembali ke Katalog
            </a>
        </div>

        <div class="flex flex-col lg:flex-row gap-10 lg:gap-12">
            <!-- Left Side: Cover Display & Buy Card -->
            <div class="lg:w-1/3 xl:w-1/4 shrink-0">
                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden mb-6 group">
                    <div class="bg-slate-100 flex items-center justify-center p-8 aspect-[3/4] relative overflow-hidden">
                        @if($book->cover_buku)
                            <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="absolute inset-0 w-full h-full object-cover">
                        @else
                            <div class="text-lumina-blue text-center z-10">
                                <x-heroicon-o-book-open class="size-20 mb-4 block opacity-50" />
                                <h3 class="font-bold text-lg px-4 line-clamp-3">{{ $book->judul }}</h3>
                                <p class="opacity-50 text-sm mt-2 font-medium">E-Book Kristen</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Price and Add to Cart Card -->
                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 md:p-8">
                    <div class="mb-4">
                        <span class="text-slate-500 text-sm font-bold uppercase tracking-wider block mb-2">Harga Spesial Digital</span>
                        <h2 class="font-bold text-lumina-blue text-3xl">Rp {{ number_format($book->harga, 0, ',', '.') }}</h2>
                    </div>

                    <hr class="border-slate-100 my-6">

                    <div class="flex flex-col gap-3">
                        @php
                            $isOwned = in_array($book->id, $ownedBookIds ?? []);
                            $inCart = $cartService->has($book->id);
                        @endphp
                        
                        <form action="{{ route('cart.store') }}" method="POST" class="w-full">
                            @csrf
                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            @if ($isOwned)
                                <button type="button" disabled class="flex items-center justify-center w-full bg-slate-100 text-slate-500 py-3.5 px-4 rounded-xl font-bold shadow-sm cursor-not-allowed">
                                    <x-heroicon-s-check-circle class="mr-2 size-5" /> Buku sudah dimiliki
                                </button>
                            @elseif ($inCart)
                                <a href="{{ route('cart.index') }}" class="flex items-center justify-center w-full bg-emerald-500 hover:bg-emerald-600 text-white py-3.5 px-4 rounded-xl font-bold shadow-sm hover:shadow-md transition-all">
                                    Lihat di Keranjang
                                </a>
                            @else
                                <button type="submit" class="flex items-center justify-center w-full bg-lumina-blue hover:bg-blue-800 text-white py-3.5 px-4 rounded-xl font-bold shadow-sm hover:shadow-md transition-all">
                                    Beli E-Book
                                </button>
                            @endif
                        </form>
                        
                        <div class="text-center mt-3 bg-emerald-50 text-emerald-700 py-2.5 px-3 rounded-lg border border-emerald-100">
                            <span class="text-xs font-semibold flex items-center justify-center"><x-heroicon-o-shield-check class="text-emerald-500 mr-1.5 size-5" />Akses instan selamanya</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side: Details & Synopsis -->
            <div class="lg:w-2/3 xl:w-3/4 flex flex-col">
                <!-- Book Title Metadata -->
                <div class="mb-8">
                    <span class="inline-block bg-lumina-blue/10 text-lumina-blue px-4 py-1.5 rounded-full font-bold text-sm mb-4 border border-lumina-blue/20">{{ $book->category->nama }}</span>
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-serif font-bold text-slate-800 mb-4 tracking-tight leading-tight">{{ $book->judul }}</h1>
                    <p class="text-lg md:text-xl text-slate-500">Ditulis oleh: <span class="font-bold text-lumina-blue">{{ $book->penulis }}</span></p>
                </div>

                <!-- Tabs/Section Info -->
                <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 md:p-10 mb-10">
                    <h5 class="font-bold text-xl text-slate-800 mb-6 flex items-center"><x-heroicon-o-document-text class="text-lumina-blue mr-3 size-8" />Tentang Buku Ini</h5>
                    <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed font-light text-lg">
                        <p class="mb-4">
                            Buku rohani Kristen digital berkualitas tinggi ini ditulis secara mendalam oleh <strong>{{ $book->penulis }}</strong> untuk memperkaya pertumbuhan spiritual dan keimanan Anda sehari-hari. Melalui bab demi bab yang penuh inspirasi, Anda akan dibimbing untuk memahami pesan firman Tuhan dengan cara praktis, relevan, serta penuh damai sejahtera. 
                        </p>
                        <p>
                            Sangat cocok dibaca di kala renungan pagi, evaluasi diri, maupun dalam kelompok sel untuk memperkuat dasar iman di tengah tantangan zaman modern. Dapatkan akses langsung untuk membaca secara fleksibel di laptop, tablet, atau smartphone Anda begitu pembayaran Anda disetujui oleh admin kami.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-8 pt-8 border-t border-slate-100">
                        <div class="border border-slate-200 rounded-2xl p-4 text-center bg-slate-50">
                            <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Format</span>
                            <span class="font-bold text-slate-700 flex items-center justify-center"><x-heroicon-o-document-text class="text-rose-500 mr-2 size-6" />E-Book / PDF</span>
                        </div>
                        <div class="border border-slate-200 rounded-2xl p-4 text-center bg-slate-50">
                            <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Kategori</span>
                            <span class="font-bold text-slate-700">{{ $book->category->nama }}</span>
                        </div>
                        <div class="border border-slate-200 rounded-2xl p-4 text-center bg-slate-50 col-span-2 md:col-span-1">
                            <span class="text-slate-400 text-xs font-bold uppercase tracking-wider block mb-1.5">Bahasa</span>
                            <span class="font-bold text-slate-700">Indonesia</span>
                        </div>
                    </div>
                </div>

                <!-- Related Books Section -->
                @if ($relatedBooks->isNotEmpty())
                    <div class="mt-auto">
                        <h4 class="font-serif font-bold text-2xl text-slate-800 mb-6">Rekomendasi Serupa</h4>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-6">
                            @foreach ($relatedBooks as $rel)
                                <a href="{{ route('catalog.show', $rel->id) }}" class="flex bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden hover:shadow-md transition-all h-32">
                                    <div class="w-24 bg-slate-100 shrink-0 flex items-center justify-center overflow-hidden">
                                        @if($rel->cover_buku)
                                            <img src="{{ asset('storage/' . $rel->cover_buku) }}" alt="{{ $rel->judul }}" class="w-full h-full object-cover">
                                        @else
                                            <x-heroicon-o-book-open class="text-slate-300 size-10" />
                                        @endif
                                    </div>
                                    <div class="p-4 flex flex-col justify-center grow min-w-0">
                                        <h6 class="font-bold text-slate-800 truncate mb-1">{{ $rel->judul }}</h6>
                                        <p class="text-slate-500 text-sm truncate mb-2">{{ $rel->penulis }}</p>
                                        <span class="font-bold text-lumina-blue text-sm">Rp {{ number_format($rel->harga, 0, ',', '.') }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
