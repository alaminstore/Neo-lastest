@if ($paginator->hasPages())
    <nav class="kreen-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="prev page-numbers disabled"><span class="fal fa-angle-left"></span></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="prev page-numbers"><span class="fal fa-angle-left"></span></a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-numbers current">{{ $page }}</span>
                    @else
                        <a class="page-numbers" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="fal fa-angle-right"></span></a></li>
        @else
            <span class="next page-numbers"><span class="fal fa-angle-right"></span></span>
        @endif
    </nav>
@endif
