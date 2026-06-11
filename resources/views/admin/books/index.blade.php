<x-admin.layout :title="'Lumina Media - Kelola Buku'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Kelola Buku</h1>
                <p class="text-slate-500 font-medium">Kelola dan atur stok buku pada Lumina Media</p>
            </div>
            <button x-data @click="$dispatch('open-modal', 'modalTambahBuku')" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
                <x-heroicon-o-plus class="mr-2 size-5" /> Tambah Buku
            </button>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Judul -->
            <x-admin.card>
                <div class="flex items-start justify-between mb-4">
                    <span class="text-slate-500 font-bold text-sm tracking-wide">Total Judul</span>
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-500 flex items-center justify-center">
                        <x-heroicon-o-square-3-stack-3d class="size-6" />
                    </div>
                </div>
                <h2 class="font-bold text-slate-800 text-2xl">{{ number_format($totalJudul, 0, ',', '.') }}</h2>
            </x-admin.card>
            
            <!-- Stok Rendah (Hidden for digital focus)
            <x-admin.card>
                <div class="flex items-start justify-between mb-4">
                    <span class="text-slate-500 font-bold text-sm tracking-wide">Stok Rendah</span>
                    <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center">
                        <x-heroicon-o-exclamation-triangle class="size-6" />
                    </div>
                </div>
                <h2 class="font-bold text-slate-800 text-2xl">{{ number_format($stokRendah ?? 0, 0, ',', '.') }}</h2>
            </x-admin.card>
            -->

            <!-- Terjual Bulan ini -->
            <x-admin.card>
                <div class="flex items-start justify-between mb-4">
                    <span class="text-slate-500 font-bold text-sm tracking-wide">Terjual (Bulan ini)</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center">
                        <x-heroicon-o-chart-bar class="size-6" />
                    </div>
                </div>
                <h2 class="font-bold text-slate-800 text-2xl">{{ number_format($terjualBulanIni, 0, ',', '.') }}</h2>
            </x-admin.card>

            <!-- Valuasi Stok (Hidden for digital focus)
            <x-admin.card>
                <div class="flex items-start justify-between mb-4">
                    <span class="text-slate-500 font-bold text-sm tracking-wide">Valuasi Stok</span>
                    <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center">
                        <x-heroicon-o-banknotes class="size-6" />
                    </div>
                </div>
                <h2 class="font-bold text-slate-800 text-2xl">Rp {{ number_format($valuasiStok ?? 0, 0, ',', '.') }}</h2>
            </x-admin.card>
            -->
        </div>

        <x-admin.table>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <h5 class="font-bold text-lumina-blue flex items-center text-lg"><x-heroicon-o-list-bullet class="mr-2 size-6" />Daftar Inventaris Buku</h5>
                    <div class="flex gap-2">
                        <button class="w-10 h-10 rounded-xl border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-lumina-blue transition-colors flex items-center justify-center"><x-heroicon-o-funnel class="size-6" /></button>
                        <button class="w-10 h-10 rounded-xl border border-slate-200 text-slate-500 hover:bg-slate-50 hover:text-lumina-blue transition-colors flex items-center justify-center"><x-heroicon-o-arrow-down-tray class="size-6" /></button>
                    </div>
                </div>
            </x-slot:header>

            <x-slot:head>
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-2/5">Judul Buku</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Penulis</th>
                    {{-- <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Stok</th> --}}
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Harga</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </x-slot:head>

            @foreach($books as $book)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-100 last:border-0" x-data>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            @if($book->cover_buku)
                                <div class="w-12 h-16 rounded-lg overflow-hidden border border-slate-200 shrink-0">
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="Cover" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div class="w-12 h-16 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                                    <span class="text-[0.6rem] font-bold text-slate-400">COVER</span>
                                </div>
                            @endif
                            <span class="font-bold text-slate-800 text-sm group-hover:text-lumina-blue transition-colors">{{ $book->judul }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-slate-500">{{ strtoupper($book->penulis) }}</td>
                    {{-- <td class="px-6 py-4">
                        @php
                            $stockClass = 'bg-emerald-100 text-emerald-700 border-emerald-200';
                            if ($book->stok < 20) $stockClass = 'bg-rose-100 text-rose-700 border-rose-200';
                            elseif ($book->stok < 50) $stockClass = 'bg-amber-100 text-amber-700 border-amber-200';
                        @endphp
                        <span class="px-3 py-1 text-xs font-bold rounded-full border {{ $stockClass }}">{{ $book->stok ?? 0 }}</span>
                    </td> --}}
                    <td class="px-6 py-4 font-bold text-lumina-blue">
                        Rp {{ number_format($book->harga, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2 transition-opacity">
                            <button @click="$dispatch('open-modal', 'modalEditBuku-{{ $book->id }}')" class="px-3 py-1.5 bg-white border border-slate-200 text-slate-600 hover:text-lumina-blue hover:border-lumina-blue/30 hover:bg-blue-50 rounded-lg text-xs font-bold transition-all shadow-sm">
                                Ubah
                            </button>
                            <button @click="$dispatch('open-modal', 'deleteModal-{{ $book->id }}')" class="px-3 py-1.5 bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 rounded-lg text-xs font-bold transition-all shadow-sm">
                                Hapus
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach

            <x-slot:emptyState>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <x-heroicon-o-book-open class="size-10 text-slate-300" />
                    </div>
                    <div class="font-bold text-slate-800 text-lg mb-1">Belum ada buku</div>
                    <div class="text-slate-500 text-sm">Tambahkan buku pertama untuk ditampilkan di sini.</div>
                </div>
            </x-slot:emptyState>

            <x-slot:pagination>
                @if($books->hasPages())
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <span class="text-slate-500 text-sm">Menampilkan <span class="font-semibold text-slate-700">{{ $books->firstItem() }}-{{ $books->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $books->total() }}</span> buku</span>
                        <div class="flex gap-2">
                            @if ($books->onFirstPage())
                                <span class="px-4 py-2 border border-slate-200 text-slate-400 bg-slate-50 rounded-xl text-sm font-semibold cursor-not-allowed">Sebelumnya</span>
                            @else
                                <a href="{{ $books->previousPageUrl() }}" class="px-4 py-2 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Sebelumnya</a>
                            @endif

                            @if ($books->hasMorePages())
                                <a href="{{ $books->nextPageUrl() }}" class="px-4 py-2 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Selanjutnya</a>
                            @else
                                <span class="px-4 py-2 border border-slate-200 text-slate-400 bg-slate-50 rounded-xl text-sm font-semibold cursor-not-allowed">Selanjutnya</span>
                            @endif
                        </div>
                    </div>
                @endif
            </x-slot:pagination>
        </x-admin.table>
    </div>

    {{-- Alpine Modals Container --}}
    <div x-data="{ activeModal: {!! $errors->any() && !old('_method') ? "'modalTambahBuku'" : (old('_method') === 'PUT' ? "'modalEditBuku-".old('id')."'" : 'null') !!} }" @open-modal.window="activeModal = $event.detail" @close-modal.window="activeModal = null" @keydown.escape.window="activeModal = null">

        {{-- Modal Tambah Buku --}}
        <div x-show="activeModal === 'modalTambahBuku'" style="display: none;" class="fixed inset-0 z-1050 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'modalTambahBuku'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'modalTambahBuku'" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-4xl overflow-hidden">
                    
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h5 class="text-xl font-bold text-lumina-blue">Tambah Buku</h5>
                        <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>

                    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" class="max-h-[75vh] overflow-y-auto"
                          novalidate x-data="{
                              judul: '{{ old('judul') }}',
                              penulis: '{{ old('penulis') }}',
                              category_id: '{{ old('category_id') }}',
                              new_category_name: '{{ old('new_category_name') }}',
                              format: '{{ old('format', 'digital') }}',
                              harga: '{{ old('harga') }}',
                              stok: '{{ old('stok', 0) }}',
                              errors: {},
                              validate() {
                                  this.errors = {};
                                  if(!this.judul) this.errors.judul = 'Judul buku harus diisi.';
                                  if(!this.penulis) this.errors.penulis = 'Penulis harus diisi.';
                                  if(!this.category_id) this.errors.category_id = 'Kategori harus dipilih.';
                                  if(this.category_id === 'new' && !this.new_category_name) this.errors.new_category_name = 'Nama kategori baru harus diisi.';
                                  if(!this.format) this.errors.format = 'Format buku harus dipilih.';
                                  if(this.harga === '' || this.harga < 0) this.errors.harga = 'Harga minimal 0.';
                                  if(this.stok === '' || this.stok < 0) this.errors.stok = 'Stok minimal 0.';
                                  
                                  const cover = this.$refs.coverInput;
                                  if(!cover || !cover.files || cover.files.length === 0) this.errors.cover_buku = 'Cover buku harus diunggah.';
                                  
                                  return Object.keys(this.errors).length === 0;
                              }
                          }" @submit="if(!validate()) $event.preventDefault()">
                        @csrf
                        <div class="p-6 md:p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Judul Buku</label>
                                    <input type="text" name="judul" x-model="judul" @input="delete errors.judul" :class="errors.judul ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                    <template x-if="errors.judul"><p class="text-rose-500 text-xs mt-1" x-text="errors.judul"></p></template>
                                    @error('judul') <p x-show="!errors.judul" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Penulis</label>
                                    <input type="text" name="penulis" x-model="penulis" @input="delete errors.penulis" :class="errors.penulis ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                    <template x-if="errors.penulis"><p class="text-rose-500 text-xs mt-1" x-text="errors.penulis"></p></template>
                                    @error('penulis') <p x-show="!errors.penulis" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kategori</label>
                                    <select name="category_id" x-model="category_id" @change="delete errors.category_id" :class="errors.category_id ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                        <option value="" disabled hidden>Pilih Kategori...</option>
                                        @foreach($categories ?? [] as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                        @endforeach
                                        <option value="new" class="font-bold text-lumina-blue bg-blue-50">+ Buat Kategori Baru</option>
                                    </select>
                                    <template x-if="errors.category_id"><p class="text-rose-500 text-xs mt-1" x-text="errors.category_id"></p></template>
                                    @error('category_id') <p x-show="!errors.category_id" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    
                                    <div x-show="category_id === 'new'" x-cloak class="mt-3" x-transition>
                                        <input type="text" name="new_category_name" x-model="new_category_name" @input="delete errors.new_category_name" :class="errors.new_category_name ? 'border-rose-500 ring-1 ring-rose-500' : 'border-lumina-blue/30'" placeholder="Ketik nama kategori baru..." class="w-full px-4 py-3 bg-white border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors shadow-inner">
                                        <template x-if="errors.new_category_name"><p class="text-rose-500 text-xs mt-1" x-text="errors.new_category_name"></p></template>
                                        @error('new_category_name') <p x-show="!errors.new_category_name" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Format Buku</label>
                                    <select name="format" x-model="format" @change="delete errors.format" :class="errors.format ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                        <option value="digital">Buku Digital (E-Book)</option>
                                        <option value="fisik" disabled>Buku Fisik</option>
                                    </select>
                                    <template x-if="errors.format"><p class="text-rose-500 text-xs mt-1" x-text="errors.format"></p></template>
                                    @error('format') <p x-show="!errors.format" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Harga</label>
                                    <input type="number" name="harga" x-model.number="harga" @input="delete errors.harga" :class="errors.harga ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors" min="0">
                                    <template x-if="errors.harga"><p class="text-rose-500 text-xs mt-1" x-text="errors.harga"></p></template>
                                    @error('harga') <p x-show="!errors.harga" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div style="display: none;">
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Stok</label>
                                    <input type="number" name="stok" x-model.number="stok" @input="delete errors.stok" :class="errors.stok ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors" min="0">
                                    <template x-if="errors.stok"><p class="text-rose-500 text-xs mt-1" x-text="errors.stok"></p></template>
                                    @error('stok') <p x-show="!errors.stok" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Sinopsis</label>
                                    <textarea name="sinopsis" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors" rows="3">{{ old('sinopsis') }}</textarea>
                                    @error('sinopsis') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                                <div x-data="{ previewUrl: null }">
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload Cover Buku</label>
                                    <input type="file" x-ref="coverInput" name="cover_buku" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-lumina-blue/10 file:text-lumina-blue hover:file:bg-lumina-blue/20 border rounded-xl bg-slate-50 focus:outline-none focus:border-lumina-blue transition-all p-1.5 cursor-pointer" :class="errors.cover_buku ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" accept="image/jpeg,image/png,image/webp,image/jpg" @change="previewUrl = URL.createObjectURL($event.target.files[0]); delete errors.cover_buku">
                                    <small class="text-slate-400 text-xs mt-2 block">Format: JPG, PNG, WEBP (Maks 2MB)</small>
                                    <template x-if="errors.cover_buku"><p class="text-rose-500 text-xs mt-1" x-text="errors.cover_buku"></p></template>
                                    @error('cover_buku') <p x-show="!errors.cover_buku" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    <template x-if="previewUrl">
                                        <div class="mt-4">
                                            <img :src="previewUrl" class="h-32 rounded-xl object-cover border border-slate-200 shadow-sm">
                                        </div>
                                    </template>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload File E-Book (PDF)</label>
                                    <input type="file" name="file_buku" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-500/10 file:text-rose-600 hover:file:bg-rose-500/20 border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:border-rose-500 transition-all p-1.5 cursor-pointer" accept="application/pdf">
                                    <small class="text-slate-400 text-xs mt-2 block">Format: PDF (Maks 10MB)</small>
                                    @error('file_buku') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end gap-3 sticky bottom-0">
                            <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-sm transition-colors">Simpan Buku</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modals for existing books (Edit / Delete) --}}
        @foreach($books as $book)
            {{-- Modal Delete --}}
            <div x-show="activeModal === 'deleteModal-{{ $book->id }}'" style="display: none;" class="fixed inset-0 z-1050 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="activeModal === 'deleteModal-{{ $book->id }}'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

                <div class="flex min-h-full items-center justify-center p-4">
                    <div x-show="activeModal === 'deleteModal-{{ $book->id }}'" 
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-lg overflow-hidden">
                        
                        <div class="p-8 text-center">
                            <div class="w-16 h-16 rounded-full bg-rose-100 text-rose-500 flex items-center justify-center mx-auto mb-5">
                                <x-heroicon-o-exclamation-triangle class="size-10" />
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Konfirmasi Hapus</h3>
                            <p class="text-slate-500 mb-6">Apakah kamu yakin ingin menghapus buku <span class="font-bold text-slate-700">"{{ $book->judul }}"</span>? Tindakan ini tidak dapat dibatalkan.</p>
                            
                            <div class="flex justify-center gap-3">
                                <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors w-full">Batal</button>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full px-6 py-2.5 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl shadow-sm transition-colors">Ya, Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal Edit Buku --}}
            <div x-show="activeModal === 'modalEditBuku-{{ $book->id }}'" style="display: none;" class="fixed inset-0 z-1050 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div x-show="activeModal === 'modalEditBuku-{{ $book->id }}'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

                <div class="flex min-h-full items-center justify-center p-4">
                    <div x-show="activeModal === 'modalEditBuku-{{ $book->id }}'" 
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                         class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-4xl overflow-hidden">
                        
                        <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                            <h5 class="text-xl font-bold text-lumina-blue">Ubah Buku</h5>
                            <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                                <x-heroicon-o-x-mark class="size-5" />
                            </button>
                        </div>

                        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="max-h-[75vh] overflow-y-auto"
                              novalidate x-data="{
                                  judul: '{{ addslashes(old('judul', $book->judul)) }}',
                                  penulis: '{{ addslashes(old('penulis', $book->penulis)) }}',
                                  category_id: '{{ old('category_id', $book->category_id) }}',
                                  new_category_name: '{{ old('new_category_name') }}',
                                  format: '{{ old('format', $book->format ?? 'digital') }}',
                                  harga: '{{ old('harga', (int)$book->harga) }}',
                                  stok: '{{ old('stok', $book->stok) }}',
                                  errors: {},
                                  validate() {
                                      this.errors = {};
                                      if(!this.judul) this.errors.judul = 'Judul buku harus diisi.';
                                      if(!this.penulis) this.errors.penulis = 'Penulis harus diisi.';
                                      if(!this.category_id) this.errors.category_id = 'Kategori harus dipilih.';
                                      if(this.category_id === 'new' && !this.new_category_name) this.errors.new_category_name = 'Nama kategori baru harus diisi.';
                                      if(!this.format) this.errors.format = 'Format buku harus dipilih.';
                                      if(this.harga === '' || this.harga < 0) this.errors.harga = 'Harga minimal 0.';
                                      if(this.stok === '' || this.stok < 0) this.errors.stok = 'Stok minimal 0.';
                                      
                                      return Object.keys(this.errors).length === 0;
                                  }
                              }" @submit="if(!validate()) $event.preventDefault()">
                            @csrf
                            @method('PUT')
                            <div class="p-6 md:p-8">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Judul Buku</label>
                                        <input type="text" name="judul" x-model="judul" @input="delete errors.judul" :class="errors.judul ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                        <template x-if="errors.judul"><p class="text-rose-500 text-xs mt-1" x-text="errors.judul"></p></template>
                                        @error('judul') <p x-show="!errors.judul" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Penulis</label>
                                        <input type="text" name="penulis" x-model="penulis" @input="delete errors.penulis" :class="errors.penulis ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                        <template x-if="errors.penulis"><p class="text-rose-500 text-xs mt-1" x-text="errors.penulis"></p></template>
                                        @error('penulis') <p x-show="!errors.penulis" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kategori</label>
                                        <select name="category_id" x-model="category_id" @change="delete errors.category_id" :class="errors.category_id ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                            <option value="" disabled hidden>Pilih Kategori...</option>
                                            @foreach($categories ?? [] as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->nama }}</option>
                                            @endforeach
                                            <option value="new" class="font-bold text-lumina-blue bg-blue-50">+ Buat Kategori Baru</option>
                                        </select>
                                        <template x-if="errors.category_id"><p class="text-rose-500 text-xs mt-1" x-text="errors.category_id"></p></template>
                                        @error('category_id') <p x-show="!errors.category_id" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        
                                        <div x-show="category_id === 'new'" x-cloak class="mt-3" x-transition>
                                            <input type="text" name="new_category_name" x-model="new_category_name" @input="delete errors.new_category_name" :class="errors.new_category_name ? 'border-rose-500 ring-1 ring-rose-500' : 'border-lumina-blue/30'" placeholder="Ketik nama kategori baru..." class="w-full px-4 py-3 bg-white border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors shadow-inner">
                                            <template x-if="errors.new_category_name"><p class="text-rose-500 text-xs mt-1" x-text="errors.new_category_name"></p></template>
                                            @error('new_category_name') <p x-show="!errors.new_category_name" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Format Buku</label>
                                        <select name="format" x-model="format" @change="delete errors.format" :class="errors.format ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                            <option value="digital">Buku Digital (E-Book)</option>
                                            <option value="fisik" disabled>Buku Fisik</option>
                                        </select>
                                        <template x-if="errors.format"><p class="text-rose-500 text-xs mt-1" x-text="errors.format"></p></template>
                                        @error('format') <p x-show="!errors.format" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Harga</label>
                                            <input type="number" name="harga" x-model.number="harga" @input="delete errors.harga" :class="errors.harga ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors" min="0">
                                            <template x-if="errors.harga"><p class="text-rose-500 text-xs mt-1" x-text="errors.harga"></p></template>
                                            @error('harga') <p x-show="!errors.harga" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div style="display: none;">
                                            <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Stok</label>
                                            <input type="number" name="stok" x-model.number="stok" @input="delete errors.stok" :class="errors.stok ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors" min="0">
                                            <template x-if="errors.stok"><p class="text-rose-500 text-xs mt-1" x-text="errors.stok"></p></template>
                                            @error('stok') <p x-show="!errors.stok" class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Sinopsis</label>
                                        <textarea name="sinopsis" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors" rows="3">{{ $book->sinopsis }}</textarea>
                                    </div>
                                    <div x-data="{ previewUrl: '{{ $book->cover_buku ? asset('storage/' . $book->cover_buku) : '' }}' }">
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload Cover Baru (Opsional)</label>
                                        <input type="file" name="cover_buku" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-lumina-blue/10 file:text-lumina-blue hover:file:bg-lumina-blue/20 border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:border-lumina-blue transition-all p-1.5 cursor-pointer" accept="image/jpeg,image/png,image/webp,image/jpg" @change="previewUrl = URL.createObjectURL($event.target.files[0])">
                                        <small class="text-slate-400 text-xs mt-2 block">Format: JPG, PNG, WEBP (Maks 2MB)</small>
                                        @error('cover_buku') <p class="text-rose-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        <template x-if="previewUrl">
                                            <div class="mt-4">
                                                <img :src="previewUrl" class="h-32 rounded-xl object-cover border border-slate-200 shadow-sm">
                                            </div>
                                        </template>
                                    </div>
                                    <div>
                                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Upload File E-Book Baru (Opsional)</label>
                                        <input type="file" name="file_buku" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-semibold file:bg-rose-500/10 file:text-rose-600 hover:file:bg-rose-500/20 border border-slate-200 rounded-xl bg-slate-50 focus:outline-none focus:border-rose-500 transition-all p-1.5 cursor-pointer" accept="application/pdf">
                                        <small class="text-slate-400 text-xs mt-2 block">Format: PDF (Maks 10MB)</small>
                                        @if($book->file_buku)
                                            <div class="mt-3 flex items-center text-emerald-600 text-sm font-semibold bg-emerald-50 px-3 py-2 rounded-lg border border-emerald-100">
                                                <x-heroicon-s-check-circle class="mr-2 size-5" /> File PDF saat ini tersedia.
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end gap-3 sticky bottom-0">
                                <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Batal</button>
                                <button type="submit" class="px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-sm transition-colors">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-admin.layout>
