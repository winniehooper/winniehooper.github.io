<div class="nb-col4-wrap">
    <div class="nb-col4-right user-col4-right">
        <div class="nb-col4-bottom cf">
            <div class="nb-col2-wrap">
                <div class="nb-col2-center">
                    <div class="nb-col4-top user-col4-top">
                        <div class="user__info__name">
                            <h1 class="user-info-{{ $type }}__heading">{{ $profile->name }}</h1>
                        </div>
                        <div class="user__info-{{ $type }}__caption">
                            @if ($profile->residency) <span class="user__address">{{ $profile->residency }}</span> @endif
                            <span class="user__time">на сайте {{ $profile->history }}</span>
                        </div>
                    </div>
                    <div class="user__info-{{ $type }}__txt">
                        {{ $profile->information }}
                        @if ($type == 'page')
                        <a href="#" data-client="{{ $profile->id }}" data-type="short" class="user__info-link js-open-bio">Полная информация</a>
                        @endif
                    </div>
                    @if ($type == 'page')
                    <div class="user__action">
                        <a href="{{ route('settings') }}" class="btn btn--small btn--gray user__info__btn-edit">Редактировать данные</a>
                    </div>
                    @endif
                </div>
            </div>

            <div class="nb-col2-right user-col2-right">
                <ul class="user__info__social-links">
                    @foreach ($profile->social as $item)
                        <li>
                            <a href="{{ $item->url }}" class="@if ($type == 'page') user-info-page__social-link @else nb-link user-info__social-link @endif">
												<span class="user-info__social-link__icon-wrap">
													@include($item->icon)
												</span>
                                <span class="user-info__social-link__txt">
                                        {{ $item->title }}
                                    </span>

                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="nb-col4-left user__col4-left">
    <div class="user__photo">
        <div class="user__photo__avatar-clip">
            <img width="160" height="160" src="{{ $profile->getAvatar('promo') }}" alt="avatar">
        </div>
    </div>
</div>