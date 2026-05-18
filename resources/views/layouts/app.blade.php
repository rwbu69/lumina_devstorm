@props([
    'showSearch' => false,
    'hideNavbar' => false,
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lumina Media') }}</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <x-lumina.colors />

    <style>
        body {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Arial, 'Noto Sans', 'Liberation Sans', sans-serif;
            background: var(--lm-bg);
            color: var(--lm-text);
        }

        h1, h2, h3, h4, h5, h6,
        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6,
        .navbar-brand {
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>
@if (!$hideNavbar)
<x-navbar :showSearch="$showSearch" />
@endif

<main>
    {{ $slot }}
</main>

<x-user.footer />

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
