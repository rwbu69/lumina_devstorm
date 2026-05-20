@props([
    'showSearch' => false,
])

<nav class="navbar navbar-expand-lg bg-white border-bottom sticky-top">
    <div class="container py-2">
        <a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary-subtle" style="width:28px;height:28px;">
                <i class="bi bi-moon-stars-fill text-primary"></i>
            </span>
            Lumina Media
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            @if ($showSearch)
                <div class="d-lg-flex align-items-center gap-3 ms-lg-3 me-lg-auto my-3 my-lg-0" style="min-width: 320px;">
                    <x-search-bar :action="route('catalog.index')" placeholder="Cari buku..." class="w-100" />
                </div>
            @endif

            <ul class="navbar-nav ms-lg-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('catalog.index') }}">Katalog</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li>

                @guest
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-primary rounded-3" href="{{ route('login') }}">Masuk</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item ms-lg-2">
                        <a class="btn btn-outline-primary rounded-3" href="{{ route('profile.edit') }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-primary rounded-3">Logout</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
