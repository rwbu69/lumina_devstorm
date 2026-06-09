@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">

        {{-- Mobile Pagination (Prev/Next) --}}
        <div class="flex flex-1 justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-slate-50 border border-slate-200 cursor-not-allowed rounded-xl">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-colors">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-700 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-colors">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-slate-400 bg-slate-50 border border-slate-200 cursor-not-allowed rounded-xl">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        {{-- Desktop Pagination --}}
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-slate-500 font-medium">
                    {!! __('Menampilkan') !!}
                    @if ($paginator->firstItem())
                        <span class="font-bold text-slate-700">{{ $paginator->firstItem() }}</span>
                        {!! __('hingga') !!}
                        <span class="font-bold text-slate-700">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('dari') !!}
                    <span class="font-bold text-indigo-600">{{ $paginator->total() }}</span>
                    {!! __('buku') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-xl border border-slate-200 bg-white overflow-hidden">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-300 bg-slate-50 border-r border-slate-200 cursor-not-allowed" aria-hidden="true">
                                <x-heroicon-o-chevron-left class="size-4" />
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-500 bg-white border-r border-slate-200 hover:bg-slate-50 hover:text-slate-700 transition-colors" aria-label="{{ __('pagination.previous') }}">
                            <x-heroicon-o-chevron-left class="size-4" />
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-400 bg-white border-r border-slate-200 cursor-default">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-lumina-blue border-r border-lumina-blue cursor-default">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-slate-600 bg-white border-r border-slate-200 hover:bg-slate-50 hover:text-lumina-blue transition-colors" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-500 bg-white hover:bg-slate-50 hover:text-slate-700 transition-colors" aria-label="{{ __('pagination.next') }}">
                            <x-heroicon-o-chevron-right class="size-4" />
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-slate-300 bg-slate-50 cursor-not-allowed" aria-hidden="true">
                                <x-heroicon-o-chevron-right class="size-4" />
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif
