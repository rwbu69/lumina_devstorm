@props([
    'headers' => [],
])

@php
    $headers = is_array($headers) ? $headers : [];
    $colCount = max(count($headers), 1);
    $slotIsEmpty = trim((string) $slot) === '';
@endphp

<div {{ $attributes->merge(['class' => 'card lm-card rounded-4']) }}>
    @isset($header)
        <div class="card-body pb-0">
            {{ $header }}
        </div>
    @endisset

    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr class="text-uppercase small text-secondary">
                    @foreach ($headers as $header)
                        <th class="fw-semibold">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody>
                @if ($slotIsEmpty)
                    <tr>
                        <td colspan="{{ $colCount }}" class="py-5">
                            @isset($emptyState)
                                {{ $emptyState }}
                            @else
                                <div class="text-center">
                                    <div class="fw-semibold">Data belum tersedia</div>
                                    <div class="text-secondary small">Coba ubah filter atau tambahkan data baru.</div>
                                </div>
                            @endisset
                        </td>
                    </tr>
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>

    @isset($pagination)
        <div class="card-body pt-3">
            {{ $pagination }}
        </div>
    @endisset
</div>
