@extends('layouts.main')

@section('title', 'Руководство - ' . $page->title)

@section('content')
    <section class="article-page">
        <div class="article-nav">
            <div class="article__inner">
                <h1 class="article-nav__heading">Улей. Руководство</h1>
                @include('pages.projects.parts.nav')
            </div>
        </div>
        <div class="article__body">
            <div class="article__inner">
                <article class="library__article">
                <h2>{{ $page->title }}</h2>
                {!! $page->body !!}
                </article>
            </div>
        </div>
        <div class="article__foot">
            <div class="article__inner">
                <div class="article__divider-wrap">
                    <hr class="article__divider">
                </div>
                <div class="library__article-nav cf">
                    @if ($prev)
                        <a href="{{ $prev['url'] }}"
                           class="nb-btn nb-btn--add-media nb-btn--more-left library__btn-small--more">{{ $prev['title'] }}
                            <svg class="btn-small__left-icon" xmlns="http://www.w3.org/2000/svg" width="10" height="15"
                                 viewBox="0 0 10 15">
                                <path class="cls-more-arrow-F" d="M8.66 2L3 7.66l5.66 5.658"></path>
                            </svg>
                        </a>
                    @endif
                    @if ($next)
                        <a href="{{ $next['url'] }}"
                           class="nb-btn nb-btn--add-media nb-btn--more library__btn-small--more">{{ $next['title'] }}
                            <svg class="btn-small__right-icon" xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="9"
                                 height="14" viewBox="0 0 9 14">
                                <path d="M1.706,1.282 L7.365,6.941 L1.706,12.6" class="cls-more-arrow-F"
                                      fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection