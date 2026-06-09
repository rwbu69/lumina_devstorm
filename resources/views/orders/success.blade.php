<x-app-layout :hideNavbar="true">
    <x-user-navbar />

    <div class="min-h-[70vh] flex flex-col items-center justify-center px-4 sm:px-6 lg:px-8 py-10">
        <div class="text-center max-w-2xl mx-auto">
            <!-- Icon -->
            <div class="bg-slate-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-8 border border-slate-200">
                <svg class="text-lumina-blue w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Heading -->
            <h1 class="text-5xl font-serif text-slate-900 mb-4 tracking-tight">Terima Kasih!</h1>
            <h2 class="text-xl font-semibold text-lumina-blue mb-8">Pembayaran Berhasil Dikonfirmasi</h2>

            <!-- Text -->
            <p class="text-slate-600 text-lg mb-8 leading-relaxed">
                Terima kasih atas pesanan Anda. Kami akan segera<br class="hidden sm:block">
                memverifikasi bukti pembayaran Anda dalam waktu <strong class="font-bold text-slate-700">1x24<br class="hidden sm:block">
                jam.</strong>
            </p>

            <p class="text-slate-500 text-sm mb-10">
                Anda dapat memantau status pesanan di halaman Profil atau Katalog Buku Saya.
            </p>

            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('collection.index') }}" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-base font-bold rounded-xl text-white bg-lumina-blue hover:bg-blue-800 transition-colors shadow-sm">
                    Lihat Koleksi Buku Saya
                </a>
                <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-lumina-blue text-base font-bold rounded-xl text-lumina-blue bg-white hover:bg-slate-50 transition-colors">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
