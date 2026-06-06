@props([
    'title' => 'Halaman',
    'subtitle' => null,
])

<div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
    <div>
        <h1 class="text-3xl font-serif font-bold text-lumina-blue mb-1.5">{{ $title }}</h1>
        @if ($subtitle)
            <div class="text-slate-500 font-medium">{{ $subtitle }}</div>
        @endif
    </div>

    <div class="flex items-center gap-3">
        {{ $slot }}
    </div>
</div>
