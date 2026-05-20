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
        'danger' => 'btn-danger',
        'outline' => 'btn-outline-primary',
        'ghost' => 'btn-link text-decoration-none',
        default => 'btn-primary',
    };

    $sizeClass = match ($size) {
        'sm' => 'btn-sm',
        'lg' => 'btn-lg',
        default => '',
    };

    $baseClass = trim("btn {$variantClass} {$sizeClass}");
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
