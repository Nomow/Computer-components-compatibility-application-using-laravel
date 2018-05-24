
@if ($paginator->lastPage() > 1)
    <ul class="pagination">
    @if ($paginator->currentPage() >= 4 && $paginator->lastPage() >= 6)
<li>
            <a href="{{ $paginator->url(1) }}">1</a>
            </li>

    @endif
     @if($paginator->currentPage() >= 5 && $paginator->lastPage() >=7) <li class="divider"><span>&middot;</span> </li> @endif
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
$from = $paginator->currentPage() - 3;
$to = $paginator->currentPage() + 3;
if ($paginator->currentPage() < 3) {
    $to += 3 - $paginator->currentPage();
}
if ($paginator->lastPage() - $paginator->currentPage() < 3) {
    $from -= 3 - ($paginator->lastPage() - $paginator->currentPage()) - 1;
}
?>
            @if ($from < $i && $i < $to)
                <li class="{{ ($paginator->currentPage() == $i) ? ' active' : '' }}"><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
            @endif
        @endfor
        @if ($paginator->currentPage()+4 <= $paginator->lastPage() &&  $paginator->lastPage() >=7) <li class="divider"><span>&middot;</span></li> @endif
         @if ($paginator->currentPage()+3 <= $paginator->lastPage() &&  $paginator->lastPage() >=6)
        <li>
            <a href="{{ $paginator->url($paginator->lastPage()) }}">{{$paginator->lastPage()}}</a>
        </li>
        @endif
    </ul>
@endif

