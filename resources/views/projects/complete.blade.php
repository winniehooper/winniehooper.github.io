@extends('layouts.main')
@section('title', 'Проект отправлен на модерацию')


@section('content')
<section class="postcreate-page">
    <div class="postcreate__bg">
        <div class="postcreate__inner">
            <div class="postcreate__head cf">
                <h2 class="nb-heading--large precreate__heading--large">Проект отправлен на модерацию</h2>

                <p class="postcreate__intro__text">Ваш проект будет рассмотрен менеджером Улья в течение<br> 3-х рабочих
                    дней.</p>

                <div class="postcreate__nav">
                    <div class="postcreate__nav__item">
                        <a href="{{ route('project', $project->id) }}" class="postcreate__btn--more">Перейти к
                            проекту
                            <svg class="btn__right-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" preserveAspectRatio="xMidYMid" width="9" height="14" viewBox="0 0 9 14">
                                <path d="M1.706,1.282 L7.365,6.941 L1.706,12.6" class="cls-more-arrow-F" fill-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="postcreate__body">
        <div class="postcreate__sections cf">
            <div class="nb-section postcreate__section">
                <div class="nb-section__head">
                    <span class="postcreate__counter">1</span><span class="postcreate__status">шаг</span>
                </div>
                <div class="nb-section__body postcreate__section__body">
                    <h3 class="postcreate__section__heading">Модерация проекта</h3>

                    <p class="postcreate__section__txt">Модерация происходит в течение трёх рабочих дней.</p>
                </div>
            </div>
            <div class="nb-section postcreate__section">
                <div class="nb-section__head">
                    <span class="postcreate__counter">2</span><span class="postcreate__status">шаг</span>
                </div>
                <div class="nb-section__body postcreate__section__body">
                    <h3 class="postcreate__section__heading">Подписание договоров</h3>

                    <p class="postcreate__section__txt">Вам необходимо подписать договоры с Ульем и банком.</p>
                </div>
                <div class="nb-section__foot postcreate__section__foot">
                    <a class="nb-link poscreate__section__link js-open-postcreate-doc" href="#" onclick="return false;">Подробнее</a>
                </div>
            </div>
            <div class="nb-section postcreate__section">
                <div class="nb-section__head">
                    <span class="postcreate__counter">3</span><span class="postcreate__status">шаг</span>
                </div>
                <div class="nb-section__body postcreate__section__body">
                    <h3 class="postcreate__section__heading">Публикация проекта</h3>

                    <p class="postcreate__section__txt">Публикация проекта происходит после подписания
                        договоров.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
