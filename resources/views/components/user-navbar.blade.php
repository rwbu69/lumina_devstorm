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

<!-- Load Tailwind CSS & Alpine.js CDN to ensure flawless operation -->
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<nav class="bg-white border-b border-slate-200 sticky top-0 z-[1050] font-sans shadow-sm" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Left Side: Logo & Brand -->
            <div class="flex items-center space-x-6 flex-grow max-w-xl">
                <!-- Brand Logo & Teks -->
                <a class="flex items-center space-x-2 text-indigo-900 hover:text-indigo-700 transition-colors flex-shrink-0" href="{{ auth()->check() ? route('home') : route('welcome') }}">
                    <img src="{{ asset('images/logolumina.svg') }}" alt="Logo Lumina" class="w-8 h-8">
                    <span class="font-bold text-lg tracking-tight font-serif">Lumina Media</span>
                </a>
            </div>

            <!-- Right Side: Nav Links, Cart Icon, Profile Avatar -->
            <div class="flex items-center space-x-6">
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-6">
                    @auth
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Beranda</a>
                        <a href="{{ route('catalog.index') }}" class="{{ request()->routeIs('catalog.*') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Katalog</a>
                        <a href="{{ route('collection.index') }}" class="{{ request()->routeIs('collection.*') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Koleksi Saya</a>
                        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Kontak</a>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Tentang Kami</a>
                    @else
                        <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Beranda</a>
                        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Tentang Kami</a>
                        <a href="{{ route('kontak') }}" class="{{ request()->routeIs('kontak') ? 'text-indigo-600 font-semibold' : 'text-slate-600 hover:text-indigo-600 font-medium' }} text-sm transition-colors">Kontak</a>
                    @endauth
                </div>

                @auth
                <!-- Shopping Cart Icon -->
                <div class="relative" x-data="{ 
                    count: {{ session('cart') ? count(session('cart')) : 0 }}, 
                    animate: false,
                    showHover: false
                }"
                @cart-updated.window="count = $event.detail.count; animate = true; setTimeout(() => animate = false, 300); showHover = true; setTimeout(() => showHover = false, 3000)">
                    <a href="{{ route('cart.index') }}" 
                       @mouseenter="showHover = true" @mouseleave="showHover = false"
                       class="text-slate-500 hover:text-indigo-600 transition-all duration-300 relative p-1.5 rounded-xl hover:bg-slate-50 flex items-center justify-center"
                       :class="animate ? 'scale-125 text-indigo-600' : ''">
                        <i class="bi bi-cart3 text-xl"></i>
                        <template x-if="count > 0">
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-500 text-white text-[10px] font-bold flex items-center justify-center rounded-full border border-white shadow-sm transition-transform duration-300" x-text="count"
                                  :class="animate ? 'scale-150' : 'scale-100'"></span>
                        </template>
                    </a>
                    
                    <!-- Hover Menu / Notification -->
                    <div x-show="showHover && count > 0" 
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-2"
                         class="absolute right-0 top-full mt-2 w-48 bg-slate-800 text-white text-xs font-medium rounded-lg shadow-xl p-3 text-center z-50 pointer-events-none" style="display: none;">
                        Ada <span class="font-bold text-rose-400" x-text="count"></span> buku di keranjang Anda.
                        <div class="absolute -top-1 right-3 w-2 h-2 bg-slate-800 rotate-45"></div>
                    </div>
                </div>
                @endauth

                <!-- Profile & Dropdown -->
                <div class="relative">
                    @auth
                        <!-- Profile Button -->
                        <button @click="open = !open" @click.outside="open = false" class="flex items-center focus:outline-none group">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-indigo-700 text-white flex items-center justify-center font-bold text-sm tracking-wider shadow-md hover:shadow-indigo-200 ring-2 ring-indigo-100 hover:ring-indigo-400 group-hover:scale-105 transition-all duration-200">
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
                                <p class="text-xs text-indigo-600 font-medium truncate">&#64;{{ $username }}</p>
                            </div>
                            
                            <!-- Menu Items -->
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-50 text-sm font-medium transition-colors">
                                    <i class="bi bi-person me-3 text-slate-400"></i> Profil Saya
                                </a>
                                <a href="{{ route('collection.index') }}" class="flex items-center px-4 py-2.5 text-slate-700 hover:bg-slate-50 text-sm font-medium transition-colors">
                                    <i class="bi bi-journal-bookmark me-3 text-slate-400"></i> Buku Saya
                                </a>
                            </div>

                            <!-- Logout Button -->
                            <div class="border-t border-slate-100 py-1 bg-rose-50/10">
                                <form method="POST" action="{{ route('logout') }}" id="logout-form">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2.5 text-rose-600 hover:bg-rose-50 text-sm font-bold transition-colors text-left">
                                        <i class="bi bi-box-arrow-right me-3 text-rose-500"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <!-- Guest Options -->
                        <div class="flex items-center space-x-3">
                            <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-bold text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 rounded-xl transition-all">Masuk</a>
                        </div>
                    @endauth
                </div>

            </div>

        </div>
    </div>
</nav>
