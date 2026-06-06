<footer class="bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="font-semibold text-slate-800 mb-3">Lumina Media</div>
                <div class="text-slate-500 text-sm leading-relaxed">
                    Platform e-commerce buku digital untuk belajar, berkembang, dan berkarya.
                </div>
            </div>

            <div>
                <div class="font-semibold text-slate-800 mb-3">Menu</div>
                <ul class="space-y-2 text-sm text-slate-500">
                    <li><a class="hover:text-lumina-blue transition-colors" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="hover:text-lumina-blue transition-colors" href="{{ route('catalog.index') }}">Katalog</a></li>
                    <li><a class="hover:text-lumina-blue transition-colors" href="{{ route('cart.index') }}">Keranjang</a></li>
                    <li><a class="hover:text-lumina-blue transition-colors" href="{{ route('collection.index') }}">Koleksi</a></li>
                </ul>
            </div>

            <div>
                <div class="font-semibold text-slate-800 mb-3">Kontak</div>
                <div class="text-slate-500 text-sm mb-2">Email: support@luminamedia.test</div>
                <div class="text-slate-500 text-sm">Jam: Senin–Jumat (09.00–17.00)</div>
            </div>
        </div>

        <div class="border-t border-slate-100 mt-8 pt-6 text-slate-400 text-xs text-center">
            &copy; {{ date('Y') }} Lumina Media. All rights reserved.
        </div>
    </div>
</footer>
