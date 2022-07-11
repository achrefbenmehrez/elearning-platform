@if ($paginator->hasPages())

    <div class="row">
        <div class="col-xl-12">
            <nav class="course-pagination mb-30" aria-label="Page navigation example">
                <ul class="pagination justify-content-start">
                    @if ($paginator->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <a class="page-link"><span class="ti-angle-left"></span></a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <a class="page-link" href="{{ $paginator->previousPageUrl() }}"><span class="ti-angle-left"></span></a>
                        </li>
                    @endif

                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="page-item active" aria-current="page">
                                        <a class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="page-item" aria-current="page">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($paginator->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><span class="ti-angle-right"></span></a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <a class="page-link" aria-hidden="true" href="#"><span class="ti-angle-right"></span></a>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endif
