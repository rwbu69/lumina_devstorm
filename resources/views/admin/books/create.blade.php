<x-admin.layout :title="'Lumina Media - Tambah Buku'">
    <x-admin.section-header
        title="Tambah Buku"
        subtitle="Lengkapi informasi buku baru sebelum dipublikasikan."
    >
        <a href="{{ route('admin.books.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:text-lumina-blue transition-colors shadow-sm">
            <x-heroicon-o-arrow-left class="mr-2 size-5" />
            Kembali
        </a>
    </x-admin.section-header>

    <div class="mt-8">
        <x-admin.card>
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="judul" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Buku <span class="text-rose-500">*</span></label>
                        <input type="text" name="judul" id="judul" class="w-full px-4 py-3 bg-slate-50 border @error('judul') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Masukkan judul buku" value="{{ old('judul') }}" required maxlength="255">
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Maksimal 255 karakter.</p>
                        @error('judul')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="penulis" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Penulis <span class="text-rose-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" class="w-full px-4 py-3 bg-slate-50 border @error('penulis') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Nama penulis atau pengarang" value="{{ old('penulis') }}" required maxlength="255">
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Maksimal 255 karakter.</p>
                        @error('penulis')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <select id="category_id" name="category_id" class="w-full px-4 py-3 bg-slate-50 border @error('category_id') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 appearance-none cursor-pointer" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                            <option value="" disabled selected>-- Pilih Format --</option>
                            <option value="digital" {{ old('format') == 'digital' ? 'selected' : '' }}>Digital (E-Book)</option>
                            <option value="fisik" {{ old('format') == 'fisik' ? 'selected' : '' }}>Fisik (Cetak)</option>
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
                            <input type="number" name="harga" id="harga" class="w-full pl-10 pr-4 py-3 bg-slate-50 border @error('harga') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="150000" value="{{ old('harga') }}" required min="0" step="1">
                        </div>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Harga tidak boleh negatif. Angka saja, tanpa titik.</p>
                        @error('harga')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label for="stok" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Stok <span class="text-rose-500">*</span></label>
                        <input type="number" name="stok" id="stok" class="w-full px-4 py-3 bg-slate-50 border @error('stok') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Masukkan jumlah stok" value="{{ old('stok', 0) }}" required min="0" step="1">
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Stok minimal 0. Untuk e-book, biarkan 0 atau tak terhingga.</p>
                        @error('stok')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="sinopsis" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Sinopsis</label>
                        <textarea id="sinopsis" name="sinopsis" rows="4" class="w-full px-4 py-3 bg-slate-50 border @error('sinopsis') border-rose-500 @else border-slate-200 @enderror rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 resize-y" placeholder="Tuliskan sinopsis buku (opsional)">{{ old('sinopsis') }}</textarea>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Boleh dikosongkan. Namun dianjurkan untuk menarik pembaca.</p>
                        @error('sinopsis')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Upload Cover -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Cover Buku <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="cover_buku" name="cover_buku" accept=".jpeg,.jpg,.png,.webp" required>
                            <div class="border-2 border-dashed @error('cover_buku') border-rose-300 bg-rose-50 hover:bg-rose-100 @else border-lumina-blue/30 bg-blue-50/50 hover:bg-blue-50 @enderror transition-colors rounded-2xl p-8 text-center flex flex-col items-center justify-center h-40">
                                <i class="bi bi-card-image text-3xl @error('cover_buku') text-rose-500 @else text-lumina-blue @enderror mb-3"></i>
                                <span class="font-bold text-slate-700 text-sm mb-1">Klik untuk upload cover</span>
                                <span class="text-slate-500 text-xs font-medium">Wajib. Format diterima: JPG, JPEG, PNG, WEBP (Maks. 5MB)</span>
                            </div>
                        </div>
                        @error('cover_buku')
                            <p class="text-rose-500 text-xs mt-1.5 font-bold"><x-heroicon-o-exclamation-circle class="mr-1 size-5" />{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Upload PDF (E-Book) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">File E-Book (Khusus Digital)</label>
                        <div class="relative">
                            <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="file_buku" name="file_buku" accept=".pdf">
                            <div class="border-2 border-dashed @error('file_buku') border-rose-300 bg-rose-50 hover:bg-rose-100 @else border-slate-300 bg-slate-50/50 hover:bg-slate-100 @enderror transition-colors rounded-2xl p-8 text-center flex flex-col items-center justify-center h-40">
                                <i class="bi bi-file-earmark-pdf text-3xl @error('file_buku') text-rose-500 @else text-slate-400 @enderror mb-3"></i>
                                <span class="font-bold text-slate-700 text-sm mb-1">Upload File E-Book (Opsional)</span>
                                <span class="text-slate-500 text-xs font-medium">Hanya format PDF (Maks. 10MB)</span>
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
                        <x-heroicon-o-plus class="mr-2 size-5" />
                        Tambahkan Buku
                    </button>
                </div>
            </form>
        </x-admin.card>
    </div>
</x-admin.layout>
