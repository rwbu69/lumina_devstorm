@props([
    'showSearch' => true,
])

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top py-3">
    <div class="container">
        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div class="me-2 d-flex align-items-center justify-content-center rounded-circle" style="width: 40px; height: 40px; background: linear-gradient(135deg, #f2c94c 0%, #2b65f6 100%);">
                <i class="bi bi-lightning-charge-fill text-white"></i>
            </div>
            <span class="h5 fw-bold text-primary mb-0" style="font-family: 'Playfair Display', serif;">Lumina Media</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            {{-- Search Bar --}}
            <div class="mx-auto my-3 my-lg-0" style="width: 100%; max-width: 400px;">
                <div class="input-group bg-light rounded-pill px-3 py-1">
                    <span class="input-group-text bg-transparent border-0 text-secondary">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control bg-transparent border-0 small" placeholder="Cari buku..." aria-label="Search">
                </div>
            </div>

            {{-- Nav Links --}}
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('home') ? 'text-dark' : 'text-secondary' }}" href="{{ route('home') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold {{ request()->routeIs('catalog.*') ? 'text-dark' : 'text-secondary' }}" href="{{ route('catalog.index') }}">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-secondary" href="{{ route('collection.index') }}">Koleksi Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fw-semibold text-secondary" href="#">Kontak</a>
                </li>

                {{-- Action Icons --}}
                <li class="nav-item ms-lg-3">
                    <a href="{{ route('cart.index') }}" class="nav-link position-relative p-0 text-dark">
                        <i class="bi bi-cart3 fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark" style="font-size: 0.6rem;">
                            3
                        </span>
                    </a>
                </li>
                
                @auth
                <li class="nav-item ms-lg-3">
                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none border rounded-3 p-1" data-bs-toggle="dropdown">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama) }}&background=f2c94c&color=fff" alt="mdo" width="32" height="32" class="rounded-2">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
                @else
                <li class="nav-item ms-lg-3">
                    <a href="{{ route('login') }}" class="btn btn-primary rounded-pill px-4">Masuk</a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        transition: color 0.2s;
    }
    .nav-link:hover {
        color: #2b65f6 !important;
    }
    .navbar .form-control:focus {
        box-shadow: none;
    }
</style>
