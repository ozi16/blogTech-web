@if ($paginator->hasPages())
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            <div class="single-wrap d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-start">
                        <!-- Tombol Previous -->
                        @if ($paginator->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" href="#"><span class="flaticon-arrow roted"></span></a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->previousPageUrl() }}">
                                    <span class="flaticon-arrow roted"></span>
                                </a>
                            </li>
                        @endif

                        <!-- Nomor Halaman -->
                        @foreach ($elements as $element)
                            @if (is_string($element))
                                <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <li class="page-item active">
                                            <a class="page-link" href="#">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ str_pad($page, 2, '0', STR_PAD_LEFT) }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        <!-- Tombol Next -->
                        @if ($paginator->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $paginator->nextPageUrl() }}">
                                    <span class="flaticon-arrow right-arrow"></span>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" href="#"><span class="flaticon-arrow right-arrow"></span></a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
@endif
