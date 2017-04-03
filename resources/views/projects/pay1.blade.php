@extends('layouts.main')

@section('title', 'Платеж')

@section('content')
<section class="pay-page">
    <div class="pay__inner">
        <div class="pay__head">
            <div class="grid-container">
                <div class="grid-w grid-w66">
                    <h1 class="heading--36">
                        <a href="{{ route('project', $project->id) }}" class="pay__heading__link">{{ $project->name }}</a>
                    </h1>
                </div>
                <div class="grid-w grid-w33"></div>
            </div>
        </div>

        <div class="pay__body pay__gifts">
            <div class="grid-container">
                <div class="grid-w grid-w66">
                    <form method="post" action="{{ route('project.pay2', $project->id) }}" id="form-pay-step1" class="js-payment-form">
                        {{ csrf_field() }}

                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <input type="hidden" name="compensation_id" value="0">
                        <input type="hidden" name="sum" id="sum-block-update" value="">
                        <input type="hidden" class="nb-input-check" name="no_gift" value="0">


                        <section id="js-no-gift-input" class="nb-section pay-gifts__section js-pay-gift-section ">
                            <div class="nb-section__body pay-no-gift-section__body cf">
                                <div class="section__body__left">
                                    <strong class="donate__title pay-no-gift__donate__title">Поддержать проект без вознаграждения</strong>
                                    <div class="create__gift__edit pay-no-gift__fields pay-gift__continue-section js-pay-gift-continue cf">
                                        <div class="nb-input-wrap pay-no-gift__input-wrap">
                                            <input alt="money" name="sum-no-gift"
                                                   class="nb-input input--with-postfix js-input-no-gift-value"
                                                   placeholder="Сумма" value="10"/>
                                            <span class="input-postfix">BYN</span>
                                        </div>
                                        <button href="javascript:void(0);" type="button" class="btn btn--small pay-no-gift__btn js-continue-pay submit-form-pay-step1 js-main-submit">Продолжить</button>

                                    </div>
                                </div>
                                <div class="section__body__right">
                                    <div class="nb-input-radio-wrap pay__radio-input">
                                        <span class="pay-hover-label">Выбрать</span>
                                        <input id="js-radio-1" class="nb-input-radio js-radio-input" type="radio"
                                               name="donate" value >
                                        <label for="js-radio-1" class="nb-input-radio-txt"></label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        @foreach ($project->gifts as $gift)
                            <section class="nb-section pay-gifts__section js-pay-gift-section ">
                                <div class="nb-section__head">
                                    <strong class="donate__strong">{{ $gift->sum }} BYN</strong>
                                </div>
                                <div class="nb-section__body cf">
                                    <div class="section__body__left">
                                        <strong class="donate__title">{{ $gift->title }}</strong>
                                        <p class="donate__description">{{ $gift->description }}</p>
                                        <div class="donate__status">
														<span class="js-all-gifts"></span>
                                        </div>
                                        <div class="create__gift__edit pay-gift__continue-section js-pay-gift-continue">
                                            <button href="javascript:void(0);" type="button" class="btn btn--small pay-no-gift__btn js-continue-pay submit-form-pay-step1 js-main-submit">Продолжить</button>
                                        </div>
                                    </div>
                                    <div class="section__body__right">
                                        <div class="nb-input-radio-wrap pay__radio-input">
                                            <span class="pay-hover-label">Выбрать</span>
                                            <input id="js-radio-{{ $gift->id }}" type="radio" name="donate" class="nb-input-radio js-radio-input" data-gift-cost="{{ $gift->sum }}" value="{{ $gift->id }}">
                                            <label for="js-radio-{{ $gift->id }}" class="nb-input-radio-txt"></label>
                                        </div>
                                        <dl class="create__gift__additional-infos">
                                            <div class="create__gift__additional-info">
                                                <dt class="create__gift__additional-info__caption">Когда</dt>
                                                <dd class="create__gift__additional-info__value">
                                                    Март 2017															</dd>
                                            </div>
                                        </dl>
                                    </div>
                                </div>
                            </section>
                        @endforeach


                    </form>
                </div>
                <div class="grid-w grid-w33">
                    <section class="nb-create create--help create--pay">
                        <div class="nb-create__head create-help__head">
                            <p class="nb-section__txt">Улей не является магазином. Это способ реализовывать творческие проекты. Ответственность за исполнение обязательств полностью лежит на авторе проекта. Улей не гарантирует реализацию проекта и не оценивает способность автора справиться с данными обещаниями. Подробнее о работе Улья вы <a href="/trust-and-safety" target="_blank" class="nb-link">можете узнать здесь</a>.</p>
                        </div>

                        <details class="nb-details nb-details--small">
                            <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Когда и как происходит доставка?</summary>
                            <div class="nb-details-content">
                                <div class="nb-details-content-txt">Если лот предполагает доставку, то<br />
                                    ожидаемая дата доставки указана в<br />
                                    описании лота. Также на следующем<br />
                                    шаге вам будет предложено указать<br />
                                    адрес доставки. Доставка станет<br />
                                    возможной только после успешного<br />
                                    финансирования и реализации данного<br />
                                    проекта. Если крауд-кампания<br />
                                    завершится неуспешно, все<br />
                                    перечисленные вами средства будут<br />
                                    возвращены.</div>
                            </div>
                        </details>
                        <details class="nb-details nb-details--small">
                            <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Кто осуществляет доставку?</summary>
                            <div class="nb-details-content">
                                <div class="nb-details-content-txt">Доставку осуществляет автор данного проекта.</div>
                            </div>
                        </details>
                        <details class="nb-details nb-details--small">
                            <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Как произвести оплату?</summary>
                            <div class="nb-details-content">
                                <div class="nb-details-content-txt">Произвести оплату можно с помощью<br />
                                    банковской карты или системы расчета<br />
                                    ЕРИП. ОАО «Белгазпромбанк»<br />
                                    обеспечивает перечисление средств в<br />
                                    пользу проекта и не взимает<br />
                                    дополнительную комиссию за<br />
                                    транзакции.</div>
                            </div>
                        </details>
                        <details class="nb-details nb-details--small">
                            <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Когда происходит cписание средств?</summary>
                            <div class="nb-details-content">
                                <div class="nb-details-content-txt">Списание средств происходит в момент оплаты.</div>
                            </div>
                        </details>
                        <details class="nb-details nb-details--small">
                            <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Что, если я захочу изменить выбор?</summary>
                            <div class="nb-details-content">
                                <div class="nb-details-content-txt">Если вы захотите изменить или вернуть<br />
                                    перечисленную сумму, то вы сможете<br />
                                    это сделать в любой момент до<br />
                                    завершения крауд-кампании. Возврат<br />
                                    средств не предполагает никакой<br />
                                    дополнительной комиссии со стороны<br />
                                    ОАО «Белгазпромбанк». Для возврата<br />
                                    средств вам необходимо обратиться по<br />
                                    телефону <a href="tel:+375291323123" class="nb-link">+375 (29) 132 31 23</a>.</div>
                            </div>
                        </details>

                        <div class="nb-create__foot">
                            <hr class="nb-create-status-divider">
                            <div class="nb-create-question">
                                <a href="javascript:void(0)" class="nb-link nb-create__link js-open-feedback-popup">Задать вопрос</a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection