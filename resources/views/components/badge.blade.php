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

    $label = $status !== '' ? $status : 'Status';
@endphp

<span {{ $attributes->merge(['class' => 'badge text-bg-'.$variant]) }}>
    {{ $label }}
</span>
