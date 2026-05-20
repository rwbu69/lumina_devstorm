@props([
    'title' => 'Masuk',
    'subtitle' => 'Selamat datang kembali',
])

<div class="text-center mb-4">
    <div class="d-inline-flex align-items-center justify-content-center mb-3">
        <img src="{{ asset('assets/img/lumina.jpeg') }}" alt="Lumina Logo" style="width: 80px; height: 80px; object-fit: contain;">
    </div>

    <h1 class="h2 fw-bold text-primary mb-1" style="color: #2b4ea1 !important;">{{ $title }}</h1>
    <div class="text-secondary opacity-75">{{ $subtitle }}</div>
</div>
