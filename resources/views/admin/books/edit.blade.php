<x-admin.layout :title="'Lumina Media - Edit Buku'">
    <x-admin.section-header
        title="Edit Buku"
        subtitle="Perbarui informasi buku sebelum disimpan."
    >
        <div class="flex gap-2">
            <a href="{{ route('admin.books.show', $book) }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:text-lumina-blue transition-colors shadow-sm">
                <x-heroicon-o-eye class="mr-2 size-5" />
                Lihat
            </a>
            <a href="{{ route('admin.books.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:text-lumina-blue transition-colors shadow-sm">
                Kembali
            </a>
        </div>
    </x-admin.section-header>

    <div class="mt-8">
        <x-admin.card>
            <form action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="judul" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Buku <span class="text-rose-500">*</span></label>
                        <input type="text" name="judul" id="judul" class="w-full px-4 py-3 bg-slate-50 border @error('judul') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Masukkan judul buku" value="{{ old('judul', $book->judul) }}" required maxlength="255">
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Maksimal 255 karakter.</p>
                        @error('judul')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="penulis" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Penulis <span class="text-rose-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" class="w-full px-4 py-3 bg-slate-50 border @error('penulis') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Nama penulis atau pengarang" value="{{ old('penulis', $book->penulis) }}" required maxlength="255">
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Maksimal 255 karakter.</p>
                        @error('penulis')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-3 bg-slate-50 border @error('category_id') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 appearance-none cursor-pointer" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @php
                                $categories = \App\Models\Category::all();
                            @endphp
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->nama_kategori ?? $category->nama }}
                                </option>
                            @endforeach
                        </select>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Pilih kategori buku yang sesuai.</p>
                        @error('category_id')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="format" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Format Buku <span class="text-rose-500">*</span></label>
                        <select id="format" name="format" class="w-full px-4 py-3 bg-slate-50 border @error('format') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 appearance-none cursor-pointer" required>
                            <option value="" disabled>-- Pilih Format --</option>
                            <option value="digital" {{ old('format', $book->format) == 'digital' ? 'selected' : '' }}>Digital (E-Book)</option>
                            <option value="fisik" {{ old('format', $book->format) == 'fisik' ? 'selected' : '' }}>Fisik (Cetak)</option>
                        </select>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Tentukan format penjualan buku.</p>
                        @error('format')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="harga" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Harga (IDR) <span class="text-rose-500">*</span></label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 font-semibold text-slate-400 text-sm">Rp</span>
                            <input type="number" name="harga" id="harga" class="w-full pl-10 pr-4 py-3 bg-slate-50 border @error('harga') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="150000" value="{{ old('harga', intval($book->harga)) }}" required min="0" step="1">
                        </div>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Harga tidak boleh negatif. Angka saja, tanpa titik.</p>
                        @error('harga')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="stok" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Stok <span class="text-rose-500">*</span></label>
                        <input type="number" name="stok" id="stok" class="w-full px-4 py-3 bg-slate-50 border @error('stok') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Masukkan jumlah stok" value="{{ old('stok', $book->stok) }}" required min="0" step="1">
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Stok minimal 0. Untuk e-book, biarkan 0 atau tak terhingga.</p>
                        @error('stok')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="sinopsis" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Sinopsis</label>
                        <textarea id="sinopsis" name="sinopsis" rows="4" class="w-full px-4 py-3 bg-slate-50 border @error('sinopsis') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 resize-y" placeholder="Tuliskan sinopsis buku (opsional)">{{ old('sinopsis', $book->sinopsis) }}</textarea>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Boleh dikosongkan. Namun dianjurkan untuk menarik pembaca.</p>
                        @error('sinopsis')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Upload Cover -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Ganti Cover Buku</label>
                        <div class="flex flex-col sm:flex-row items-start gap-4">
                            <div class="w-24 h-32 bg-slate-50 rounded-xl border border-slate-200 flex items-center justify-center shrink-0 overflow-hidden shadow-sm">
                                @if($book->cover_buku)
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" alt="Preview" class="w-full h-full object-cover">
                                @elseif($book->gambar)
                                    <img src="{{ asset('storage/' . $book->gambar) }}" alt="Preview" class="w-full h-full object-cover">
                                @else
                                    <span class="text-slate-400 text-[10px] font-bold tracking-widest">NO COVER</span>
                                @endif
                            </div>
                            <div class="relative w-full">
                                <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="cover_buku" name="cover_buku" accept=".jpeg,.jpg,.png,.webp">
                                <div class="border-2 border-dashed @error('cover_buku') border-rose-300 bg-rose-50 hover:bg-rose-100 @else border-lumina-blue/30 bg-blue-50/50 hover:bg-blue-50 @enderror transition-colors rounded-2xl p-6 text-center flex flex-col items-center justify-center h-32">
                                    <i class="bi bi-cloud-upload text-2xl @error('cover_buku') text-rose-500 @else text-lumina-blue @enderror mb-2"></i>
                                    <span class="font-bold text-slate-700 text-xs mb-1">Upload untuk ganti</span>
                                    <span class="text-slate-500 text-[10px] font-medium">Opsional. JPG, PNG, WEBP (Maks. 5MB)</span>
                                </div>
                            </div>
                        </div>
                        @error('cover_buku')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload PDF (E-Book) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Ganti File E-Book (Digital)</label>
                        <div class="relative">
                            <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="file_buku" name="file_buku" accept=".pdf">
                            <div class="border-2 border-dashed @error('file_buku') border-rose-300 bg-rose-50 hover:bg-rose-100 @else border-slate-300 bg-slate-50/50 hover:bg-slate-100 @enderror transition-colors rounded-2xl p-6 text-center flex flex-col items-center justify-center h-32">
                                <i class="bi bi-file-earmark-pdf text-2xl @error('file_buku') text-rose-500 @else text-slate-400 @enderror mb-2"></i>
                                <span class="font-bold text-slate-700 text-xs mb-1">
                                    @if($book->file_buku) 
                                        File terlampir: Ganti?
                                    @else 
                                        Belum ada file, upload? 
                                    @endif
                                </span>
                                <span class="text-slate-500 text-[10px] font-medium">Opsional. Format PDF (Maks. 10MB)</span>
                            </div>
                        </div>
                        @error('file_buku')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end items-center border-t border-slate-100 pt-6 gap-3">
                    <a href="{{ route('admin.books.index') }}" class="px-5 py-2.5 text-sm font-bold text-slate-500 hover:text-slate-700 hover:bg-slate-50 rounded-xl transition-colors">Batal</a>
                    <button type="submit" class="flex items-center justify-center px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white text-sm font-bold rounded-xl shadow-sm hover:shadow transition-all">
                        <x-heroicon-o-document-check class="mr-2 size-5" />
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </x-admin.card>
    </div>
</x-admin.layout>
