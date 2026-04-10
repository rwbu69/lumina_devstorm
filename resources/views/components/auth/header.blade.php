@props([
    'title' => 'Masuk',
    'subtitle' => 'Selamat datang kembali',
])

<div class="text-center mb-4">
    <div class="d-inline-flex align-items-center justify-content-center rounded-circle bg-white shadow-sm mb-3" style="width:56px;height:56px;">
        <x-application-logo class="text-primary" style="width:26px;height:26px;" />
    </div>

    <h1 class="h4 fw-semibold text-primary mb-1">{{ $title }}</h1>
    <div class="text-secondary small">{{ $subtitle }}</div>
</div>
