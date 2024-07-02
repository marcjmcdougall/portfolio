@if ($paginator->hasPages())
    <ul class="pagination normalize-list list--horizontal">
        @foreach ($elements as $element)
            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="pagination__item pagination__item--active"><span>{{ $page }}</span></li>
                    @else
                        <li class="pagination__item"><a href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="pagination__item"><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a></li>
            @else
                <li class="disabled pagination__item--disabled"><span>Next</span></li>
            @endif
        @endforeach
    </ul>
@endif