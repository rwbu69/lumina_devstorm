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
            'label' => 'Kelola User',
            'icon' => 'bi-people',
            'route' => 'admin.users.index',
            'active' => request()->routeIs('admin.users.*'),
        ],
    ];
@endphp

{{-- Alpine Component for Sidebar --}}
<div x-data="{ sidebarOpen: false }">
    {{-- Mobile: top bar --}}
    <nav class="bg-white border-b border-slate-200 lg:hidden flex items-center justify-between px-4 py-3 sticky top-0 z-40">
        <button @click="sidebarOpen = true" class="text-slate-500 hover:text-lumina-blue focus:outline-none focus:ring-2 focus:ring-lumina-blue/20 rounded-lg p-1 transition-colors">
            <x-heroicon-o-bars-3 class="size-8" />
        </button>

        <a class="font-semibold flex items-center gap-2 text-slate-800" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/logolumina.svg') }}" class="w-6 h-6" alt="Logo" />
            Lumina Media
        </a>

        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="text-slate-500 hover:text-rose-500 focus:outline-none p-1 transition-colors">
                <x-heroicon-o-arrow-right-on-rectangle class="size-6" />
            </button>
        </form>
    </nav>

    {{-- Mobile: Offcanvas Sidebar --}}
    <div x-show="sidebarOpen" style="display: none;" class="fixed inset-0 z-50 lg:hidden" aria-modal="true">
        {{-- Backdrop --}}
        <div x-show="sidebarOpen" x-transition.opacity class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm" @click="sidebarOpen = false"></div>

        {{-- Sidebar Panel --}}
        <div x-show="sidebarOpen" 
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="-translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="-translate-x-full"
             class="fixed inset-y-0 left-0 w-72 max-w-[80vw] bg-white shadow-xl flex flex-col">
             
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                <h5 class="font-bold text-slate-800">Menu Admin</h5>
                <button type="button" @click="sidebarOpen = false" class="text-slate-400 hover:text-rose-500 p-1 transition-colors">
                    <x-heroicon-o-x-mark class="size-5" />
                </button>
            </div>
            
            <div class="p-6">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-lumina-blue/10 flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/logolumina.svg') }}" class="w-7 h-7" alt="Logo" />
                    </div>
                    <div>
                        <div class="font-bold text-slate-800">Lumina Media</div>
                        <div class="text-xs font-semibold text-lumina-blue tracking-wider uppercase mt-0.5">Admin Panel</div>
                    </div>
                </div>
            </div>

            <div class="px-4 flex-1 overflow-y-auto">
                <div class="space-y-1">
                    @foreach ($menu as $item)
                        <a href="{{ route($item['route']) }}" 
                           class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold transition-all {{ $item['active'] ? 'bg-lumina-blue text-white shadow-sm' : 'text-slate-600 hover:bg-slate-50 hover:text-lumina-blue' }}">
                            <i class="bi {{ $item['icon'] }} text-lg"></i>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="p-6 border-t border-slate-100 mt-auto">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-slate-200 text-slate-600 font-bold hover:border-rose-500 hover:text-rose-500 hover:bg-rose-50 transition-all">
                        <x-heroicon-o-arrow-right-on-rectangle class="size-5" />
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Desktop: Fixed Sidebar --}}
    <aside class="hidden lg:flex flex-col w-72 bg-white border-r border-slate-200 fixed inset-y-0 left-0 z-30 shadow-[4px_0_24px_rgba(0,0,0,0.02)]" x-data="{ collapsed: false }" :class="collapsed ? 'w-24' : 'w-72'" style="transition: width 0.3s ease;">
        <div class="p-6">
            <div class="flex items-center justify-between gap-2">
                <div class="flex items-center gap-4 overflow-hidden">
                    <div class="w-12 h-12 rounded-full bg-lumina-blue/10 flex items-center justify-center shrink-0">
                        <img src="{{ asset('images/logolumina.svg') }}" class="w-7 h-7" alt="Logo" />
                    </div>
                    <div class="shrink-0 transition-opacity duration-300" :class="collapsed ? 'opacity-0 w-0' : 'opacity-100'">
                        <div class="font-bold text-slate-800 text-lg">Lumina Media</div>
                        <div class="text-xs font-semibold text-lumina-blue tracking-wider uppercase mt-0.5">Admin Panel</div>
                    </div>
                </div>
                {{-- Uncomment if you want desktop collapse functionality --}}
                {{-- <button @click="collapsed = !collapsed" class="text-slate-400 hover:text-lumina-blue p-1 transition-colors">
                    <x-heroicon-o-bars-3-bottom-left class="size-5" />
                </button> --}}
            </div>
        </div>

        <div class="px-4 flex-1 overflow-y-auto mt-4">
            <div class="space-y-1.5">
                @foreach ($menu as $item)
                    <a href="{{ route($item['route']) }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold transition-all group {{ $item['active'] ? 'bg-lumina-blue text-white shadow-md shadow-blue-500/20' : 'text-slate-500 hover:bg-slate-50 hover:text-lumina-blue' }}"
                       :title="collapsed ? '{{ $item['label'] }}' : ''">
                        <i class="bi {{ $item['icon'] }} text-xl {{ $item['active'] ? '' : 'group-hover:scale-110 transition-transform' }}"></i>
                        <span class="transition-opacity duration-300 whitespace-nowrap" :class="collapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>

        <div class="p-6 border-t border-slate-100 mt-auto">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 rounded-xl border-2 border-slate-100 text-slate-500 font-bold hover:border-rose-500 hover:text-rose-500 hover:bg-rose-50 transition-all group" :title="collapsed ? 'Logout' : ''">
                    <x-heroicon-o-arrow-right-on-rectangle class="size-6 group-hover:-translate-x-1 transition-transform" />
                    <span class="transition-opacity duration-300" :class="collapsed ? 'opacity-0 w-0 hidden' : 'opacity-100'">Logout</span>
                </button>
            </form>
        </div>
    </aside>
</div>
