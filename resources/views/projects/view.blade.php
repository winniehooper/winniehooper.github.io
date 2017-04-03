@extends('layouts.main')

@section('title', $project->name ? $project->name : "Черновик проекта")


@section('content')
    <section class="project-page">
        <div class="project__inner">
            <div class="project__bg bg--music"></div>
            @if (!$project->status)
                <div class="preview-panel">
                    <div class="preview-panel__inner cf">
                        <div class="preview-panel__status">
                            <svg class="preview-panel__status__icon" xmlns="http://www.w3.org/2000/svg" width="16"
                                 height="12" viewBox="0 0 16 12">
                                <path fill="#FFF" fill-rule="evenodd"
                                      d="M8 4c0 1.1-.9 2-2 2 0 1.1.9 2 2 2s2-.9 2-2-.9-2-2-2zm0-4C3.9 0 0 4.65 0 6c0 1.35 3.9 6 8 6s8-4.65 8-6c0-1.35-3.9-6-8-6zm0 10c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"></path>
                            </svg>
                            <span class="preview-panel__status__txt">Вы находитесь в режиме предпросмотра</span>
                        </div>
                        <div class="preview-panel__links">
                            <a href="{{ route('project.update', $project->id) }}" class="preview-panel__link">
                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="11" viewBox="0 0 10 11">
                                    <path fill="#FFF" fill-rule="evenodd"
                                          d="M0 9.3c0 .36.3.7.7.7.23 0 2.87-.54 3.37-1.04l4.1-4.1-3.04-3.02-4.1 4.1C.53 6.44 0 9.06 0 9.28zM7.86 0c-.43 0-1.04.14-1.53.64l-.2.2 3.03 3.04.2-.2c.46-.46.64-1.04.64-1.54C10 .96 9.04 0 7.86 0z"></path>
                                </svg>
                                Вернуться к редактированию</a>
                        </div>
                    </div>
                </div>
            @endif

            <div class="project__head cf">
                <h1 class="project__heading--large"><span
                            class="project__heading--large__txt">{{ $project->name }}</span></h1>
            </div>
            <div class="project__body cf">
                <div class="project__body__main cf">
                    <div class="project__video">
                        @if ($project->video_url)
                            <div class="project__video__container project__video__container--hidden js-video-container" id="js-video-container" data-video-url="{{ $project->video_url }}?enablejsapi=1&html5=1"></div>
                            <div class="project__video__preview js-video-preview">
                                <div class="project__video__img-wrap">
                                    <img class="project__video-img" width="630" height="354" src="{{ $project->getVideoPreview() }}" alt="{{ $project->name }}">
                                </div>
                                <button type="button" class="project__video-link js-video-play">
                                    <svg class="project__video-icon" xmlns="http://www.w3.org/2000/svg" width="81" height="45" viewBox="0 0 81 45"><g fill="none" fill-rule="evenodd"><rect width="80" height="45" fill="#16B4C3" rx="3"/><path fill="#FFF" d="M34 30V16l14 7"/></g></svg>
                                    <span class="project__video-link-text">Смотреть видео</span>
                                </button>
                            </div>
                        @else
                            <div class="project__video__preview js-video-preview">
                                <div class="project__video__img-wrap">
                                    <img class="project__video-img" width="630" height="354" src="{{ $project->getImageUrl('promo') }}" alt="{{ $project->name }}">
                                </div>
                            </div>
                        @endif

                    </div>

                    <aside class="project__aside">

                        <div class="project__aside-body">
                            <div class="stats">
                                <div class="stats-item">
                                    <strong class="stats-item__strong">{{ $project->sponsors_count }}</strong>
                                    <div class="stats-item__caption">спонсоров</div>
                                </div>
                                <div class="stats-item">
		<span class="stats-item__sum">
			<strong class="stats-item__strong stats-item__strong--sum">{{ $project->collected_sum }}</strong>
			<span class="stats-item__currency">BYN</span>
			<sup class="stats-item__percentage">{{ $project->percent }}%</sup>
		</span>
                                    <div class="stats-item__caption"> Необходимо {{$project->needed_sum}} BYN</div>
                                </div>
                                <div class="stats-item">
                                    <strong class="stats-item__strong">{{$project->daysLeft}}</strong>
                                    <div class="stats-item__caption">Осталось дней</div>
                                </div>
                                <div class="stats-item">
                                    <p class="stats-item__info">
                                        Цель проекта — минимум {{$project->needed_sum}} BYN <br>
                                        Срок&nbsp;— {{$project->targetDate}}            </p>
                                </div>

                                @if ($user && $project->status == \App\Models\Project::STATUS_MODERATION and $project->user_id == $user->id)
                                <div class="stats-item">
                      <span class="btn btn--inactive-style btn--lg project__aside__btn project__aside__btn--moderation project__aside__btn--ghost ">
                        На модерации
                        <span class="btn__tooltip-wrap">
                          <span class="tooltip--border">?<span class="tooltip__content">Ваш проект проходит модерацию. Менеджер Суполки свяжется с вами в течение трех рабочих дней. Для получения дополнительной информации позвоните в Суполку по телефону:<br><a href="tel:+375291323123" class="nb-link">+375 (29) 132 31 23</a></span></span>
                        </span>
                      </span>
                                </div>

                                @else

                                <a href="{{ route('project.update', ['project'=>$project->id]) }}"
                                   class="btn btn--lg project__aside__btn project__aside__btn--ghost project__aside__btn--edit">Редактировать</a>
                                @endif

                            </div>
                        </div>
                    </aside>
                </div>
                <div class="project__body__additional cf">
                    <div class="project__body__info">
                        <p class="project__content-txt">{{ $project->description_short }}</p>
                        <div class="project-info__foot cf">
                            <div class="project-info__author">
                                <div class="project-author__avatar-wrap">
                                    <a href="javascript:void(0);"
                                       class="project__aside__author__avatar-clip js-open-bio"
                                       data-client="{{ $project->user_id }}">
                                        <img width="40" height="40" src="{{ $project->user->getAvatar('small') }}"
                                             alt="avatar">
                                    </a>
                                </div>
                                <div class="project-author__info">
                                    <a class="nb-link nb-link--no-border js-open-bio" href="#"
                                       data-client="{{ $project->user_id }}"><strong
                                                class="project__aside__author__name">{{ $project->user->name }}</strong></a>
                                    <div class="project-author__role">Автор проекта</div>
                                </div>
                            </div>
                            <div class="project-info__additional">
                                @if ($project->category)
                                <a href="/projects?filter=favourite&amp;category=25"
                                   class="nb-link project__info__link">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="13" viewBox="0 0 8 13">
                                        <path fill="currentColor" fill-rule="evenodd"
                                              d="M7.04 11c0 .55-.3.68-.7.3L3.52 8.42.7 11.3c-.4.38-.7.24-.7-.3V1c0-.55.44-1 1-1h5.03c.56 0 1 .46 1 1v10z"></path>
                                    </svg>
                                    {{ $project->category->title }} </a>
                                @endif
                                <span class="project__info__link"><svg xmlns="http://www.w3.org/2000/svg" width="9"
                                                                       height="12" viewBox="0 0 9 12">
									<path fill="currentColor" fill-rule="evenodd"
                                          d="M0 4.2C0 7.35 4.24 12 4.24 12s4.23-4.65 4.23-7.8c0-2.32-1.9-4.2-4.23-4.2C1.9 0 0 1.88 0 4.2zm4.24 1.5c-.84 0-1.52-.67-1.52-1.5s.68-1.5 1.52-1.5c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5z"></path></svg>
								{{ $project->location or "Локация" }}							</span>
                            </div>
                        </div>
                    </div>
                    <div class="project__body__social">
                        <ul class="share__list project__share__list">
                            <li class="share__list-item">
                                <a href="http://www.facebook.com/sharer.php?u={{ $project->url }}&amp;t={{ $project->name }}"
                                   target="_blank" class="nb-link share__link share__link--fb js-share-fb">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="9" height="20" viewBox="0 -1 9 20">
                                        <path fill="currentColor" fill-rule="evenodd"
                                              d="M0 6.15h1.9V4.28c0-.83.03-2.1.63-2.88C3.15.57 4 0 5.5 0c2.4 0 3.4.35 3.4.35L8.44 3.2s-.8-.24-1.54-.24-1.4.27-1.4 1v2.2h3.04l-.2 2.77H5.48v9.65H1.9V8.93H0V6.15"></path>
                                    </svg>
                                </a></li>


                            <li class="share__list-item">
                                <a href="https://vk.com/share.php?url={{ $project->url }}&amp;title={{ $project->name }}"
                                   target="_blank" class="nb-link share__link share__link--vk js-share-vk">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="12" viewBox="0 0 20 12">
                                        <path fill="currentColor" fill-rule="evenodd"
                                              d="M10.97 10.3c0-.65.64-1.3 1.3-1.3.63 0 1.73 1.12 2.56 1.94.64.65.64.65 1.3.65h1.92s1.3-.1 1.3-1.3c0-.4-.45-1.1-1.94-2.6-1.2-1.3-1.9-.6 0-3.2 1.2-1.6 2.1-3.1 1.9-3.5-.1-.4-3.4-1-3.8-.44C14.3 2.54 14 3 13.6 3.83c-.65 1.3-.7 1.93-1.3 1.93-.6 0-.65-1.26-.65-1.94 0-2.13.32-3.63-.63-3.86H9.05C8 0 7.1.64 7.1.64s-.8.63-.64.65c.2 0 1.3-.3 1.3.6v1.3s0 2.5-.65 2.5c-.6 0-1.9-2.58-3.2-4.5C3.4.5 3.3.6 2.6.6 1.9.6 1.3.66.7.66c-.63 0-.72.4-.63.62C1.3 4.5 2.24 6.5 4.67 9c2.26 2.34 3.76 2.46 5 2.52h.65c.65 0 .65-.94.65-1.3z"></path>
                                    </svg>
                                </a></li>


                            <li class="share__list-item">
                                <a href="http://twitter.com/share?url={{ $project->url }}&amp;text={{ $project->name }}"
                                   target="_blank" class="nb-link share__link share__link--tw js-share-tw">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="14" viewBox="0 -1 16 14">
                                        <path fill="currentColor" fill-rule="evenodd"
                                              d="M16 1.54c-.6.26-1.22.43-1.88.5.67-.4 1.2-1.04 1.44-1.8-.64.38-1.34.65-2.1.8C12.9.4 12.03 0 11.1 0 9.28 0 7.8 1.47 7.8 3.27c0 .26.02.5.08.75C5.15 3.88 2.73 2.58 1.1.6.84 1.08.68 1.65.68 2.25c0 1.13.58 2.13 1.46 2.72-.54-.02-1.04-.16-1.5-.4v.03c0 1.6 1.14 2.9 2.65 3.2-.3.1-.6.13-.9.13-.2 0-.4-.02-.6-.06.4 1.3 1.62 2.25 3.06 2.27-1.12.88-2.54 1.4-4.08 1.4-.27 0-.53 0-.8-.04 1.46.93 3.2 1.47 5.04 1.47 6.04 0 9.34-5 9.34-9.32v-.42C15 2.77 15.6 2.2 16 1.53"></path>
                                    </svg>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

        </div>

        <div class="project__foot js-project-footer">
            <div class="project__foot-nav js-footer-navigation">
                <div class="project__foot-nav__inner cf">
                    <div class="project__foot__left">
                        <ul class="nav-underlined project-info-tab-links">
                            <li class="nav-underlined__item @if($tab=='about')active @endif">
                                <a href="javascript:void(0);" rel="#about" data-url="{{ route('project.about', $project->id) }}"
                                   data-tab-params="tab=about"
                                   class="about-project-link nav-underlined__link">
                                    <span class="nav-underlined__txt">О проекте</span>
                                </a>
                            </li>
                            <li class="nav-underlined__item @if($tab=='comments')active @endif">
                                <a href="javascript:void(0);" rel="#comments" data-url="{{ route('project.comments', $project->id) }}"
                                   data-tab-params="tab=comments"
                                   class="comments-project-link nav-underlined__link">
                                    <span class="nav-underlined__txt">Комментарии</span><sup
                                            class="nav-underlined__count">{{ $project->comments_count }}</sup>
                                </a>
                            </li>
                            <li class="nav-underlined__item @if($tab=='sponsors')active @endif">
                                <a href="javascript:void(0);" rel="#sponsors" data-url="{{ route('project.sponsors', $project->id) }}"
                                   data-tab-params="tab=sponsors"
                                   class="sponsors-project-link nav-underlined__link">
                                    <span class="nav-underlined__txt">Сообщество</span><sup
                                            class="nav-underlined__count">{{ $project->sponsors_count }}</sup>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="project__foot__catalogue">
                        Вознаграждения
                    </div>

                    <div class="project__foot__links">
                        <a class="btn btn--small btn--ghost foot__edit-btn" href="{{ route('project.update', $project->id) }}">Редактировать</a>

                    </div>
                </div>
            </div>
            <div class="project__inner">
                <div id="project-info-block" class="project__inner__info">
                    <div id="projects">
                        @include('projects.tabs.'.$tab)
                    </div>
                    <div id="comments"></div>
                    <div id="sponsors"></div>
                </div>
                <aside class="project__foot__aside">
                    @foreach ($project->gifts as $gift)
                        <a href="{{ route('project.pay2', [$project, $gift]) }}" class="gift @if ($gift->available) gift--available @endif @can('donate', $project) js-open-prohibition-selection-gifts @endcan">
                            <div class="gift__head">
                                <div class="gift__status">
                                    <div class="gift__status__money--gift">
                                        <strong class="donate__strong">{{ $gift->sum }} BYN</strong>
                                    </div>
                                    <strong class="donate__title">{{ $gift->description }}</strong>
                                    <p class="donate__description--gift">лот</p>
                                    <dl class="create__gift__additional-infos--gift"></dl>
                                    @if ($gift->count)
                                        <div class="donate__status donate__status--available"> Осталось <span
                                                    class="js-available-gifts">{{ $gift->leftCount }}</span> из
                                            <span class="js-all-gifts">{{ $gift->count }}</span>
                                        </div>
                                    @endif
                                    <div class="donate__status">
										<span class="js-all-gifts"></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </aside>
            </div>
        </div>
    </section>
@endsection
