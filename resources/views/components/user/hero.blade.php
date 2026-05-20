@props([
    'title' => 'Lumina Media',
    'subtitle' => 'Temukan dan beli buku digital favoritmu.',
    'bgImage' => null,
])

@php
    $bgStyle = $bgImage
        ? "background-image: url('".e($bgImage)."'); background-size: cover; background-position: center;"
    : 'background: var(--lm-primary);';
@endphp

<header class="position-relative" style="{{ $bgStyle }}">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent position-absolute top-0 start-0 w-100">
        <div class="container py-3">
            <a class="navbar-brand fw-semibold" href="{{ route('home') }}">
                Lumina Media
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#userNavbar" aria-controls="userNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="userNavbar">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('user.dashboard') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.edit') }}">Profil</a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light">Logout</button>
                            </form>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light text-primary" href="{{ route('register') }}">Daftar</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container" style="padding-top: 112px; padding-bottom: 88px;">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="display-6 fw-semibold text-white mb-3">{{ $title }}</h1>
                <p class="lead text-white-50 mb-0">{{ $subtitle }}</p>
            </div>
        </div>
    </div>
</header>
