@props([
    'bodyClass' => 'card-body',
    'bodyStyle' => null,
    'noBody' => false,
])

<div {{ $attributes->merge(['class' => 'card lm-card rounded-4 bg-white']) }}>
    @isset($header)
        <div class="card-header border-0 ">
            {{ $header }}
        </div>
    @endisset

    @if ($noBody)
        {{ $slot }}
    @else
        <div class="{{ $bodyClass }}" @if(!is_null($bodyStyle) && $bodyStyle !== '') style="{{ $bodyStyle }}" @endif>
            {{ $slot }}
        </div>
    @endif

    @isset($footer)
        <div class="card-footer bg-transparent border-0">
            {{ $footer }}
        </div>
    @endisset
</div>
