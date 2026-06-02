<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Lumina Media - Admin Panel' }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <x-lumina.colors />

    <style>
        :root {
            --lm-sidebar-width: 280px;
            --lm-primary: #1a4fd9;
            --lm-accent: #f2c94c;
            --lm-bg: #ffffff;
            --lm-text: #111827;

            --bs-primary: var(--lm-primary);
            --bs-primary-rgb: 26, 79, 217;
            --bs-warning: var(--lm-accent);
            --bs-warning-rgb: 242, 201, 76;
            --bs-body-bg: var(--lm-bg);
            --bs-body-color: var(--lm-text);
            --bs-link-color: var(--lm-primary);
            --bs-link-hover-color: var(--lm-primary);
            --bs-body-font-size: 0.9375rem;
            --bs-heading-color: var(--lm-primary);
        }

        body {
            background: var(--lm-bg);
            color: var(--lm-text);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, 'Noto Sans', 'Liberation Sans', sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--lm-primary);
        }

        h1, h2, h3, h4, h5, h6,
        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6,
        .navbar-brand {
            font-family: 'Inter', sans-serif;
            font-weight: bolder;
        }
        
        .h1, h1 { font-size: 1.75rem; }
        .h2, h2 { font-size: 1.5rem; }
        .h3, h3 { font-size: 1.25rem; }

        .lm-sidebar {
            position: fixed;
            inset: 0 auto 0 0;
            width: var(--lm-sidebar-width);
            background: #ffffff;
            border-right: 1px solid rgba(0, 0, 0, .05);
        }
        .lm-main { margin-left: 0; }
        .lm-nav-link { 
            color: var(--lm-text); 
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.6rem 1rem !important;
        }
        .lm-nav-link:hover { background: rgba(var(--bs-primary-rgb), .05); }
        .lm-nav-link.active {
            background: rgba(var(--bs-primary-rgb), .08);
            border: 1px solid rgba(var(--bs-primary-rgb), .12);
            color: var(--bs-primary);
            font-weight: 600;
        }
        .lm-card { border: 1px solid rgba(0, 0, 0, .05); }
        .lm-muted { color: rgba(17, 24, 39, .65); }
        .lm-kpi-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            display: grid;
            place-items: center;
            background: rgba(var(--bs-primary-rgb), .08);
            color: var(--bs-primary);
            font-size: 0.9rem;
        }
        .lm-chart {
            height: 320px;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, .05);
            border-radius: 14px;
        }
        
        .table > :not(caption) > * > * {
            padding: 0.85rem 1rem;
        }
        
        /* ── Sidebar Collapse Animations ─────────────────────── */
        @media (min-width: 992px) {
            .lm-main { 
                margin-left: var(--lm-sidebar-width); 
                transition: margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1); 
            }
            .lm-sidebar { 
                transition: width 0.35s cubic-bezier(0.4, 0, 0.2, 1); 
                overflow-x: hidden; 
            }

            /* Text elements fade out smoothly */
            .lm-nav-link span,
            .lm-sidebar .sidebar-text,
            .btn-logout span {
                transition: opacity 0.2s ease, transform 0.2s ease;
                opacity: 1;
                transform: translateX(0);
                white-space: nowrap;
            }

            .lm-nav-link {
                transition: padding 0.35s cubic-bezier(0.4, 0, 0.2, 1), 
                            justify-content 0.35s ease;
            }

            .lm-nav-link i,
            .btn-logout i {
                transition: font-size 0.25s ease, margin 0.25s ease;
            }

            /* Collapsed state */
            body.sidebar-collapsed .lm-sidebar { width: 85px; }
            body.sidebar-collapsed .lm-main { margin-left: 85px; }
            
            body.sidebar-collapsed .lm-nav-link span,
            body.sidebar-collapsed .lm-sidebar .sidebar-text,
            body.sidebar-collapsed .btn-logout span { 
                opacity: 0; 
                transform: translateX(-8px);
                width: 0;
                overflow: hidden;
                pointer-events: none;
                position: absolute;
            }
            
            body.sidebar-collapsed .lm-sidebar .d-flex.align-items-center { justify-content: center !important; }
            body.sidebar-collapsed .lm-nav-link { justify-content: center !important; padding: 0.8rem !important; }
            body.sidebar-collapsed .lm-nav-link i, 
            body.sidebar-collapsed .btn-logout i { font-size: 1.25rem; margin: 0 !important; }
            body.sidebar-collapsed .btn-logout { padding-left: 0; padding-right: 0; }

            /* Toggle button rotation */
            #sidebarToggleBtn i {
                transition: transform 0.35s cubic-bezier(0.4, 0, 0.2, 1);
                display: inline-block;
            }
            body.sidebar-collapsed #sidebarToggleBtn i {
                transform: rotate(180deg);
            }
        }
        @media (max-width: 991.98px) {
            :root { --lm-sidebar-width: 240px; }
        }
    </style>

    @stack('styles')
</head>
<body>
<script>
    if (localStorage.getItem('sidebar-collapsed') === 'true') {
        document.body.classList.add('sidebar-collapsed');
    }
</script>
<x-admin.sidebar />

<main class="lm-main">
    <div class="container-fluid px-4 px-lg-5 py-4">
        {{ $slot }}
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('sidebarToggleBtn');
        const body = document.body;
        
        if (toggleBtn) {
            toggleBtn.addEventListener('click', function() {
                body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('sidebar-collapsed', body.classList.contains('sidebar-collapsed'));
            });
        }
    });
</script>
@stack('scripts')
</body>
</html>
