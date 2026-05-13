<footer class="bg-white border-top py-5">
    <div class="container">
        <div class="row g-4">
            {{-- Logo and Description --}}
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" style="height: 30px;" onerror="this.src='https://via.placeholder.com/30x30?text=L'">
                    <span class="h5 fw-bold text-primary mb-0" style="font-family: 'Playfair Display', serif;">Lumina Media</span>
                </div>
                <p class="text-secondary small lh-lg" style="max-width: 300px;">
                    Toko buku Kristen terpercaya yang menyediakan literatur rohani berkualitas untuk membangun iman jemaat di seluruh Indonesia.
                </p>
            </div>

            {{-- Categories --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="fw-bold mb-3">Kategori</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Teologi</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Biblika</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Kepemimpinan</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Keluarga</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Anak</a></li>
                </ul>
            </div>

            {{-- Information --}}
            <div class="col-6 col-md-3 col-lg-2">
                <h6 class="fw-bold mb-3">Informasi</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Tentang Kami</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Syarat & Ketentuan</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Kebijakan Privasi</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">FAQ</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none opacity-75">Bantuan</a></li>
                </ul>
            </div>

            {{-- Contact Us --}}
            <div class="col-md-6 col-lg-4">
                <h6 class="fw-bold mb-3">Hubungi Kami</h6>
                <ul class="list-unstyled small">
                    <li class="d-flex mb-3">
                        <i class="bi bi-geo-alt text-primary me-3"></i>
                        <span class="text-secondary small">Jl. Kebenaran No. 7, Jakarta Pusat, 10110</span>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-telephone text-primary me-3"></i>
                        <span class="text-secondary small">(021) 555-0123</span>
                    </li>
                    <li class="d-flex mb-3">
                        <i class="bi bi-envelope text-primary me-3"></i>
                        <span class="text-secondary small">info@luminamedia.id</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-top mt-5 pt-4 text-center">
            <p class="text-secondary small mb-0">
                &copy; {{ date('Y') }} Lumina Media. Hak Cipta Dilindungi.
            </p>
        </div>
    </div>
</footer>
