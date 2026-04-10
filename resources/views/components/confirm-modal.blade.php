@props([
    'id',
    'title' => 'Konfirmasi',
    'size' => null,
    'action',
    'method' => 'POST',
    'theme' => 'danger',
    'message' => 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
])

@php
    $method = strtoupper((string) $method);
    $theme = strtolower((string) $theme);

    $executeButtonClass = match ($theme) {
        'warning' => 'btn-warning',
        'danger' => 'btn-danger',
        default => 'btn-primary',
    };

    $executeLabel = match ($theme) {
        'warning' => 'Ya, Lanjutkan',
        'danger' => 'Ya, Hapus',
        default => 'Ya, Eksekusi',
    };
@endphp

<x-modal :id="$id" :title="$title" :size="$size">
    <div class="text-secondary">
        {{ $message }}
    </div>

    <x-slot:footer>
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>

        <form action="{{ $action }}" method="POST" class="d-inline">
            @csrf
            @if (!in_array($method, ['GET', 'POST'], true))
                @method($method)
            @endif

            <button type="submit" class="btn {{ $executeButtonClass }}">
                {{ $executeLabel }}
            </button>
        </form>
    </x-slot:footer>
</x-modal>
