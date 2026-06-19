@props([
    'showSearch' => false,
    'hideNavbar' => false,
    'title' => config('app.name', 'Lumina Media'),
    'meta_description' => 'Platform toko e-book rohani terpercaya. Temukan berbagai buku digital Kristen, theologi, dan renungan harian.',
])

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title === config('app.name', 'Lumina Media') ? $title : $title . ' - ' . config('app.name', 'Lumina Media') }}</title>
    <meta name="description" content="{{ $meta_description }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $meta_description }}">
    <meta property="og:type" content="website">
    <meta name="theme-color" content="#1a4fd9">

    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.ico') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <x-lumina.colors />
</head>

<body class="bg-[#FDFBF7] text-slate-900 font-sans antialiased min-h-screen flex flex-col">
@if (!$hideNavbar)
<x-navbar :showSearch="$showSearch" />
@endif

<main class="flex-grow">
    {{ $slot }}
</main>

<x-user.footer />


</body>
</html>
