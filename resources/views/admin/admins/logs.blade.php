<x-admin.layout :title="'Lumina Media - Activity Logs'">
    <div class="bg-[#FDFBF7] min-h-full">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
                <a href="{{ route('admin.admins.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-lumina-blue transition-colors mb-2">
                    <x-heroicon-o-arrow-left class="size-4 mr-1" /> Kembali ke Kelola Admin
                </a>
                <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">Log Aktivitas Admin</h1>
                <p class="text-slate-500 font-medium">Jejak rekam dan audit trail aktivitas Administrator</p>
            </div>

            <form action="{{ route('admin.admins.logs') }}" method="GET" class="flex items-center">
                <div class="relative w-full sm:w-64">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aktivitas..." class="w-full pl-10 pr-4 py-2 border border-slate-200 rounded-xl focus:ring-2 focus:ring-lumina-blue/20 focus:border-lumina-blue transition-colors shadow-sm bg-white">
                </div>
                <button type="submit" class="ml-2 bg-lumina-blue hover:bg-blue-800 text-white px-4 py-2 rounded-xl font-bold shadow-sm transition-colors">Cari</button>
            </form>
        </div>

        <x-admin.table>
            <x-slot:header>
                <div class="flex items-center justify-between">
                    <h5 class="font-bold text-lumina-blue flex items-center text-lg"><x-heroicon-o-clipboard-document-list class="mr-2 size-6" />Riwayat Audit</h5>
                </div>
            </x-slot:header>

            <x-slot:head>
                <tr>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Admin</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Aksi</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Detail</th>
                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">Waktu & IP</th>
                </tr>
            </x-slot:head>

            @foreach($logs as $log)
                <tr class="hover:bg-slate-50/50 transition-colors group border-b border-slate-100 last:border-0">
                    <td class="px-6 py-4">
                        @if($log->user)
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-lumina-blue/10 border border-lumina-blue/20 flex items-center justify-center shrink-0 text-lumina-blue font-bold text-xs">
                                    {{ strtoupper(substr($log->user->nama, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 text-sm">{{ $log->user->nama }}</div>
                                </div>
                            </div>
                        @else
                            <span class="text-slate-400 font-medium italic">Admin Terhapus</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 text-xs font-bold rounded-full border bg-slate-100 text-slate-700 border-slate-200">
                            {{ $log->action }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm font-semibold text-slate-600">
                        {{ $log->description ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-xs font-bold text-slate-700">{{ $log->created_at->format('d M Y, H:i') }}</div>
                        <div class="text-[0.65rem] font-medium text-slate-400 font-mono mt-1">IP: {{ $log->ip_address }}</div>
                    </td>
                </tr>
            @endforeach

            <x-slot:emptyState>
                <div class="flex flex-col items-center justify-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                        <x-heroicon-o-document-magnifying-glass class="size-10 text-slate-300" />
                    </div>
                    <div class="font-bold text-slate-800 text-lg mb-1">Log Kosong</div>
                    <div class="text-slate-500 text-sm">Belum ada aktivitas admin yang dicatat.</div>
                </div>
            </x-slot:emptyState>

            <x-slot:pagination>
                {{ $logs->links() }}
            </x-slot:pagination>
        </x-admin.table>
    </div>
</x-admin.layout>
