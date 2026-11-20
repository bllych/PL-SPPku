@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="relative z-10 flex flex-row flex-wrap items-center justify-center gap-2 select-none">
        {{-- Tombol Previous (-) --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white text-sm font-bold text-gray-300 shadow-sm cursor-not-allowed">
                ◀
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
               class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white text-sm font-bold text-gray-600 shadow-sm transition hover:bg-[#45C0F4] hover:text-white">
                ◀
            </a>
        @endif

        {{-- Angka Halaman (1 sampai lastPage) --}}
        @for ($page = 1; $page <= $paginator->lastPage(); $page++)
            @if ($page == $paginator->currentPage())
                <span aria-current="page"
                      class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-[#45C0F4] text-sm font-bold text-white shadow-sm">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $paginator->url($page) }}"
                   class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white text-sm font-semibold text-gray-600 shadow-sm transition hover:bg-sky-50 hover:text-[#45C0F4]">
                    {{ $page }}
                </a>
            @endif
        @endfor

        {{-- Tombol Next (+) --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"
               class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white text-sm font-bold text-gray-600 shadow-sm transition hover:bg-[#45C0F4] hover:text-white">
                ▶
            </a>
        @else
            <span class="inline-flex h-9 w-9 items-center justify-center rounded-lg bg-white text-sm font-bold text-gray-300 shadow-sm cursor-not-allowed">
                ▶
            </span>
        @endif
    </nav>
@endif