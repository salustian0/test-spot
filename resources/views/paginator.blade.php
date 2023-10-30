@if(isset($paginator) && $paginator->lastPage() > 1)
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item @if($paginator->currentPage() == 1) disabled @endif">
                <a class="page-link" href="?page={{$paginator->currentPage() - 1}}">
                    <i class="fas fa-angle-left"></i>
                </a>
            </li>
            @for($i = 1; $i <= $paginator->lastPage(); $i++)
                <li class="page-item @if($i == $paginator->currentPage()) active @endif">
                    <a class="page-link" href="?page={{$i}}">{{$i}}</a>
                </li>
            @endfor
            <li class="page-item @if($paginator->currentPage() == $paginator->lastPage()) disabled @endif">
                <a class="page-link" href="?page={{$paginator->currentPage() + 1}}">
                    <i class="fas fa-angle-right"></i>
                </a>
            </li>
        </ul>
    </nav>
@endif
