@props([
    'title' => 'Halaman',
    'subtitle' => null,
])

<div class="d-flex align-items-start justify-content-between gap-3 flex-wrap">
    <div>
        <h1 class="h3 fw-bold mb-1">{{ $title }}</h1>
        @if ($subtitle)
            <div class="lm-muted">{{ $subtitle }}</div>
        @endif
    </div>

    <div class="d-flex align-items-center gap-2 ms-auto">
        {{ $slot }}
    </div>
</div>
