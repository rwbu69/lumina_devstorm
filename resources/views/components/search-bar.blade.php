@props([
    'action',
    'placeholder' => 'Cari...',
    'value' => null,
])

@php
    $resolvedValue = $value ?? request()->query('q');
@endphp

<form method="GET" action="{{ $action }}" {{ $attributes->merge(['class' => '']) }}>
    <div class="d-flex gap-2 flex-wrap">
        <div class="position-relative flex-grow-1" style="min-width: 260px;">
            <span class="position-absolute top-50 translate-middle-y" style="left: 14px; color: rgba(15, 23, 42, .55);">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true" focusable="false">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </span>
            <input
                type="search"
                name="q"
                class="form-control ps-5"
                placeholder="{{ $placeholder }}"
                value="{{ $resolvedValue }}"
                aria-label="Pencarian"
            />
        </div>

        <button type="submit" class="btn btn-primary">
            Cari
        </button>
    </div>
</form>
