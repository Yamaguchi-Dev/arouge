@if ($paginator->hasPages())
					<ol>
            @if (!$paginator->onFirstPage())
						<li><a href="{{$paginator->previousPageUrl()}}">&lt;前へ</a></li>
            @endif
    @foreach ($elements as $element)
        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
						<li><a>{{$page}}</a></li>
                @else
						<li><a href="{{$url}}">{{$page}}</a></li>
                @endif
            @endforeach
        @endif
    @endforeach
            @if ($paginator->hasMorePages())
						<li><a href="{{$paginator->nextPageUrl()}}">次へ&gt;</a></li>
            @endif
					</ol>
@endif
