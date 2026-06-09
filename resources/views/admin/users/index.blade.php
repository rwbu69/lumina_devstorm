<x-admin.layout :title="'Lumina Media - Kelola User'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Kelola User</h1>
                <p class="text-slate-500 font-medium">Manajemen akun pengguna dan bantuan akses.</p>
            </div>
            <button class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white px-5 py-2.5 rounded-xl font-bold shadow-sm transition-all whitespace-nowrap">
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
</x-admin.layout>
