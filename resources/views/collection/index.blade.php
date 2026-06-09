<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-10">
            <h1 class="text-3xl font-serif font-bold text-slate-800 mb-3">Koleksi Saya</h1>
            <p class="text-slate-500 text-lg">Akses langsung ke seluruh e-book rohani Kristen & pembangunan diri yang telah Anda beli.</p>
        </div>

        @if ($books->isEmpty())
            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-12 text-center max-w-2xl mx-auto mt-12">
                <div class="bg-slate-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <x-heroicon-o-document-minus class="size-16 text-slate-300" />
                </div>
                <h4 class="text-2xl font-bold text-slate-800 mb-3">Koleksi Anda Masih Kosong</h4>
                <p class="text-slate-500 mb-8 font-light text-lg">Anda belum memiliki buku digital terverifikasi. Jelajahi katalog kami untuk memulai pertumbuhan iman Anda!</p>
                <a href="{{ route('catalog.index') }}" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white font-bold py-3.5 px-8 rounded-xl shadow-sm transition-all">
                    Jelajahi Katalog
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                @foreach ($books as $book)
                    <div class="bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden transition-all duration-300 flex h-40">
                        <!-- Cover Image or Placeholder -->
                        <div class="w-28 relative bg-slate-100 overflow-hidden flex-shrink-0 border-r border-slate-100">
                            @if($book->cover_buku)
                                <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="{{ $book->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 flex flex-col items-center justify-center p-2">
                                    <x-heroicon-s-document-text class="size-10 text-rose-400 mb-1 opacity-50" />
                                    <span class="font-bold text-center text-slate-700 text-[10px] line-clamp-2 leading-tight opacity-50">{{ $book->judul }}</span>
                                </div>
                            @endif
                            <div class="absolute top-2 left-2 hidden sm:block">
                                <span class="bg-lumina-blue/90 text-white text-[10px] font-bold px-2 py-0.5 rounded shadow-sm">{{ $book->category->nama }}</span>
                            </div>
                        </div>

                        <!-- Body -->
                        <div class="p-4 flex flex-col flex-grow min-w-0">
                            <div class="mb-2">
                                <h5 class="font-bold text-slate-800 text-base mb-1 line-clamp-1 leading-tight" title="{{ $book->judul }}">{{ $book->judul }}</h5>
                                <p class="text-slate-500 text-xs truncate">Oleh: <span class="font-medium">{{ $book->penulis }}</span></p>
                            </div>

                            <div class="mt-auto flex gap-2" x-data="{ open: false }">
                                <!-- Read Modal Trigger Button -->
                                <button @click="open = true" class="flex-1 flex items-center justify-center bg-lumina-blue/10 hover:bg-lumina-blue text-lumina-blue hover:text-white py-2 rounded-xl font-bold text-xs transition-colors border border-lumina-blue/20">
                                    Baca
                                </button>

                                <!-- Download Book File Button -->
                                @if ($book->file_buku)
                                    <a href="{{ route('collection.download', $book->id) }}" class="flex-1 flex items-center justify-center bg-white hover:bg-slate-50 text-slate-700 py-2 rounded-xl font-bold text-xs transition-colors border border-slate-200 shadow-sm">
                                        Unduh
                                    </a>
                                @else
                                    <button disabled class="flex-1 flex items-center justify-center bg-slate-50 text-slate-400 py-2 rounded-xl font-bold text-xs border border-slate-100 cursor-not-allowed">
                                        Belum Siap
                                    </button>
                                @endif

                                <!-- Reader Modal (Alpine.js) -->
                                <div x-show="open" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                    <!-- Background backdrop -->
                                    <div x-show="open" x-transition.opacity class="fixed inset-0 bg-slate-900/75 transition-opacity" @click="open = false"></div>

                                    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
                                        <div x-show="open" 
                                             x-transition:enter="ease-out duration-300" 
                                             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                                             x-transition:leave="ease-in duration-200" 
                                             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                                             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                                             class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-lg transition-all sm:my-8 sm:w-full sm:max-w-4xl w-full flex flex-col max-h-[90vh]">
                                            
                                            <!-- Modal header -->
                                            <div class="bg-white px-6 py-4 border-b border-slate-100 flex items-center justify-between shrink-0">
                                                <h3 class="text-xl font-bold text-slate-800 flex items-center truncate" id="modal-title">
                                                    <div class="w-10 h-10 rounded-full bg-lumina-blue/10 flex items-center justify-center mr-3 shrink-0">
                                                        <x-heroicon-o-book-open class="text-lumina-blue size-5" />
                                                    </div>
                                                    <span class="truncate">{{ $book->judul }}</span>
                                                </h3>
                                                <button type="button" @click="open = false" class="text-slate-400 hover:text-rose-500 hover:bg-rose-50 p-2 rounded-full transition-colors">
                                                    <x-heroicon-o-x-mark class="size-5" />
                                                </button>
                                            </div>
                                            
                                            <!-- Modal body (iframe) -->
                                            <div class="bg-slate-900 grow relative" style="min-height: 65vh;">
                                                <iframe src="{{ route('collection.read', $book->id) }}#toolbar=0&navpanes=0&scrollbar=0" class="absolute inset-0 w-full h-full border-0">
                                                    Browser Anda tidak mendukung iframe. Silakan unduh PDF untuk membacanya.
                                                </iframe>
                                            </div>
                                            
                                            <!-- Modal footer -->
                                            <div class="bg-slate-50 px-6 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3 shrink-0">
                                                <button type="button" @click="open = false" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-white px-6 py-2.5 text-sm font-bold text-slate-700 shadow-sm ring-1 ring-inset ring-slate-200 hover:bg-slate-50 transition-colors">Tutup</button>
                                                @if ($book->file_buku)
                                                    <a href="{{ route('collection.download', $book->id) }}" class="w-full sm:w-auto inline-flex justify-center items-center rounded-xl bg-lumina-blue px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-blue-800 transition-colors">
                                                        Unduh PDF Lengkap
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Reader Modal -->
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-app-layout>
