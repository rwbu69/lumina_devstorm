@props([
    'status' => '',
])

@php
    $normalized = strtolower(trim((string) $status));

    $colors = match ($normalized) {
        'verified', 'selesai', 'approved', 'berhasil' => ['bg' => '#ECFDF5', 'text' => '#059669', 'dot' => '#10B981'],
        'pending', 'proses' => ['bg' => '#FFFBEB', 'text' => '#D97706', 'dot' => '#F59E0B'],
        'rejected', 'batal', 'cancelled', 'dibatalkan' => ['bg' => '#FEF2F2', 'text' => '#DC2626', 'dot' => '#EF4444'],
        default => ['bg' => '#F9FAFB', 'text' => '#6B7280', 'dot' => '#9CA3AF'],
    };

    $label = match ($normalized) {
<<<<<<< HEAD
        'verified', 'berhasil' => 'Berhasil',
        'pending', 'proses' => 'Proses',
        'cancelled', 'dibatalkan' => 'Dibatalkan',
=======
        'verified', 'approved', 'selesai' => 'Berhasil',
        'pending', 'proses' => 'Proses',
        'rejected', 'cancelled', 'batal' => 'Dibatalkan',
>>>>>>> e71cd57c4ed2d881c38b83c8049cbc5c9463f208
        default => $status !== '' ? $status : 'Status',
    };
@endphp

<span {{ $attributes->merge(['class' => 'rounded-pill px-3 py-2 fw-bold align-items-center d-inline-flex']) }} 
      style="background-color: {{ $colors['bg'] }} !important; color: {{ $colors['text'] }} !important; border: 1px solid rgba(0,0,0,0.1); font-size: 0.7rem; line-height: 1;">
    <span class="rounded-circle me-2" style="width: 6px; height: 6px; background-color: {{ $colors['dot'] }} !important; display: inline-block;"></span>
    <span style="color: {{ $colors['text'] }} !important;">{{ strtoupper($label) }}</span>
</span>
