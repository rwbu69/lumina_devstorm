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
            <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data" novalidate
                  x-data="{
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
                          if (!this.judul) this.errors.judul = 'Judul buku harus diisi.';
                          if (!this.penulis) this.errors.penulis = 'Nama penulis harus diisi.';
                          
                          if (!this.category_id) this.errors.category_id = 'Kategori harus dipilih.';
                          else if (this.category_id === 'new' && !this.new_category_name) this.errors.new_category_name = 'Nama kategori baru harus diisi.';
                          
                          if (!this.format) this.errors.format = 'Format buku harus dipilih.';
                          if (this.harga === '' || this.harga < 0) this.errors.harga = 'Harga tidak valid.';
                          if (this.stok === '' || this.stok < 0) this.errors.stok = 'Stok tidak valid.';
                          
                          const coverInput = document.getElementById('cover_buku');
                          if (!coverInput.value) this.errors.cover_buku = 'Cover buku wajib diunggah.';
                          
                          return Object.keys(this.errors).length === 0;
                      }
                  }" @submit="if(!validate()) $event.preventDefault()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label for="judul" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Judul Buku <span class="text-rose-500">*</span></label>
                        <input type="text" name="judul" id="judul" x-model="judul" @input="if(errors.judul) delete errors.judul" :class="errors.judul ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Masukkan judul buku" required maxlength="255">
                        <template x-if="errors.judul"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.judul"></span></p></template>
                        @error('judul')<p x-show="!errors.judul" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="penulis" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Penulis <span class="text-rose-500">*</span></label>
                        <input type="text" name="penulis" id="penulis" x-model="penulis" @input="if(errors.penulis) delete errors.penulis" :class="errors.penulis ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Nama penulis atau pengarang" required maxlength="255">
                        <template x-if="errors.penulis"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.penulis"></span></p></template>
                        @error('penulis')<p x-show="!errors.penulis" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="category_id" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Kategori <span class="text-rose-500">*</span></label>
                        <select id="category_id" name="category_id" x-model="category_id" @change="if(errors.category_id) delete errors.category_id" :class="errors.category_id ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 appearance-none cursor-pointer" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <option value="new" class="font-bold text-lumina-blue">+ Tambah Kategori Baru</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori ?? $category->nama }}</option>
                            @endforeach
                        </select>
                        
                        <!-- Input for New Category -->
                        <div x-show="category_id === 'new'" x-transition class="mt-3">
                            <input type="text" name="new_category_name" id="new_category_name" x-model="new_category_name" @input="if(errors.new_category_name) delete errors.new_category_name" :class="errors.new_category_name ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-white border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 shadow-sm" placeholder="Ketik nama kategori baru...">
                            <template x-if="errors.new_category_name"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.new_category_name"></span></p></template>
                            @error('new_category_name')<p x-show="!errors.new_category_name" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                        </div>

                        <template x-if="errors.category_id && category_id !== 'new'"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.category_id"></span></p></template>
                        @error('category_id')<p x-show="!errors.category_id && category_id !== 'new'" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="format" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Format Buku <span class="text-rose-500">*</span></label>
                        <select id="format" name="format" x-model="format" @change="if(errors.format) delete errors.format" :class="errors.format ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 appearance-none cursor-pointer" required>
                            <option value="digital">Digital (E-Book)</option>
                        </select>
                        <p class="text-slate-400 text-xs mt-1.5 font-medium">Sementara hanya melayani format digital.</p>
                        <template x-if="errors.format"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.format"></span></p></template>
                        @error('format')<p x-show="!errors.format" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>

                    <div>
                        <label for="harga" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Harga (IDR) <span class="text-rose-500">*</span></label>
                        <div class="relative flex items-center">
                            <span class="absolute left-4 font-semibold text-slate-400 text-sm">Rp</span>
                            <input type="number" name="harga" id="harga" x-model="harga" @input="if(errors.harga) delete errors.harga" :class="errors.harga ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full pl-10 pr-4 py-3 bg-slate-50 border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="150000" required min="0" step="1">
                        </div>
                        <template x-if="errors.harga"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.harga"></span></p></template>
                        @error('harga')<p x-show="!errors.harga" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>
                    
                    <div>
                        <label for="stok" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Stok <span class="text-rose-500">*</span></label>
                        <input type="number" name="stok" id="stok" x-model="stok" @input="if(errors.stok) delete errors.stok" :class="errors.stok ? 'border-rose-500 ring-1 ring-rose-500' : 'border-slate-200'" class="w-full px-4 py-3 bg-slate-50 border rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800" placeholder="Masukkan jumlah stok" required min="0" step="1">
                        <template x-if="errors.stok"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.stok"></span></p></template>
                        @error('stok')<p x-show="!errors.stok" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="sinopsis" class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Sinopsis</label>
                        <textarea id="sinopsis" name="sinopsis" rows="4" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-lumina-blue focus:ring-2 focus:ring-lumina-blue/20 transition-all text-slate-800 resize-y" placeholder="Tuliskan sinopsis buku (opsional)">{{ old('sinopsis') }}</textarea>
                        @error('sinopsis')<p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Upload Cover -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">Cover Buku <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <input @change="if(errors.cover_buku) delete errors.cover_buku" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="cover_buku" name="cover_buku" accept=".jpeg,.jpg,.png,.webp" required>
                            <div :class="errors.cover_buku ? 'border-rose-300 bg-rose-50 hover:bg-rose-100' : 'border-lumina-blue/30 bg-blue-50/50 hover:bg-blue-50'" class="border-2 border-dashed transition-colors rounded-2xl p-8 text-center flex flex-col items-center justify-center h-40">
                                <i :class="errors.cover_buku ? 'text-rose-500' : 'text-lumina-blue'" class="bi bi-card-image text-3xl mb-3"></i>
                                <span class="font-bold text-slate-700 text-sm mb-1">Klik untuk upload cover</span>
                                <span class="text-slate-500 text-xs font-medium">Wajib. JPG, PNG, WEBP (Maks. 5MB)</span>
                            </div>
                        </div>
                        <template x-if="errors.cover_buku"><p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" /><span x-text="errors.cover_buku"></span></p></template>
                        @error('cover_buku')<p x-show="!errors.cover_buku" class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
                    </div>

                    <!-- Upload PDF -->
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-4">File E-Book (Khusus Digital)</label>
                        <div class="relative">
                            <input class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" type="file" id="file_buku" name="file_buku" accept=".pdf">
                            <div class="border-2 border-dashed border-slate-300 bg-slate-50/50 hover:bg-slate-100 transition-colors rounded-2xl p-8 text-center flex flex-col items-center justify-center h-40">
                                <i class="bi bi-file-earmark-pdf text-3xl text-slate-400 mb-3"></i>
                                <span class="font-bold text-slate-700 text-sm mb-1">Upload File E-Book (Opsional)</span>
                                <span class="text-slate-500 text-xs font-medium">Hanya format PDF (Maks. 10MB)</span>
                            </div>
                        </div>
                        @error('file_buku')<p class="text-rose-500 text-xs mt-1.5 font-bold flex items-center"><x-heroicon-o-exclamation-circle class="mr-1 size-4" />{{ $message }}</p>@enderror
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
