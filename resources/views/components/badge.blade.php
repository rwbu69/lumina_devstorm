@props([
    'status' => '',
])

@php
    $normalized = strtolower(trim((string) $status));

    $variant = match ($normalized) {
        'verified', 'selesai', 'approved' => 'success',
        'pending', 'proses' => 'warning',
        'rejected', 'batal', 'cancelled' => 'danger',
        default => 'secondary',
    };

    $label = match ($normalized) {
        'verified', 'approved', 'selesai' => 'Berhasil',
        'pending', 'proses' => 'Proses',
        'rejected', 'cancelled', 'batal' => 'Dibatalkan',
        default => $status !== '' ? $status : 'Status',
    };
@endphp

<span {{ $attributes->merge(['class' => 'badge text-bg-'.$variant]) }}>
    {{ $label }}
</span>
