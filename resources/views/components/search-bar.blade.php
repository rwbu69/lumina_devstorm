@props([
    'action',
    'placeholder' => 'Cari...',
    'value' => null,
])

@php
    $resolvedValue = $value ?? request()->query('q');
@endphp

<form method="GET" action="{{ $action }}" {{ $attributes->merge(['class' => '']) }}>
    <div class="flex flex-wrap gap-2">
        <div class="relative flex-grow min-w-[260px]">
            <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </span>
            <input
                type="search"
                name="q"
                class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-lumina-blue focus:border-lumina-blue outline-none transition-colors"
                placeholder="{{ $placeholder }}"
                value="{{ $resolvedValue }}"
                aria-label="Pencarian"
            />
        </div>

        <button type="submit" class="bg-lumina-blue hover:bg-blue-700 text-white font-medium py-2 px-5 rounded-lg transition-colors focus:ring-4 focus:ring-blue-300">
            Cari
        </button>
    </div>
</form>
