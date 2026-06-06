@props([
    'title' => 'Masuk',
    'subtitle' => 'Selamat datang kembali',
])

<div class="text-center mb-8">
    <div class="inline-flex items-center justify-center mb-6">
        <img src="{{ asset('assets/img/lumina.jpeg') }}" alt="Lumina Logo" class="w-20 h-20 object-cover rounded-full">
    </div>

    <h1 class="text-3xl font-serif font-bold text-[#1e3a8a] mb-2 tracking-tight">{{ $title }}</h1>
    <div class="text-slate-500 text-[15px]">{{ $subtitle }}</div>
</div>
