@php
    $menu = [
        [
            'label' => 'Dashboard',
            'icon' => 'bi-grid',
            'route' => 'admin.dashboard',
            'active' => request()->routeIs('admin.dashboard'),
        ],
        [
            'label' => 'Pesanan',
            'icon' => 'bi-bag-check',
            'route' => 'admin.orders.index',
            'active' => request()->routeIs('admin.orders.*'),
        ],
        [
            'label' => 'Kelola Buku',
            'icon' => 'bi-book',
            'route' => 'admin.books.index',
            'active' => request()->routeIs('admin.books.*'),
        ],
        [
            'label' => 'Laporan',
            'icon' => 'bi-bar-chart',
            'route' => 'admin.reports.index',
            'active' => request()->routeIs('admin.reports.*'),
        ],
        [
            'label' => 'User',
            'icon' => 'bi-people',
            'route' => 'admin.users.index',
            'active' => request()->routeIs('admin.users.*'),
        ],
    ];

    $brand = function () {
        return <<<'HTML'
<div class="d-flex align-items-center gap-3">
    <div class="rounded-circle" style="width:44px;height:44px;background:rgba(var(--bs-primary-rgb), .10);display:grid;place-items:center;">
        <i class="bi bi-moon-stars-fill text-primary"></i>
    </div>
    <div class="lh-sm">
        <div class="fw-semibold">Lumina Media</div>
        <div class="small text-primary">Admin Panel</div>
    </div>
</div>
HTML;
    };
@endphp

{{-- Mobile: top bar + offcanvas --}}
<nav class="navbar bg-white border-bottom d-lg-none">
    <div class="container-fluid px-4">
        <button class="btn btn-outline-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminSidebar" aria-controls="adminSidebar">
            <i class="bi bi-list"></i>
        </button>

        <a class="navbar-brand fw-semibold mb-0" href="{{ route('admin.dashboard') }}">
            Lumina Media
        </a>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</nav>

<div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="adminSidebar" aria-labelledby="adminSidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="adminSidebarLabel">Menu Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Tutup"></button>
    </div>
    <div class="offcanvas-body p-0">
        <div class="p-4">
            {!! $brand() !!}
        </div>

        <div class="px-3 pb-3">
            <div class="d-grid gap-2">
                @foreach ($menu as $item)
                    <a class="lm-nav-link text-decoration-none rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ $item['active'] ? 'active' : '' }}"
                       href="{{ route($item['route']) }}"
                       data-bs-dismiss="offcanvas"
                    >
                        <i class="bi {{ $item['icon'] }}"></i>
                        <span>{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="px-3 pb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-primary w-100 rounded-3">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>

{{-- Desktop: fixed sidebar --}}
<aside class="lm-sidebar d-none d-lg-flex flex-column">
    <div class="p-4">
        {!! $brand() !!}
    </div>

    <div class="px-3">
        <div class="d-grid gap-2">
            @foreach ($menu as $item)
                <a class="lm-nav-link text-decoration-none rounded-3 px-3 py-2 d-flex align-items-center gap-2 {{ $item['active'] ? 'active' : '' }}" href="{{ route($item['route']) }}">
                    <i class="bi {{ $item['icon'] }}"></i>
                    <span>{{ $item['label'] }}</span>
                </a>
            @endforeach
        </div>
    </div>

    <div class="mt-auto p-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-primary w-100 rounded-3">
                <i class="bi bi-box-arrow-right me-2"></i>
                Logout
            </button>
        </form>
    </div>
</aside>
