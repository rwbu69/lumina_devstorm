<footer class="bg-white border-top">
    <div class="container py-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="fw-semibold mb-2">Lumina Media</div>
                <div class="text-secondary">
                    Platform e-commerce buku digital untuk belajar, berkembang, dan berkarya.
                </div>
            </div>

            <div class="col-md-4">
                <div class="fw-semibold mb-2">Menu</div>
                <ul class="list-unstyled mb-0">
                    <li><a class="text-decoration-none" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="text-decoration-none" href="{{ route('catalog.index') }}">Katalog</a></li>
                    <li><a class="text-decoration-none" href="{{ route('cart.index') }}">Keranjang</a></li>
                    <li><a class="text-decoration-none" href="{{ route('collection.index') }}">Koleksi</a></li>
                </ul>
            </div>

            <div class="col-md-4">
                <div class="fw-semibold mb-2">Kontak</div>
                <div class="text-secondary">Email: support@luminamedia.test</div>
                <div class="text-secondary">Jam: Senin–Jumat (09.00–17.00)</div>
            </div>
        </div>

        <div class="border-top mt-4 pt-3 text-secondary small">
            &copy; {{ date('Y') }} Lumina Media. All rights reserved.
        </div>
    </div>
</footer>
