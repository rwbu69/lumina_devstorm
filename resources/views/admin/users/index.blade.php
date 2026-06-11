<x-admin.layout :title="'Lumina Media - Kelola User'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Kelola User</h1>
                <p class="text-slate-500 font-medium">Manajemen akun pengguna dan bantuan akses.</p>
            </div>
            <button x-data @click="$dispatch('open-modal', 'modalTambahUser')" class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
                <x-heroicon-s-user-plus class="mr-2 size-6" /> Tambah User
            </button>
        </div>

        {{-- Filters & Search --}}
        <div class="bg-white border border-slate-200 shadow-sm rounded-3xl mb-8 p-4">
            <form action="{{ route('admin.users.index') }}" method="GET" class="max-w-2xl">
                {{-- Search bar --}}
                <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus-within:border-lumina-blue focus-within:ring-2 focus-within:ring-lumina-blue/20 transition-all">
                    <x-heroicon-o-magnifying-glass class="text-slate-400 size-6" />
                    <input type="text" name="search"
                           class="bg-transparent border-0 w-full focus:ring-0 p-0 text-sm font-medium text-slate-700 placeholder-slate-400"
                           placeholder="Cari berdasarkan nama atau email..."
                           value="{{ request('search') }}">
                </div>
            </form>
        </div>

        {{-- Table --}}
        <x-admin.table>
            <x-slot:head>
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider w-1/3">Nama Pengguna</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat Email</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Bergabung</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">Aksi Bantuan</th>
                </tr>
            </x-slot:head>

            @foreach ($users as $user)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-100 last:border-0">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-lumina-blue/10 text-lumina-blue flex items-center justify-center font-bold text-sm shrink-0 border border-lumina-blue/20">
                                {{ strtoupper(substr($user->nama, 0, 2)) }}
                            </div>
                            <div class="font-bold text-slate-800 text-sm group-hover:text-lumina-blue transition-colors">{{ $user->nama }}</div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-600">
                        {{ $user->email }}
                    </td>
                    <td class="px-6 py-4 text-sm font-medium text-slate-500">
                        {{ $user->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.users.show', $user) }}"
                           class="inline-flex items-center px-4 py-2 bg-blue-50 text-lumina-blue hover:bg-lumina-blue hover:text-white rounded-lg text-xs font-bold transition-colors shadow-sm">
                            Informasi Akun
                        </a>
                    </td>
                </tr>
            @endforeach

            <x-slot:emptyState>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <x-heroicon-o-user-minus class="size-10 text-slate-300" />
                    </div>
                    <div class="font-bold text-slate-800 text-lg mb-1">Belum ada pengguna</div>
                    <div class="text-slate-500 text-sm">Data pengguna yang terdaftar akan muncul di sini.</div>
                </div>
            </x-slot:emptyState>

            <x-slot:pagination>
                @if($users->hasPages())
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <span class="text-slate-500 text-sm">Menampilkan <span class="font-semibold text-slate-700">{{ $users->firstItem() }}-{{ $users->lastItem() }}</span> dari <span class="font-semibold text-slate-700">{{ $users->total() }}</span> pengguna</span>
                        <div class="flex gap-2">
                            @if ($users->onFirstPage())
                                <span class="px-4 py-2 border border-slate-200 text-slate-400 bg-slate-50 rounded-xl text-sm font-semibold cursor-not-allowed">Sebelumnya</span>
                            @else
                                <a href="{{ $users->previousPageUrl() }}" class="px-4 py-2 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Sebelumnya</a>
                            @endif

                            @if ($users->hasMorePages())
                                <a href="{{ $users->nextPageUrl() }}" class="px-4 py-2 border border-slate-200 text-slate-700 bg-white hover:bg-slate-50 rounded-xl text-sm font-semibold transition-colors shadow-sm">Selanjutnya</a>
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
    <div x-data="{ activeModal: {!! $errors->any() ? "'modalTambahUser'" : 'null' !!} }" @open-modal.window="activeModal = $event.detail"
        @close-modal.window="activeModal = null" @keydown.escape.window="activeModal = null">

        {{-- Modal Tambah User --}}
        <div x-show="activeModal === 'modalTambahUser'" style="display: none;"
            class="fixed inset-0 z-[1050] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'modalTambahUser'" x-transition.opacity class="fixed inset-0 bg-slate-900/50"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'modalTambahUser'" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-2xl overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h5 class="text-xl font-bold text-lumina-blue">Tambah Pengguna Baru</h5>
                        <button type="button" @click="activeModal = null"
                            class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>

                    <form action="{{ route('admin.users.store') }}" method="POST"
                        class="max-h-[75vh] overflow-y-auto">
                        @csrf
                        <div class="p-6 md:p-8">
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Nama
                                        Lengkap</label>
                                    <input type="text" name="nama" value="{{ old('nama') }}" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                    @error('nama')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Username</label>
                                    <input type="text" name="username" value="{{ old('username') }}" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                    @error('username')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Alamat
                                        Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                    @error('email')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Kata
                                        Sandi</label>
                                    <input type="password" name="password" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                    @error('password')
                                        <p class="text-rose-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Konfirmasi
                                        Kata Sandi</label>
                                    <input type="password" name="password_confirmation" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                </div>
                            </div>
                        </div>
                        <div
                            class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end gap-3 sticky bottom-0">
                            <button type="button" @click="activeModal = null"
                                class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors">Batal</button>
                            <button type="submit"
                                class="px-6 py-2.5 bg-lumina-blue hover:bg-blue-800 text-white font-bold rounded-xl shadow-sm transition-colors">Simpan
                                Pengguna</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin.layout>
