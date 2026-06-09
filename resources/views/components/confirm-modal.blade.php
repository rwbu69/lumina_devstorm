@props([
    'name',
    'title' => 'Konfirmasi',
    'maxWidth' => 'md',
    'action',
    'method' => 'POST',
    'theme' => 'danger',
    'message' => 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
])

@php
    $method = strtoupper((string) $method);
    $theme = strtolower((string) $theme);

    $executeButtonClass = match ($theme) {
        'warning' => 'bg-amber-500 hover:bg-amber-600 focus:ring-amber-300',
        'danger' => 'bg-rose-600 hover:bg-rose-700 focus:ring-rose-300',
        default => 'bg-lumina-blue hover:bg-blue-700 focus:ring-blue-300',
    };

    $executeLabel = match ($theme) {
        'warning' => 'Ya, Lanjutkan',
        'danger' => 'Ya, Hapus',
        default => 'Ya, Eksekusi',
    };
@endphp

<x-modal :name="$name" :maxWidth="$maxWidth">
    <div class="p-6">
        <h2 class="text-lg font-bold text-slate-800 mb-4">
            {{ $title }}
        </h2>

        <div class="text-slate-600 mb-6">
            {{ $message }}
        </div>

        <div class="flex justify-end gap-3">
            <button type="button" x-on:click="$dispatch('close')" class="px-4 py-2 bg-white border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 font-medium transition-colors focus:ring-4 focus:ring-slate-100">
                Batal
            </button>

            <form action="{{ $action }}" method="POST" class="inline-block">
                @csrf
                @if (!in_array($method, ['GET', 'POST'], true))
                    @method($method)
                @endif

                <button type="submit" class="px-4 py-2 text-white rounded-lg font-medium transition-colors focus:ring-4 {{ $executeButtonClass }}">
                    {{ $executeLabel }}
                </button>
            </form>
        </div>
    </div>
</x-modal>
