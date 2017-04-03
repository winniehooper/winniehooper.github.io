@extends('layouts.main')

@section('title', $page->title)

@section('content')
        <section class="library-page">
            <div class="library__bg"></div>
            <div class="library__inner">
                <div class="library__body cf">
                    <div class="library__intro">
                        <div class="library__intro__body">
                            <h1 class="library__heading--large">{{ $page->title }}</h1>
                            {!! $page->body !!}
                        </div>
                        <div class="library__intro__foot">
                            <a href="/study/1" class="btn btn--more library__btn--more">Начать<svg class="btn__right-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="9" height="14" viewBox="0 0 9 14"><path d="M1.706,1.282 L7.365,6.941 L1.706,12.6" class="cls-more-arrow-F" fill-rule="evenodd"></path></svg></a>
                        </div>
                    </div>
                </div>
                <div class="library__foot">
                    <hr class="library__divider">
                    @include('pages.projects.parts.nav')
                </div>
            </div>
        </section>
@endsection