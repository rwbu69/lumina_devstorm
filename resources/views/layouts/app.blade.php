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
