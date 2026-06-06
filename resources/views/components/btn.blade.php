@props([
    'variant' => 'primary',
    'size' => null,
    'type' => 'button',
    'disabled' => false,
    'href' => null,
])

@php
    $variant = strtolower((string) $variant);
    $size = $size ? strtolower((string) $size) : null;

    $variantClass = match ($variant) {
        'danger' => 'bg-rose-600 hover:bg-rose-700 text-white',
        'outline' => 'bg-transparent border-2 border-lumina-blue text-lumina-blue hover:bg-lumina-blue hover:text-white',
        'ghost' => 'bg-transparent text-lumina-blue hover:bg-slate-50',
        default => 'bg-lumina-blue hover:opacity-90 text-white shadow-sm hover:shadow-md',
    };

    $sizeClass = match ($size) {
        'sm' => 'px-3 py-1.5 text-xs',
        'lg' => 'px-6 py-3 text-lg',
        default => 'px-4 py-2 text-sm',
    };

    $baseClass = trim("inline-flex items-center justify-center font-bold rounded-xl transition-all disabled:opacity-50 disabled:cursor-not-allowed {$variantClass} {$sizeClass}");
@endphp

@if ($href)
    <a {{ $attributes->merge(['class' => $baseClass]) }} href="{{ $href }}" role="button" @ariaDisabled($disabled)>
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['class' => $baseClass]) }}
        type="{{ $type }}"
        @disabled($disabled)
    >
        {{ $slot }}
    </button>
@endif
