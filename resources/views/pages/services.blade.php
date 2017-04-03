@extends('layouts.main')
@section('title', $page->title)

@section('content')
    <section class="info-page">
        <div class="info-page__inner">
            <aside class="nb-section aside-nav">
                @foreach($menu as $item)
                    <li class="aside-nav-item js-aside-nav @if($item->url() == url(request()->path())) aside-nav-item--active @endif">
                        <a class="aside-nav-item__link " href="{{ $item->url() }}">{{ $item->name }}</a>
                    </li>
                @endforeach
            </aside>

            <div class="info-page__content">
                <div class="info-page__head">
                    <h1 class="nb-heading info__heading">{{ $page->title }}</h1>
                    <div class="info-page__body">
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection