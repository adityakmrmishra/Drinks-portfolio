@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="d-flex justify-content-between flex-fill">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="page-link disabled" aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span aria-hidden="true">&lsaquo;</span>
                </span>
            @else
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="{{ __('pagination.previous') }}">&lsaquo;</a>
            @endif

            {{-- Pagination Elements --}}
            <div>
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <span class="page-link disabled" aria-disabled="true"><span>{{ $element }}</span></span>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span class="page-link active" aria-current="page"><span>{{ $page }}</span></span>
                            @else
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            @endif
                        @endforeach
                    @endif
                @endforeach
            </div>

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="{{ __('pagination.next') }}">&rsaquo;</a>
            @else
                <span class="page-link disabled" aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span aria-hidden="true">&rsaquo;</span>
                </span>
            @endif
        </div>
    </nav>
@endif
