@props([
    'headers' => [],
])

@php
    $headers = is_array($headers) ? $headers : [];
    $colCount = max(count($headers), 1);
    $slotIsEmpty = trim((string) $slot) === '';
@endphp

<div class="card bg-white shadow-sm border-0 rounded-4 table-enter-animate {{ $attributes->get('class') }}">
    @isset($header)
        <div class="card-body pb-0">
            {{ $header }}
        </div>
    @endisset

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0 border-0">
        <thead style="background-color: #F8FAFC;">
            @isset($head)
                {{ $head }}
            @else
                <tr>
                    @foreach ($headers as $header)
                        <th class="px-4 py-3 text-uppercase text-muted fw-bold border-0" style="background-color: #F8FAFC; font-size: 0.75rem; letter-spacing: 1px;">{{ $header }}</th>
                    @endforeach
                </tr>
            @endisset
        </thead>

        <tbody style="background-color: #F8FAFC;">
            @if ($slotIsEmpty)
                <tr>
                    <td colspan="10" class="px-3 py-4 text-center" style="background-color: #F8FAFC;">
                        @isset($emptyState)
                            {{ $emptyState }}
                        @else
                            <div class="text-center py-4">
                                <i class="bi bi-inbox fs-1 text-secondary opacity-50"></i>
                                <div class="fw-bold mt-3 text-dark fs-5">Data belum tersedia</div>
                                <div class="text-muted mt-1">Coba ubah filter atau tambahkan data baru.</div>
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
        <div class="p-3 border-top" style="background-color: #F8FAFC;">
            {{ $pagination }}
        </div>
    @endisset
</div>
