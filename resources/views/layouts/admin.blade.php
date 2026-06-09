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
    
    <!-- Tailwind CSS (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <x-lumina.colors />

    @stack('styles')
</head>
<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen flex flex-col">

<!-- Sidebar component already has its own Alpine logic for mobile offcanvas and desktop fixed -->
<x-admin.sidebar />

<!-- Main content wrapper. 
     On lg screens (where sidebar is fixed block), we add pl-72 (padding-left 288px) to push content to the right. -->
<main class="flex-grow flex flex-col lg:pl-72 transition-all duration-300">
    <div class="w-full px-4 lg:px-8 py-6 flex-grow">
        {{ $slot }}
    </div>
</main>

<!-- Toast Notifications -->
<div class="fixed bottom-4 right-4 z-50 flex flex-col gap-2">
    @if(session('success'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.opacity.duration.500ms class="bg-emerald-50 text-emerald-700 border border-emerald-200 px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 w-80">
            <x-heroicon-s-check-circle class="size-6" />
            <span class="font-bold text-sm">{{ session('success') }}</span>
            <button @click="show = false" class="ml-auto text-emerald-500 hover:text-emerald-700"><x-heroicon-o-x-mark class="size-5" /></button>
        </div>
    @endif

    @if(session('error') || $errors->any())
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 5000)" x-show="show" x-transition.opacity.duration.500ms class="bg-rose-50 text-rose-700 border border-rose-200 px-4 py-3 rounded-xl shadow-lg flex items-center gap-3 w-80">
            <x-heroicon-s-exclamation-circle class="size-6" />
            <span class="font-bold text-sm">{{ session('error') ?? 'Terdapat kesalahan input form.' }}</span>
            <button @click="show = false" class="ml-auto text-rose-500 hover:text-rose-700"><x-heroicon-o-x-mark class="size-5" /></button>
        </div>
    @endif
</div>

@stack('scripts')
</body>
</html>
