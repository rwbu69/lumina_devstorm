@props([
    'bodyClass' => 'p-6',
    'bodyStyle' => null,
    'noBody' => false,
])

<div {{ $attributes->merge(['class' => 'bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden']) }}>
    @isset($header)
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50">
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
        <div class="px-6 py-5 border-t border-slate-100 bg-slate-50/50">
            {{ $footer }}
        </div>
    @endisset
</div>
