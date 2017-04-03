<section class="projects-page" id="projects-page">
    @include('projects.parts.categories')
    <div class="projects__inner">
        <div class="projects__content projects__content--empty">
            <div class="projects-dd-toggle-wrap--small js-dd-select-box js-projects-box">
                <div class="nb-dd-toggle--small js-toggle-dd">
                    <span class="nb-dd-toggle-txt--small"><h2 class="projects__heading js-toggle-dd-txt">{{ $filters[$active_filter] }}</h2></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-first-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9"><path fill-rule="evenodd" d="M12.003 1L6.502 6.592 1 1" class="cls-arrow--down"></path><path visibility="hidden" fill-rule="evenodd" d="M.992 6.606l5.501-5.592 5.502 5.592" class="cls-arrow--up"></path></svg>
                </div>
                <ul class="nb-dd--small nb-dd--hidden js-dd-menu">
                    @foreach($filters as $name => $filter)
                        <li class="nb-dd-item--small">
                            <a data-value="" data-filter="{{ $name }}" data-category-id="" href="/projects?filter={{ $name }}" class="dd-item-link--small ajax-categories-filter-control js-dd-menu-item @if ($name == $active_filter) dd-item-link--selected @endif">
                                {{ $filter }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="project-list">
                @if (count($projects))
                <div class="projects__list cf">
                    @include('projects.list')
                </div>
                @else
                    <div class="projects__message">
                        <h3 class="nb-heading--large projects__message__heading">
                            В этой категории пока нет ни одного проекта						</h3>
                        <p class="projects__message__txt">Если у вас есть идея и стремление создать что-то новое в этой сфере, вы сможете найти поддержку, создав проект.</p>
                        <button class="nb-btn nb-btn--more projects__btn--more" onclick="location.href='/project/create/info'">Создать проект
                            <svg class="btn__right-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="9" height="14" viewBox="0 0 9 14">
                                <path d="M1.706,1.282 L7.365,6.941 L1.706,12.6" class="cls-more-arrow-F" fill-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
            @if ($more)
            <div class="projects__more">
                <a class="divider__btn-ghost js-get-projects-by-page-num" href="javascript:void(0)" onclick="getProjectsByPageNum(this);">Показать больше проектов</a>
            </div>
            @endif
        </div>
    </div>
</section>
