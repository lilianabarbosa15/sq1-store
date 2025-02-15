@if ($paginator->hasPages())
    @php
        // Window size: number of pages to display
        $window = 3;
        $currentPage = $paginator->currentPage();
        $totalPages = $paginator->lastPage();
        // Calculate the start of the window: each group of 3 pages.
        $windowStart = (int)(floor(($currentPage - 1) / $window) * $window) + 1;
        $windowEnd = min($windowStart + $window - 1, $totalPages);
    @endphp
    <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center justify-center space-x-2">
    
        {{-- If there is a previous window, display a link to go to the previous group --}}
        @if ($windowStart > 1)
            @php
                $prevWindowPage = $windowStart - 1;
            @endphp
            <a href="{{ $paginator->url($prevWindowPage) }}"
               class="inline-flex items-center justify-center w-7 h-7 text-black rounded-full hover:bg-primary-600/20"
               title="Previous pages">
                &laquo;
            </a>
        @endif

        {{-- Display the pages of the current window --}}
        @for ($page = $windowStart; $page <= $windowEnd; $page++)
            @if ($page == $currentPage)
                <span class="inline-flex items-center justify-center w-7 h-7 text-black bg-primary-400 rounded-full">
                    {{ $page }}
                </span>
            @else
                <a href="{{ $paginator->url($page) }}"
                   class="inline-flex items-center justify-center w-7 h-7 text-black rounded-full hover:bg-primary-600/20">
                    {{ $page }}
                </a>
            @endif
        @endfor

        {{-- If there is a next window, display a link to go to the next group --}}
        @if ($windowEnd < $totalPages)
            @php
                $nextWindowPage = $windowEnd + 1;
            @endphp
            <a href="{{ $paginator->url($nextWindowPage) }}"
               class="inline-flex items-center justify-center w-7 h-7 text-black rounded-full hover:bg-primary-600/20"
               title="Next pages">
                &raquo;
            </a>
        @endif

    </nav>
@endif
