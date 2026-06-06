@props([
    'headers' => [],
])

@php
    $headers = is_array($headers) ? $headers : [];
    $colCount = max(count($headers), 1);
    $slotIsEmpty = trim((string) $slot) === '';
@endphp

<div {{ $attributes->merge(['class' => 'bg-white border border-slate-200 shadow-sm rounded-3xl overflow-hidden flex flex-col']) }}>
    @isset($header)
        <div class="px-6 py-5 border-b border-slate-100 bg-white">
            {{ $header }}
        </div>
    @endisset

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/80 border-b border-slate-200">
                @isset($head)
                    {{ $head }}
                @else
                    <tr>
                        @foreach ($headers as $header)
                            <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">{{ $header }}</th>
                        @endforeach
                    </tr>
                @endisset
            </thead>

            <tbody class="divide-y divide-slate-100 bg-white">
                @if ($slotIsEmpty)
                    <tr>
                        <td colspan="10" class="px-6 py-12 text-center">
                            @isset($emptyState)
                                {{ $emptyState }}
                            @else
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                                        <x-heroicon-o-inbox class="size-10 text-slate-300" />
                                    </div>
                                    <div class="font-bold text-slate-800 text-lg mb-1">Data belum tersedia</div>
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
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 mt-auto">
            {{ $pagination }}
        </div>
    @endisset
</div>
