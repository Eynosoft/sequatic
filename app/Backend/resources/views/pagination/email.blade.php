@if ($paginator->hasPages())
<ul class="list-unstyled inbox-pagination">
    <li><span>{{$paginator->firstItem()}}-{{$paginator->lastItem()}} of {{$paginator->total()}}</span></li>
     {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
    <li class="disabled">
        <a class="np-btn" href=""><i class="fa fa-angle-left  pagination-left"></i></a>
    </li>
    @else
    <li>
        <a class="np-btn" href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-left  pagination-left"></i></a>
    </li>
    @endif
     {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
     <li>
        <a class="np-btn" href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-right pagination-right"></i></a>
    </li>
    @else
    <li class="disabled">
        <a class="np-btn" href=""><i class="fa fa-angle-right pagination-right"></i></a>
    </li>
    @endif
</ul>
@endif
