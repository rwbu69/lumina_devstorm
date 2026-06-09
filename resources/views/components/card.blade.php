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
        default => 'shadow-md',
    };

    $hoverClass = $hover ? 'hover:shadow-lg hover:-translate-y-1 transition-all duration-300' : '';

    $cardClass = trim("bg-white border border-slate-200 rounded-2xl overflow-hidden flex flex-col {$shadowClass} {$hoverClass}");
@endphp

<div {{ $attributes->merge(['class' => $cardClass]) }}>
    @if ($layout === 'horizontal')
        <div class="flex flex-col md:flex-row h-full">
            @isset($header)
                <div class="md:w-64 shrink-0">
                    <div class="aspect-[4/3] md:aspect-auto md:h-full bg-slate-100 relative overflow-hidden">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <div class="flex flex-col flex-grow">
                @isset($body)
                    <div class="p-5 md:p-6 flex-grow">
                        {{ $body }}
                    </div>
                @else
                    <div class="p-5 md:p-6 flex-grow">
                        {{ $slot }}
                    </div>
                @endisset

                @isset($footer)
                    <div class="px-5 md:px-6 py-4 bg-slate-50 border-t border-slate-100 mt-auto">
                        {{ $footer }}
                    </div>
                @endisset
            </div>
        </div>
    @else
        @isset($header)
            <div class="aspect-[4/3] bg-slate-100 relative overflow-hidden">
                {{ $header }}
            </div>
        @endisset

        @isset($body)
            <div class="p-5 md:p-6 flex-grow">
                {{ $body }}
            </div>
        @else
            <div class="p-5 md:p-6 flex-grow">
                {{ $slot }}
            </div>
        @endisset

        @isset($footer)
            <div class="px-5 md:px-6 py-4 bg-slate-50 border-t border-slate-100 mt-auto">
                {{ $footer }}
            </div>
        @endisset
    @endif
</div>
