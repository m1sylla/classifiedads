<?php
// config
$link_limit = 10; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination ad-pagination">
        <li class="mx-1 border" style="{{ ($paginator->currentPage() == 1) ? 'display:none;' : '' }}">
            <a class="text-decoration-none d-inline-block px-3 py-2" href="{{ $paginator->url(1) }}">Début</a>
        </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
                $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="mx-1 border {{ ($paginator->currentPage() == $i) ? ' active' : '' }}">
                    <a class="text-decoration-none d-inline-block px-3 py-2" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="mx-1 border" style="{{ ($paginator->currentPage() == $paginator->lastPage()) ? 'display:none;' : '' }}">
            <a class="text-decoration-none d-inline-block px-3 py-2 " href="{{ $paginator->url($paginator->lastPage()) }}">Fin</a>
        </li>
    </ul>
@endif