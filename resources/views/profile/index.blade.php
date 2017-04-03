@extends('layouts.main')

@section('title', 'Профиль')

@section('content')
    <section class="user-page">
        <div class="user__bg">
            <div class="user__head cf">
                @include('profile.parts.info', ['type' => 'page'])
            </div>
        </div>
        <div class="user__inner client-tab-links">
            <div class="user__body profile-tab-links-block">
                <div class="user__body__nav">
                    <input value="{{ $user->id }}" type="hidden" id="profileClientId">
                    <ul class="nb-nav-underlined">
                        <li class="nb-nav-underlined__item"><a href="javascript:void(0);" data-pathname=""
                                                               data-url="/profile/projects" rel="#projects"
                                                               data-tab-params="tab=projects"
                                                               class="nb-link nb-nav-underlined__link @if($tab=='projects') nb-nav-underlined__link--active @endif"><span
                                        class="nb-nav-underlined__txt">Проекты</span><span
                                        class="nb-nav-underlined__count">{{ $user->projects_count }}</span></a></li>
                        <li class="nb-nav-underlined__item"><a href="javascript:void(0);" data-pathname=""
                                                               data-tab-params="tab=sponsored"
                                                               data-url="/profile/sponsored" rel="#sponsored"
                                                               class="nb-link nb-nav-underlined__link @if($tab=='sponsored') nb-nav-underlined__link--active @endif"><span
                                        class="nb-nav-underlined__txt">Поддержал</span><span
                                        class="nb-nav-underlined__count">{{ $user->sponsored_count }}</span></a></li>
                        <li class="nb-nav-underlined__item"><a href="javascript:void(0);" data-pathname=""
                                                               data-tab-params="tab=comments"
                                                               data-url="/profile/comments" rel="#comments"
                                                               class="nb-link nb-nav-underlined__link @if($tab=='comments') nb-nav-underlined__link--active @endif"><span
                                        class="nb-nav-underlined__txt">Комментарии</span><span
                                        class="nb-nav-underlined__count">{{ $user->comments_count }}</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="user__foot" id="client-tab-content">
                @include('profile.tabs.'.$tab)
            </div>
        </div>
    </section>
@endsection
