<ul class="library__nav cf">
    @foreach ($all as $id => $title)
        <li class="library__nav-item">
            <a href="{{ url('study/' . $id) }}" class="library__nav__btn @if ($id == $page->id) library__nav__btn--active @endif">{{ $id-1 }}.{{ $title }}</a>
        </li>
    @endforeach
</ul>