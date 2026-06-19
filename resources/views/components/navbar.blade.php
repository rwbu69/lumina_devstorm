@props([
    'showSearch' => false,
])
@php
    $user = auth()->user();
    $name = $user->nama ?? $user->name ?? 'User';
    $username = $user->username ?? 'user';

    // Generate Initials
    $words = explode(' ', trim($name));
    $initials = '';
    if (count($words) >= 2) {
        $initials = strtoupper(substr($words[0], 0, 1) . substr($words[1], 0, 1));
    } else {
        $initials = strtoupper(substr($name, 0, 2));
    }
@endphp

<!-- We don't need CDN anymore because we will inject Vite into app.blade.php -->
<nav class="bg-white border-b border-slate-200 sticky top-0 z-[1050] font-sans shadow-sm" x-data="{ open: false, mobileMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left Side: Logo & Brand -->
            <div class="flex items-center space-x-6">
                <!-- Brand Logo & Teks -->
                <a class="flex items-center space-x-2 text-lumina-blue hover:text-blue-800 transition-colors flex-shrink-0" href="{{ auth()->check() ? route('home') : route('welcome') }}">
                    <span class="w-8 h-8 rounded-full bg-lumina-blue/10 flex items-center justify-center">
                        <x-heroicon-o-book-open class="text-lumina-blue size-6" />
                    </span>
                    <span class="font-bold text-lg tracking-tight font-serif text-slate-900">Lumina Media</span>
                </a>
            </div>

            <!-- Center: Search Bar (Desktop) -->
            @if($showSearch)
            <div class="hidden md:flex flex-1 max-w-md mx-6">
                <form action="{{ route('catalog.index') }}" method="GET" class="w-full relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <x-heroicon-o-magnifying-glass class="text-slate-400 size-5" />
                    </span>
                    <input type="text" name="q" placeholder="Cari buku..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-full text-sm focus:outline-none focus:border-lumina-blue focus:ring-1 focus:ring-lumina-blue transition-colors placeholder-slate-400 text-slate-900">
                </form>
            </div>
            @endif

            <!-- Right Side: Nav Links, Cart Icon, Profile Avatar -->
            <div class="flex items-center space-x-4 md:space-x-6">
                <!-- Navigation Links (Desktop) -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') || request()->routeIs('welcome') ? 'text-lumina-blue font-bold' : 'text-slate-600 hover:text-lumina-blue font-medium' }} text-sm transition-colors">Beranda</a>
                    <a href="{{ route('catalog.index') }}" class="{{ request()->routeIs('catalog.*') ? 'text-lumina-blue font-bold' : 'text-slate-600 hover:text-lumina-blue font-medium' }} text-sm transition-colors">Katalog</a>
                    <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-lumina-blue font-bold' : 'text-slate-600 hover:text-lumina-blue font-medium' }} text-sm transition-colors">Tentang Kami</a>
                    <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-lumina-blue font-bold' : 'text-slate-600 hover:text-lumina-blue font-medium' }} text-sm transition-colors">Kontak</a>
                </div>

                @auth
                <!-- Shopping Cart Icon -->
                <div class="relative hidden sm:block" x-data="{
                    count: {{ session('cart') ? count(session('cart')) : 0 }},
                    animate: false,
                    showHover: false
                }"
                @cart-updated.window="count = $event.detail.count; animate = true; setTimeout(() => animate = false, 300); showHover = true; setTimeout(() => showHover = false, 3000)">
                    <a href="{{ route('cart.index') }}"
                       @mouseenter="showHover = true" @mouseleave="showHover = false"
                       class="text-slate-500 hover:text-lumina-blue transition-all duration-300 relative p-2 rounded-xl hover:bg-slate-50 flex items-center justify-center"
                       :class="animate ? 'scale-125 text-lumina-blue' : ''">
                        <x-heroicon-o-shopping-cart class="size-6" />
                        <template x-if="count > 0">
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full border border-white shadow-sm transition-transform duration-300" x-text="count"
                                  :class="animate ? 'scale-150' : 'scale-100'"></span>
                        </template>
                    </a>
                </div>
                @endauth

                <!-- Profile & Dropdown -->
                <div class="relative hidden md:block">
                    @auth
                        <!-- Profile Button -->
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center focus:outline-none group">
                            <div class="w-9 h-9 rounded-full bg-lumina-blue text-white flex items-center justify-center font-bold text-sm tracking-wider shadow-sm ring-2 ring-transparent group-hover:ring-blue-200 transition-all duration-200">
                                {{ $initials }}
                            </div>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="absolute right-0 top-full mt-3 w-56 bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden z-[1050]"
                             style="display: none;">

                            <!-- Account Info -->
                            <div class="p-4 border-b border-slate-50 bg-slate-50/50">
                                <p class="text-[10px] font-bold text-slate-400 tracking-wider uppercase mb-0.5">Akun Saya</p>
                                <p class="font-bold text-slate-800 text-sm truncate">{{ $name }}</p>
                                <p class="text-xs text-lumina-blue font-medium truncate">&#64;{{ $username }}</p>
                            </div>

                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-lumina-blue text-sm font-medium transition-colors">
                                    <x-heroicon-o-user class="mr-3 text-slate-400 size-5" /> Profil Saya
                                </a>
                                <a href="{{ route('collection.index') }}" class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-50 hover:text-lumina-blue text-sm font-medium transition-colors">
                                    <x-heroicon-o-bookmark class="mr-3 text-slate-400 size-5" /> Buku Saya
                                </a>
                            </div>

                            <!-- Logout Button -->
                            <div class="border-t border-slate-100 py-1 bg-rose-50/10">
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2.5 text-rose-600 hover:bg-rose-50 text-sm font-bold transition-colors text-left">
                                        <x-heroicon-o-arrow-right-on-rectangle class="mr-3 text-rose-400 size-5" /> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Guest Options -->
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="px-5 py-2 text-sm font-bold text-white bg-lumina-blue hover:opacity-90 rounded-xl transition-all shadow-sm">Masuk</a>
                        </div>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden flex items-center p-2 text-slate-600 hover:text-lumina-blue hover:bg-slate-50 rounded-lg">
                    <i class="bi text-2xl" :class="mobileMenu ? 'bi-x' : 'bi-list'"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu Dropdown -->
    <div x-show="mobileMenu"
         x-transition.opacity
         class="md:hidden bg-white border-b border-slate-200 px-4 py-4 space-y-4"
         style="display: none;">

        @if($showSearch)
        <div class="mb-4">
            <form action="{{ route('catalog.index') }}" method="GET" class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <x-heroicon-o-magnifying-glass class="text-slate-400 size-5" />
                </span>
                <input type="text" name="q" placeholder="Cari buku..." class="w-full pl-10 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-lumina-blue">
            </form>
        </div>
        @endif

        <div class="flex flex-col space-y-3">
            <a href="{{ route('home') }}" class="text-slate-700 font-bold hover:text-lumina-blue">Beranda</a>
            <a href="{{ route('catalog.index') }}" class="text-slate-700 font-bold hover:text-lumina-blue">Katalog</a>
            <a href="{{ route('about') }}" class="text-slate-700 font-bold hover:text-lumina-blue">Tentang Kami</a>
            <a href="{{ route('kontak') }}" class="text-slate-700 font-bold hover:text-lumina-blue">Kontak</a>
        </div>

        <div class="border-t border-slate-100 pt-4 mt-4">
            @auth
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 rounded-full bg-lumina-blue text-white flex items-center justify-center font-bold">
                        {{ $initials }}
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-sm">{{ $name }}</p>
                        <p class="text-xs text-lumina-blue">&#64;{{ $username }}</p>
                    </div>
                </div>
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('profile.edit') }}" class="text-slate-600 text-sm font-medium"><x-heroicon-o-user class="mr-2 size-5" /> Profil Saya</a>
                    <a href="{{ route('collection.index') }}" class="text-slate-600 text-sm font-medium"><x-heroicon-o-bookmark class="mr-2 size-5" /> Buku Saya</a>
                    <a href="{{ route('cart.index') }}" class="text-slate-600 text-sm font-medium"><x-heroicon-o-shopping-cart class="mr-2 size-5" /> Keranjang</a>

                    <form method="POST" action="{{ route('logout') }}" class="mt-2">
                        @csrf
                        <button type="submit" class="text-rose-600 text-sm font-bold flex items-center"><x-heroicon-o-arrow-right-on-rectangle class="mr-2 size-5" /> Keluar</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="block text-center w-full px-5 py-2.5 text-sm font-bold text-white bg-lumina-blue rounded-xl">Masuk</a>
            @endauth
        </div>
    </div>
</nav>
