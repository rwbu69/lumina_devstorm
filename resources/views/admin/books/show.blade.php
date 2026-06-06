<x-admin.layout :title="'Lumina Media - Detail Buku'">
    <x-admin.section-header
        title="Detail Buku"
        subtitle="Ringkasan informasi buku yang dipilih."
    >
        <div class="flex gap-2">
            <a href="{{ route('admin.books.index') }}" class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 rounded-xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 hover:text-lumina-blue transition-colors shadow-sm">
                Kembali
            </a>
            <a href="{{ route('admin.books.edit', $book) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-xl shadow-sm text-sm font-semibold text-white bg-lumina-blue hover:bg-blue-800 transition-colors">
                <x-heroicon-o-pencil-square class="mr-2 size-5" />
                Edit
            </a>
        </div>
    </x-admin.section-header>

    <div class="mt-8">
        <x-admin.card>
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <div class="lg:col-span-8">
                    <div class="text-sm font-semibold text-slate-800 mb-1">Judul</div>
                    <div class="text-slate-500 font-medium">{{ $book->judul }}</div>
                </div>
                <div class="lg:col-span-4">
                    <div class="text-sm font-semibold text-slate-800 mb-1">Harga</div>
                    <div class="text-slate-500 font-medium">Rp {{ number_format((float) $book->harga, 0, ',', '.') }}</div>
                </div>
                <div class="lg:col-span-6">
                    <div class="text-sm font-semibold text-slate-800 mb-1">Penulis</div>
                    <div class="text-slate-500 font-medium">{{ $book->penulis }}</div>
                </div>
                <div class="lg:col-span-6">
                    <div class="text-sm font-semibold text-slate-800 mb-1">Kategori</div>
                    <div class="text-slate-500 font-medium">{{ $book->category?->nama_kategori ?? '-' }}</div>
                </div>
                <div class="lg:col-span-12">
                    <div class="text-sm font-semibold text-slate-800 mb-1">File Buku</div>
                    <div class="text-slate-500 font-medium">{{ $book->file_buku }}</div>
                </div>
            </div>
        </x-admin.card>
    </div>
</x-admin.layout>
