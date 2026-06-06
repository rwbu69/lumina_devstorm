<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="min-h-screen bg-transparent font-sans pb-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            
            <div class="flex flex-col lg:flex-row gap-6">
                
                <!-- Left Side: Filter Kategori (Sidebar) -->
                <div class="w-full lg:w-64 shrink-0">
                    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl p-5 lg:sticky lg:top-24">
                        <h5 class="font-serif font-bold text-slate-800 text-lg mb-5 flex items-center">
                            <x-heroicon-o-funnel class="me-2 text-indigo-600 size-6" /> Filter Kategori
                        </h5>
                        
                        <!-- Search Input for Mobile/Tablet -->
                        <div class="mb-6 lg:hidden" x-data="searchPreview()">
                            <form action="{{ route('catalog.index') }}" method="GET">
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                        <x-heroicon-o-magnifying-glass class="text-slate-400 size-5" />
                                    </span>
                                    <input type="text" name="q" x-model="query" @input.debounce.300ms="fetchResults" @focus="isOpen = true" @click.outside="isOpen = false" placeholder="Cari buku..." class="w-full pl-10 pr-3 py-2.5 bg-slate-50 border border-slate-300 rounded-xl text-sm focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition-colors text-slate-900 placeholder-slate-500 font-medium">
                                </div>
                            </form>
                            
                            <!-- Mobile Dropdown Preview -->
                            <div x-show="isOpen && results.length > 0" 
                                 x-transition.opacity.duration.300ms
                                 class="absolute left-4 right-4 mt-2 bg-white border border-slate-200 shadow-xl rounded-xl overflow-hidden z-50">
                                <template x-for="book in results" :key="book.id">
                                    <a :href="'/catalog/' + book.id" class="flex items-center gap-3 p-3 hover:bg-slate-50 border-b border-slate-100 transition-colors">
                                        <div class="w-10 h-14 bg-indigo-50 rounded shadow-sm flex items-center justify-center shrink-0">
                                            <x-heroicon-o-book-open class="text-indigo-400 size-6" />
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 text-sm line-clamp-1" x-text="book.judul"></div>
                                            <div class="text-xs text-slate-500" x-text="book.penulis"></div>
                                        </div>
                                    </a>
                                </template>
                            </div>
                        </div>

                        <!-- Kategori List -->
                        <div class="mb-6">
                            <div class="flex flex-col gap-1.5">
                                <a href="{{ route('catalog.index', ['q' => request('q')]) }}" 
                                   class="flex justify-between items-center px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ !request('category') ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-700 hover:bg-slate-100 hover:text-indigo-600' }}">
                                    <span>Semua Buku</span>
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold tracking-wider {{ !request('category') ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-600' }}">
                                        {{ \App\Models\Book::count() }}
                                    </span>
                                </a>
                                
                                @foreach ($categories as $cat)
                                    <a href="{{ route('catalog.index', ['category' => $cat->id, 'q' => request('q')]) }}" 
                                       class="flex justify-between items-center px-3 py-2.5 rounded-xl text-sm font-bold transition-all {{ request('category') == $cat->id ? 'bg-indigo-600 text-white shadow-md' : 'text-slate-700 hover:bg-slate-100 hover:text-indigo-600' }}">
                                        <span>{{ $cat->nama }}</span>
                                        <span class="px-2 py-0.5 rounded-md text-[10px] font-bold tracking-wider {{ request('category') == $cat->id ? 'bg-white/20 text-white' : 'bg-slate-200 text-slate-600' }}">
                                            {{ $cat->books()->count() }}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        @if(request()->anyFilled(['q', 'category']))
                            <a href="{{ route('catalog.index') }}" class="flex items-center justify-center w-full py-2.5 px-4 bg-white border border-rose-200 hover:bg-rose-50 text-rose-600 font-bold text-sm rounded-xl transition-colors shadow-sm">
                                <x-heroicon-o-trash class="me-2 size-5" /> Reset
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right Side: E-book Grid -->
                <div class="flex-1">
                    <!-- Header Katalog -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-serif font-bold text-slate-900 mb-1 tracking-tight">Katalog Buku Digital</h1>
                            <p class="text-slate-600 text-sm">Menampilkan <span class="font-bold text-indigo-700">{{ $books->total() }}</span> buku</p>
                        </div>
                        
                        <!-- Search Input (Desktop) -->
                        <div class="hidden lg:block w-80" x-data="searchPreview()">
                            <form action="{{ route('catalog.index') }}" method="GET" class="relative">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                <div class="relative">
                                    <span class="absolute inset-y-0 left-0 flex items-center pl-3.5">
                                        <x-heroicon-o-magnifying-glass class="text-slate-400 size-5" />
                                    </span>
                                    <input type="text" name="q" x-model="query" @input.debounce.300ms="fetchResults" @focus="isOpen = true" @click.outside="isOpen = false" placeholder="Cari buku..." autocomplete="off" class="w-full pl-10 pr-10 py-2.5 bg-white border border-slate-300 shadow-sm rounded-xl text-sm focus:outline-none focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 transition-colors text-slate-900 placeholder-slate-400 font-medium">
                                    @if(request('q'))
                                        <a href="{{ route('catalog.index', ['category' => request('category')]) }}" class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-rose-500 transition-colors">
                                            <x-heroicon-s-x-circle class="size-5" />
                                        </a>
                                    @endif
                                </div>
                                
                                <!-- Desktop Dropdown Preview -->
                                <div x-show="isOpen && results.length > 0" 
                                     x-transition.opacity.duration.300ms
                                     class="absolute top-full left-0 right-0 mt-2 bg-white border border-slate-200 shadow-lg rounded-xl overflow-hidden z-50">
                                    <div class="max-h-80 overflow-y-auto">
                                        <template x-for="book in results" :key="book.id">
                                            <a :href="'/catalog/' + book.id" class="flex items-center gap-3 p-3 hover:bg-slate-50 border-b border-slate-100 transition-colors">
                                                <div class="w-10 h-14 bg-indigo-50 rounded flex items-center justify-center shrink-0">
                                                    <x-heroicon-o-book-open class="text-indigo-400 size-6" />
                                                </div>
                                                <div class="min-w-0 flex-1">
                                                    <div class="font-bold text-slate-800 text-sm truncate" x-text="book.judul"></div>
                                                    <div class="text-xs text-slate-500 truncate" x-text="book.penulis"></div>
                                                </div>
                                            </a>
                                        </template>
                                    </div>
                                    <div class="p-2 border-t border-slate-100 bg-slate-50 text-center">
                                        <button type="submit" class="text-xs font-bold text-indigo-600 hover:text-indigo-800">Lihat semua hasil pencarian</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Buku Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                        @forelse ($books as $book)
                            @php
                                $isOwned = in_array($book->id, $ownedBookIds ?? []);
                                $inCart = $cartService->has($book->id);
                            @endphp
                            <div class="group bg-white border border-slate-200 shadow-sm hover:shadow-md hover:border-slate-300 transition-all duration-200 rounded-2xl overflow-hidden flex flex-col h-full relative">
                                
                                <span class="absolute top-3 left-3 z-20 bg-indigo-600/90 text-white text-[10px] font-bold px-2 py-1 rounded-lg shadow-sm">
                                    {{ $book->category->nama }}
                                </span>

                                <!-- Cover Placeholder or Actual Cover -->
                                @if($book->cover_buku)
                                    <div class="relative bg-slate-100 h-48 flex items-center justify-center border-b border-slate-100 overflow-hidden">
                                        <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div class="relative bg-slate-100 h-48 flex items-center justify-center p-4 border-b border-slate-100 overflow-hidden">
                                        <div class="absolute inset-0 bg-gradient-to-br from-slate-100 to-slate-200 opacity-50"></div>
                                        <div class="relative z-10 w-24 h-32 bg-white rounded shadow-sm flex flex-col items-center justify-center p-2 border border-slate-200 text-center">
                                            <x-heroicon-o-book-open class="text-slate-300 size-8 mb-1" />
                                            <div class="text-[8px] font-bold text-slate-600 leading-tight line-clamp-3">{{ $book->judul }}</div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Body -->
                                <div class="p-4 flex flex-col flex-grow justify-between bg-white">
                                    <div class="mb-4">
                                        <h5 class="font-serif font-bold text-slate-900 text-lg mb-1 line-clamp-2 leading-snug" title="{{ $book->judul }}">{{ $book->judul }}</h5>
                                        <p class="text-slate-500 text-xs">Oleh: <span class="font-semibold text-slate-700">{{ $book->penulis }}</span></p>
                                    </div>
                                    
                                    <div>
                                        <div class="mb-4 pb-3 border-b border-slate-100">
                                            <span class="font-bold text-xl text-slate-900 tracking-tight">Rp {{ number_format($book->harga, 0, ',', '.') }}</span>
                                        </div>

                                        <div class="flex flex-col gap-2">
                                            <div x-data="{
                                                isOwned: {{ $isOwned ? 'true' : 'false' }},
                                                inCart: {{ $inCart ? 'true' : 'false' }},
                                                loading: false,
                                                async addToCart() {
                                                    if(this.isOwned) return;
                                                    if(this.inCart) {
                                                        window.location.href = '{{ route('cart.index') }}';
                                                        return;
                                                    }
                                                    this.loading = true;
                                                    try {
                                                        let response = await fetch('{{ route('cart.store') }}', {
                                                            method: 'POST',
                                                            headers: {
                                                                'Content-Type': 'application/json',
                                                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                                                'Accept': 'application/json'
                                                            },
                                                            body: JSON.stringify({ book_id: {{ $book->id }} })
                                                        });
                                                        let result = await response.json();
                                                        if (result.success) {
                                                            this.inCart = true;
                                                            window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: result.cart_count } }));
                                                        }
                                                    } catch(e) {}
                                                    this.loading = false;
                                                }
                                            }" class="w-full">
                                                <button @click="addToCart" :disabled="loading || isOwned" :class="isOwned ? 'bg-slate-100 text-slate-500 border-transparent cursor-not-allowed' : (inCart ? 'bg-emerald-50 hover:bg-emerald-100 border-emerald-200 text-emerald-700' : 'bg-indigo-600 hover:bg-indigo-700 border-transparent text-white shadow-sm')" class="flex justify-center items-center py-2 px-3 rounded-lg border text-sm font-bold transition-colors w-full h-full disabled:opacity-75 disabled:cursor-not-allowed">
                                                    <template x-if="loading">
                                                        <span>Proses...</span>
                                                    </template>
                                                    <template x-if="!loading && isOwned">
                                                        <span>Buku sudah dimiliki</span>
                                                    </template>
                                                    <template x-if="!loading && !isOwned && inCart">
                                                        <span>Di Keranjang</span>
                                                    </template>
                                                    <template x-if="!loading && !isOwned && !inCart">
                                                        <span>Tambah</span>
                                                    </template>
                                                </button>
                                            </div>

                                            <a href="{{ route('catalog.show', $book->id) }}" class="w-full flex justify-center items-center py-2 px-3 rounded-lg border border-slate-300 hover:border-slate-400 text-slate-700 bg-white text-sm font-bold transition-colors">
                                                Detail Buku
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full">
                                <div class="text-center py-16 bg-white border border-slate-200 rounded-3xl shadow-sm">
                                    <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                        <x-heroicon-o-document-minus class="size-10" />
                                    </div>
                                    <h4 class="text-xl font-serif font-bold text-slate-800 mb-1">Buku Tidak Ditemukan</h4>
                                    <p class="text-slate-500 text-sm">Silakan coba cari dengan kata kunci lain atau bersihkan filter.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        {{ $books->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Alpine JS logic for search preview -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchPreview', () => ({
                query: '{{ request('q') }}',
                results: [],
                isOpen: false,
                isLoading: false,

                async fetchResults() {
                    if (this.query.length < 2) {
                        this.results = [];
                        this.isOpen = false;
                        return;
                    }
                    
                    this.isLoading = true;
                    try {
                        const response = await fetch(`/catalog/search-preview?q=${encodeURIComponent(this.query)}`);
                        if (response.ok) {
                            const data = await response.json();
                            this.results = data;
                            this.isOpen = true;
                        }
                    } catch (error) {
                        console.error('Error fetching search preview:', error);
                    } finally {
                        this.isLoading = false;
                    }
                }
            }))
        })
    </script>
</x-app-layout>
