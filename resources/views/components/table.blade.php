@props([
    'headers' => [],
])

@php
    $headers = is_array($headers) ? $headers : [];
    $colCount = max(count($headers), 1);
    $slotIsEmpty = trim((string) $slot) === '';
@endphp

<div {{ $attributes->merge(['class' => 'bg-white border border-slate-200 shadow-sm rounded-2xl overflow-hidden flex flex-col']) }}>
    @isset($header)
        <div class="px-5 py-4 border-b border-slate-100">
            {{ $header }}
        </div>
    @endisset

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    @foreach ($headers as $header)
                        <th class="px-5 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @if ($slotIsEmpty)
                    <tr>
                        <td colspan="{{ $colCount }}" class="py-12 px-5">
                            @isset($emptyState)
                                {{ $emptyState }}
                            @else
                                <div class="text-center">
                                    <div class="font-bold text-slate-700 text-lg mb-1">Data belum tersedia</div>
                                    <div class="text-slate-500 text-sm">Coba ubah filter atau tambahkan data baru.</div>
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
        <div class="px-5 py-4 border-t border-slate-100 bg-white">
            {{ $pagination }}
        </div>
    @endisset
</div>
