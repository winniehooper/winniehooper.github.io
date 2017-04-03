<div class="projects__bg bg--all">
    <div class="projects__head">
        <ul class="nb-cat-itemlist">
            <li class="nb-cat-item @if(!$active_category) nb-cat-item--active @endif">
                <a data-filter="all" href="/projects" class="nb-cat-item__link ajax-categories-control">
                    <span class="nb-cat-item__txt">Все</span>
                    <span class="nb-cat-item__qt">{{ $total }}</span>
                </a>
            </li>
            @foreach($categories as $category)
                <li class="nb-cat-item @if($active_category == $category->id) nb-cat-item--active @endif">
                    <a data-value="{{ $category->id }}" data-filter="category" href="/projects?filter={{ $active_filter }}&amp;category={{ $category->id }}"
                       class="ajax-categories-control nb-cat-item__link">
				        <span class="nb-cat-item__txt">{{ $category->title }}</span>
                        <span class="nb-cat-item__qq">{{ $category->projects_count }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>