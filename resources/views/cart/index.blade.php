<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-3xl font-serif font-bold text-slate-800 mb-8 flex items-center"><x-heroicon-o-shopping-cart class="mr-3 text-lumina-blue size-5" />Keranjang Belanja</h1>

        @if (session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl shadow-sm mb-8 flex items-center"
                role="alert">
                <x-heroicon-s-check-circle class="mr-3 size-6" />
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if ($items->isEmpty())
            <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-12 text-center max-w-2xl mx-auto mt-12">
                <div class="bg-slate-50 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
                    <x-heroicon-o-shopping-cart class="size-16 text-slate-300" />
                </div>
                <h4 class="text-2xl font-bold text-slate-800 mb-3">Keranjang Belanja Anda Kosong</h4>
                <p class="text-slate-500 mb-8 font-light text-lg">Mari jelajahi pustaka kami dan temukan buku rohani
                    pembangun iman Anda!</p>
                <a href="{{ route('catalog.index') }}"
                    class="inline-flex items-center justify-center bg-lumina-blue hover:bg-blue-800 text-white font-bold py-3.5 px-8 rounded-xl shadow-sm transition-all">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                <!-- Left Side: Items List -->
                <div class="lg:w-2/3">
                    <div class="bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden">
                        <div class="divide-y divide-slate-100">
                            @foreach ($items as $item)
                                <div class="p-6 transition-colors hover:bg-slate-50/50">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                                        <!-- Cover Icon -->
                                        <div class="shrink-0">
                                            <div
                                                class="bg-slate-100 rounded-xl flex items-center justify-center overflow-hidden border border-slate-200 w-20 h-28">
                                                @if ($item->cover_buku)
                                                    <img src="{{ asset('storage/' . $item->cover_buku) }}"
                                                        alt="{{ $item->judul }}" class="w-full h-full object-cover">
                                                @else
                                                    <x-heroicon-o-book-open class="text-slate-300 size-10" />
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Item Details -->
                                        <div class="grow min-w-0">
                                            <span
                                                class="inline-block bg-lumina-blue/10 text-lumina-blue px-2.5 py-1 rounded-md text-xs font-bold mb-2">{{ $item->category->nama }}</span>
                                            <h5 class="text-lg font-bold text-slate-800 mb-1 truncate"
                                                title="{{ $item->judul }}">{{ $item->judul }}</h5>
                                            <p class="text-slate-500 text-sm">Penulis: <span
                                                    class="font-semibold">{{ $item->penulis }}</span></p>
                                        </div>

                                        <!-- Price & Delete Button -->
                                        <div
                                            class="sm:text-right shrink-0 w-full sm:w-auto flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-start gap-4">
                                            <div class="font-bold text-lumina-blue text-xl">Rp
                                                {{ number_format($item->harga, 0, ',', '.') }}</div>

                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-rose-500 hover:text-white hover:bg-rose-500 px-3 py-1.5 rounded-lg text-sm font-semibold transition-colors border border-rose-200 hover:border-transparent flex items-center">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Side: Order Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white border border-slate-200 shadow-sm rounded-3xl p-6 md:p-8 sticky top-24">
                        <h5 class="font-bold text-xl text-slate-800 mb-6">Ringkasan Pesanan</h5>

                        <div class="flex justify-content-between mb-4 text-sm md:text-base">
                            <span class="text-slate-500 grow">Jumlah E-Book</span>
                            <span class="font-semibold text-slate-800">{{ $items->count() }} item</span>
                        </div>

                        <div class="flex justify-content-between mb-6 text-sm md:text-base">
                            <span class="text-slate-500 grow">Format Pengiriman</span>
                            <span
                                class="font-bold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-full text-xs">Unduhan
                                Digital</span>
                        </div>

                        <div class="border-t border-slate-100 my-6"></div>

                        <div class="flex justify-between items-center mb-8">
                            <span class="text-slate-600 font-bold">Total Tagihan</span>
                            <span class="font-bold text-lumina-blue text-2xl md:text-3xl">Rp
                                {{ number_format($total, 0, ',', '.') }}</span>
                        </div>

                        <form action="{{ route('orders.store') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center bg-blue-700 text-white py-4 px-4 rounded-xl font-bold shadow-sm transition-all hover:opacity-90">
                                Proses Checkout
                            </button>
                        </form>

                        <div class="text-center mt-6">
                            <a href="{{ route('catalog.index') }}"
                                class="text-slate-500 hover:text-lumina-blue text-sm font-semibold transition-colors inline-flex items-center mt-2">
                                Tambah e-book rohani lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
