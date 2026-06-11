<x-admin.layout :title="'Lumina Media - Kelola Admin'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Kelola Admin</h1>
                <p class="text-slate-500 font-medium">Manajemen hak akses Administrator tingkat lanjut</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.admins.logs') }}"
                    class="inline-flex items-center justify-center bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
                    <x-heroicon-o-clipboard-document-list class="mr-2 size-5" /> Log Aktivitas
                </a>
                <button x-data @click="$dispatch('open-modal', 'modalTambahAdmin')"
                    class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
                    <x-heroicon-o-plus class="mr-2 size-5" /> Tambah Admin
                </button>
            </div>
        </div>



        <x-admin.table>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <h5 class="font-bold text-lumina-blue flex items-center text-lg"><x-heroicon-o-shield-check
                            class="mr-2 size-6" />Daftar Administrator</h5>
                </div>
            </x-slot:header>

            <x-slot:head>
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Role</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Tanggal Dibuat</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">Aksi</th>
                </tr>
            </x-slot:head>

            @foreach ($admins as $admin)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-100 last:border-0" x-data>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 rounded-full bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0 text-slate-500 font-bold">
                                {{ strtoupper(substr($admin->nama, 0, 1)) }}
                            </div>
                            <div>
                                <div
                                    class="font-bold text-slate-800 text-sm group-hover:text-lumina-blue transition-colors">
                                    {{ $admin->nama }}</div>
                                <div class="text-xs text-slate-500 font-medium">{{ $admin->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if ($admin->role === 'superadmin')
                            <span
                                class="px-3 py-1 text-xs font-bold rounded-full border bg-amber-100 text-amber-700 border-amber-200">Superadmin</span>
                        @else
                            <span
                                class="px-3 py-1 text-xs font-bold rounded-full border bg-lumina-blue/10 text-lumina-blue border-lumina-blue/20">Admin</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-slate-500">
                        {{ $admin->created_at->format('d M Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2 transition-opacity">
                            @if ($admin->id !== auth()->id())
                                <button @click="$dispatch('open-modal', 'deleteModal-{{ $admin->id }}')"
                                    class="px-3 py-1.5 bg-white border border-rose-200 text-rose-500 hover:bg-rose-50 rounded-lg text-xs font-bold transition-all shadow-sm">
                                    Hapus
                                </button>
                            @else
                                <span class="px-3 py-1.5 text-slate-400 text-xs font-semibold italic">Anda (Saat
                                    ini)</span>
                            @endif
                        </div>
                    </td>
                </tr>
            @endforeach

            <x-slot:emptyState>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <x-heroicon-o-shield-exclamation class="size-10 text-slate-300" />
                    </div>
                    <div class="font-bold text-slate-800 text-lg mb-1">Belum ada Admin tambahan</div>
                </div>
            </x-slot:emptyState>

            <x-slot:pagination>
                {{ $admins->links() }}
            </x-slot:pagination>
        </x-admin.table>
    </div>

    {{-- Alpine Modals Container --}}
    <div x-data="{ activeModal: {!! $errors->any() ? "'modalTambahAdmin'" : 'null' !!} }" @open-modal.window="activeModal = $event.detail"
        @close-modal.window="activeModal = null" @keydown.escape.window="activeModal = null">

        {{-- Modal Tambah Admin --}}
        <div x-show="activeModal === 'modalTambahAdmin'" style="display: none;"
            class="fixed inset-0 z-1050 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div x-show="activeModal === 'modalTambahAdmin'" x-transition.opacity class="fixed inset-0 bg-slate-900/50"></div>

            <div class="flex min-h-full items-center justify-center p-4">
                <div x-show="activeModal === 'modalTambahAdmin'" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-2xl overflow-hidden">

                    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h5 class="text-xl font-bold text-lumina-blue">Tambah Administrator Baru</h5>
                        <button type="button" @click="activeModal = null"
                            class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                            <x-heroicon-o-x-mark class="size-5" />
                        </button>
                    </div>

                    <form action="{{ route('admin.admins.store') }}" method="POST"
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
                                        class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Role
                                        Akses</label>
                                    <select name="role" required
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors">
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                            (Staff)</option>
                                        <option value="superadmin"
                                            {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin (Akses
                                            Penuh)</option>
                                    </select>
                                    @error('role')
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
                                Admin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @foreach ($admins as $admin)
            @if ($admin->id !== auth()->id())
                {{-- Modal Delete --}}
                <div x-show="activeModal === 'deleteModal-{{ $admin->id }}'" style="display: none;"
                    class="fixed inset-0 z-1050 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                    aria-modal="true">
                    <div x-show="activeModal === 'deleteModal-{{ $admin->id }}'" x-transition.opacity
                        class="fixed inset-0 bg-slate-900/50"></div>

                    <div class="flex min-h-full items-center justify-center p-4">
                        <div x-show="activeModal === 'deleteModal-{{ $admin->id }}'"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            class="relative transform bg-white rounded-3xl text-left shadow-lg transition-all w-full max-w-lg overflow-hidden">

                            <div class="p-8 text-center">
                                <div
                                    class="w-16 h-16 rounded-full bg-rose-100 text-rose-500 flex items-center justify-center mx-auto mb-5">
                                    <x-heroicon-o-exclamation-triangle class="size-10" />
                                </div>
                                <h3 class="text-xl font-bold text-slate-800 mb-2">Konfirmasi Hapus</h3>
                                <p class="text-slate-500 mb-6">Apakah kamu yakin ingin mencabut hak akses Admin dari
                                    <span class="font-bold text-slate-700">"{{ $admin->nama }}"</span>? Tindakan ini
                                    tidak dapat dibatalkan.</p>

                                <div class="flex justify-center gap-3">
                                    <button type="button" @click="activeModal = null"
                                        class="px-6 py-2.5 bg-white border border-slate-200 text-slate-700 font-bold rounded-xl shadow-sm hover:bg-slate-50 transition-colors w-full">Batal</button>
                                    <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST"
                                        class="w-full">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full px-6 py-2.5 bg-rose-500 hover:bg-rose-600 text-white font-bold rounded-xl shadow-sm transition-colors">Ya,
                                            Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-admin.layout>
