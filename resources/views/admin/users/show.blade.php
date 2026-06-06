<x-admin.layout :title="'Informasi Akun - ' . $user->nama">
    <div class="bg-[#FDFBF7] min-h-full">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="flex text-sm text-slate-500 font-medium">
                <li><a href="{{ route('admin.users.index') }}" class="hover:text-lumina-blue transition-colors">Kelola User</a></li>
                <li class="mx-2 opacity-50">&gt;</li>
                <li class="text-slate-800 font-bold">{{ $user->nama }}</li>
            </ol>
        </nav>

        {{-- Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8" x-data>
            <div>
                <h1 class="text-2xl font-serif font-bold text-lumina-blue mb-1">Informasi Akun</h1>
                <p class="text-slate-500 text-sm">Profil dan akses pengguna {{ $user->nama }}</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <button @click="$dispatch('open-modal', 'modalResetPassword')" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 hover:border-slate-300 rounded-xl font-bold text-sm shadow-sm transition-all">
                    <x-heroicon-o-shield-exclamation class="mr-2 text-slate-400 size-5" /> Reset Password
                </button>
                <button @click="$dispatch('open-modal', 'modalUbahProfil')" class="inline-flex items-center px-4 py-2 bg-lumina-blue hover:bg-blue-800 text-white rounded-xl font-bold text-sm shadow-sm transition-all">
                    <x-heroicon-o-pencil-square class="mr-2 size-5" /> Ubah Profil
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm mb-8 flex items-center relative" x-data="{ show: true }" x-show="show" x-transition>
                <x-heroicon-s-check-circle class="mr-3 size-6" />
                <span class="font-medium mr-auto">{{ session('success') }}</span>
                <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 transition-colors">
                    <x-heroicon-o-x-mark class="size-5" />
                </button>
            </div>
        @endif

        {{-- Profile Card --}}
        <x-admin.card class="mb-8">
            <div class="flex flex-col md:flex-row gap-6 items-center md:items-start">
                {{-- Avatar --}}
                <div class="w-24 h-24 rounded-full bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200">
                    <x-heroicon-s-user class="size-16 text-slate-300" />
                </div>

                {{-- Info Grid --}}
                <div class="grow w-full">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div>
                            <div class="text-[0.65rem] font-bold text-slate-500 uppercase tracking-widest mb-1.5">Nama Lengkap</div>
                            <div class="font-bold text-slate-800 text-lg">{{ $user->nama }}</div>
                        </div>
                        <div>
                            <div class="text-[0.65rem] font-bold text-slate-500 uppercase tracking-widest mb-1.5">Email</div>
                            <div class="font-medium text-slate-700">{{ $user->email }}</div>
                        </div>
                        <div>
                            <div class="text-[0.65rem] font-bold text-slate-500 uppercase tracking-widest mb-1.5">Peran Akses</div>
                            <span class="inline-block px-3 py-1 rounded-full font-bold text-xs bg-blue-50 text-lumina-blue border border-blue-100">
                                {{ strtoupper($user->role) }}
                            </span>
                        </div>
                        <div>
                            <div class="text-[0.65rem] font-bold text-slate-500 uppercase tracking-widest mb-1.5">Tanggal Bergabung</div>
                            <div class="font-medium text-slate-700">{{ $user->created_at->format('d F Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </x-admin.card>

        {{-- Akses Buku Section --}}
        <div class="mb-10" x-data>
            <div class="flex items-center justify-between mb-4">
                <h6 class="font-bold text-slate-800 text-lg">Akses Buku</h6>
                <button @click="$dispatch('open-modal', 'modalTambahAkses')" class="inline-flex items-center px-4 py-2 bg-blue-50 text-lumina-blue hover:bg-lumina-blue hover:text-white rounded-xl font-bold text-xs transition-colors shadow-sm border border-blue-100 hover:border-lumina-blue">
                    <x-heroicon-o-document-plus class="mr-2 size-4" /> Tambah Akses
                </button>
            </div>

            <x-admin.card :no-body="true" class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse($books as $book)
                        <div class="border border-slate-200 rounded-2xl bg-slate-50/50 p-3 flex gap-3 group">
                            <div class="w-12 h-16 rounded-lg overflow-hidden shrink-0 bg-slate-100 border border-slate-200 flex items-center justify-center">
                                @if ($book->cover_buku)
                                    <img src="{{ asset('storage/' . $book->cover_buku) }}" class="w-full h-full object-cover">
                                @else
                                    <x-heroicon-o-book-open class="text-slate-300 size-5" />
                                @endif
                            </div>
                            <div class="flex flex-col justify-center min-w-0 flex-grow">
                                <div class="font-bold text-slate-800 text-sm truncate mb-0.5" title="{{ $book->judul }}">{{ $book->judul }}</div>
                                <div class="text-xs text-slate-500 truncate mb-1">{{ $book->id_buku ?? 'BUKU-' . $book->id }}</div>
                                <div class="flex items-center justify-between mt-auto">
                                    <span class="text-[0.65rem] font-bold text-emerald-600 flex items-center"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>AKTIF</span>
                                    {{-- Optional: Form or button to revoke access could go here --}}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-10 flex flex-col items-center justify-center text-slate-500">
                            <x-heroicon-o-document-minus class="size-12 mb-3 text-slate-300" />
                            <span class="text-sm font-medium">Belum ada akses buku untuk pengguna ini.</span>
                        </div>
                    @endforelse
                </div>
            </x-admin.card>
        </div>

        {{-- Danger Zone --}}
        <div class="bg-rose-50 border border-rose-100 rounded-3xl p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4" x-data>
            <div>
                <div class="font-bold text-rose-600 mb-1">Hapus Akun Pengguna</div>
                <div class="text-rose-500/80 text-xs font-medium">Tindakan ini permanen. Semua data akan dihapus.</div>
            </div>
            <button @click="$dispatch('open-modal', 'deleteUserModal')" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-rose-200 text-rose-600 hover:bg-rose-600 hover:text-white rounded-xl font-bold text-sm transition-colors shadow-sm">
                Hapus Akun
            </button>
        </div>
    </div>

    {{-- Alpine Modals Container --}}
    <div x-data="{ activeModal: null }" @open-modal.window="activeModal = $event.detail" @close-modal.window="activeModal = null" @keydown.escape.window="activeModal = null">

        {{-- Modal Delete User --}}
        <div x-show="activeModal === 'deleteUserModal'" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'deleteUserModal'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'deleteUserModal'" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-md overflow-hidden">
                    
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 rounded-full bg-rose-100 text-rose-500 flex items-center justify-center mx-auto mb-5">
                            <x-heroicon-o-exclamation-triangle class="size-10" />
                        </div>
                        <h3 class="text-xl font-bold text-slate-800 mb-2">Hapus Akun Pengguna</h3>
                        <p class="text-slate-500 mb-6 text-sm">Apakah Anda yakin ingin menghapus akun <span class="font-bold text-slate-700">"{{ $user->nama }}"</span>? Tindakan ini permanen dan semua data akan dihapus.</p>
                        
                        <div class="flex justify-center gap-3">
                            <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors w-full">Batal</button>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="w-full">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full px-6 py-2.5 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl shadow-sm transition-colors">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Reset Password --}}
        <div x-show="activeModal === 'modalResetPassword'" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'modalResetPassword'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'modalResetPassword'" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-lg overflow-hidden">
                    
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h5 class="text-xl font-bold text-lumina-blue">Reset Password</h5>
                        <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>

                    <form action="{{ route('admin.users.updateCredentials', $user) }}" method="POST" x-data="{ showPass: false }">
                        @csrf
                        @method('PATCH')
                        <div class="p-6 md:p-8 space-y-5">
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-2">Password Baru</label>
                                <div class="relative">
                                    <input :type="showPass ? 'text' : 'password'" name="password" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors text-sm" required minlength="8" placeholder="Masukkan password baru">
                                    <button type="button" @click="showPass = !showPass" class="absolute inset-y-0 right-0 px-4 text-slate-400 hover:text-lumina-blue">
                                        <i class="bi" :class="showPass ? 'bi-eye-slash' : 'bi-eye'"></i>
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi Password</label>
                                <input :type="showPass ? 'text' : 'password'" name="password_confirmation" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors text-sm" required minlength="8" placeholder="Ulangi password baru">
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end gap-3">
                            <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-sm transition-colors">Simpan Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Ubah Profil --}}
        <div x-show="activeModal === 'modalUbahProfil'" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'modalUbahProfil'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'modalUbahProfil'" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-lg overflow-hidden">
                    
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h5 class="text-xl font-bold text-lumina-blue">Ubah Profil</h5>
                        <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>

                    <form action="{{ route('admin.users.update', $user) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="p-6 md:p-8 space-y-5">
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-2">Nama Lengkap</label>
                                <input type="text" name="nama" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors text-sm" value="{{ $user->nama }}" required>
                            </div>
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-2">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors text-sm" value="{{ $user->email }}" required>
                            </div>
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-2">Peran Akses</label>
                                <select name="role" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors text-sm" required>
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>USER</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ADMIN</option>
                                </select>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end gap-3">
                            <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-sm transition-colors">Simpan Profil</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Modal Tambah Akses --}}
        <div x-show="activeModal === 'modalTambahAkses'" style="display: none;" class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'modalTambahAkses'" x-transition.opacity class="fixed inset-0 bg-slate-900/50" @click="activeModal = null"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'modalTambahAkses'" 
                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                     class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-lg overflow-hidden">
                    
                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h5 class="text-xl font-bold text-lumina-blue">Tambah Akses Buku</h5>
                        <button type="button" @click="activeModal = null" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>

                    <form action="{{ route('admin.users.addAccess', $user) }}" method="POST">
                        @csrf
                        <div class="p-6 md:p-8 space-y-5">
                            <div class="bg-blue-50 text-blue-700 px-4 py-3 rounded-xl text-sm font-medium border border-blue-100">
                                Pilih buku untuk diberikan akses. Buku yang ditambahkan akan dianggap telah berhasil dibayar oleh user ini.
                            </div>
                            <div>
                                <label class="block text-[0.65rem] font-bold text-slate-500 uppercase tracking-wider mb-2">Pilih Buku</label>
                                <select name="book_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors text-sm" required>
                                    <option value="">Pilih Buku...</option>
                                    @foreach ($allBooks as $bookItem)
                                        <option value="{{ $bookItem->id }}">{{ $bookItem->judul }} (Rp {{ number_format($bookItem->harga, 0, ',', '.') }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end gap-3">
                            <button type="button" @click="activeModal = null" class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Batal</button>
                            <button type="submit" class="px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-sm transition-colors">Izinkan Akses</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
