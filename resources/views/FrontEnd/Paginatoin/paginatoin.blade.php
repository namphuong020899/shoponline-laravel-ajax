@if ($paginator->hasPages())
    <!-- Pagination -->
    <div class="paginatoin-area">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <p>Showing {{$paginator->currentPage()}}-{{$paginator->lastPage()}} of {{$paginator->lastPage()}} item(s)</p>
            </div>
            <div class="col-lg-6 col-md-6">
                <ul class="pagination-box">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li class="Previous">
                            <a><i class="fa fa-chevron-left"></i> Previous</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}">
                                <span><i class="fa fa-chevron-left"></i></span> Previous
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="active"><a>{{ $page }}</a></li>
                                @elseif (($page == $paginator->currentPage() + 1 || $page == $paginator->currentPage() + 2) || $page == $paginator->lastPage())
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @elseif ($page == $paginator->lastPage() - 1)
                                    <li class="disabled"><a><i class="fa fa-ellipsis-h"></i></a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}"> Next
                                <span><i class="fa fa-chevron-right"></i></span>
                            </a>
                        </li>
                    @else
                        <li class="disabled"> Next
                            <span><i class="fa fa-chevron-right"></i></span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <!-- Pagination -->
@endif