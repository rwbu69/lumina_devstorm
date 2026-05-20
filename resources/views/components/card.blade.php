@props([
    'layout' => 'vertical',
    'shadow' => 'regular',
    'hover' => false,
])

@php
    $layout = strtolower((string) $layout);
    $shadow = strtolower((string) $shadow);

    $shadowClass = match ($shadow) {
        'none' => '',
        'sm' => 'shadow-sm',
        default => 'shadow',
    };

    $hoverClass = $hover ? 'lm-card-hover' : '';

    $cardClass = trim("card border-0 {$shadowClass} {$hoverClass}");
@endphp

<style>
    .lm-card-hover { transition: box-shadow .18s ease, transform .18s ease; }
    .lm-card-hover:hover { transform: translateY(-2px); }
</style>

<div {{ $attributes->merge(['class' => $cardClass]) }}>
    @if ($layout === 'horizontal')
        <div class="d-flex flex-column flex-md-row">
            @isset($header)
                <div class="flex-shrink-0" style="width: 260px;">
                    <div class="ratio ratio-4x3 overflow-hidden rounded-top rounded-md-start rounded-md-top-0">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <div class="flex-grow-1">
                @isset($body)
                    <div class="card-body">
                        {{ $body }}
                    </div>
                @else
                    <div class="card-body">
                        {{ $slot }}
                    </div>
                @endisset

                @isset($footer)
                    <div class="card-footer bg-white border-0 pt-0">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </div>
    @else
        @isset($header)
            <div class="ratio ratio-4x3 overflow-hidden rounded-top">
                {{ $header }}
            </div>
        @endisset

        @isset($body)
            <div class="card-body">
                {{ $body }}
            </div>
        @else
            <div class="card-body">
                {{ $slot }}
            </div>
        @endisset

        @isset($footer)
            <div class="card-footer bg-white border-0 pt-0">
                {{ $footer }}
            </div>
        @endisset
    @endif
</div>
