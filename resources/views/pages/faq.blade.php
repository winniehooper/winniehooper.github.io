@extends('layouts.main')
@section('title', 'FAQ')

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
                    <h2 class="nb-heading info__heading">F.A.Q.</h2>
                    <p class="info-page__txt">Возможно, здесь вы найдете ответы на свои вопросы. Если этого не
                        произойдет, вы можете задать свой вопрос через <a href="/feedback" class="nb-link">обратную
                            связь</a>.</p>
                </div>

                <div class="info-page__body">
                    <div class="info-page__articles">
                        @foreach ($categories as $category)
                            <details class="nb-details part-faq">
                                <summary class="nb-summary faq-category">
                                    <a name="question_obschie"></a>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14"
                                         class="nb-summary-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14">
                                        <path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429"
                                              class="cls-arrow-aquarium--round"></path>
                                    </svg>
                                    {{ $category->name }}
                                </summary>
                                @foreach($category->questions as $question)
                                    <div class="nb-details-content">
                                        <div class="nb-create-details__inner">
                                            <details class="nb-details nb-details--small faq-site-question-block">
                                                <summary class="nb-summary nb-summary--small">
                                                    <a class="faq-site-question-link" name="question_1"></a>
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="8" height="14"
                                                         class="nb-summary-icon nb-summary-icon--small"
                                                         preserveAspectRatio="xMidYMid" viewBox="0 0 8 14">
                                                        <path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429"
                                                              class="cls-arrow-aquarium--round"></path>
                                                    </svg>
                                                    {{ $question->question }}
                                                </summary>
                                                <div class="nb-details-content">
                                                    <div class="nb-details-content-txt">
                                                        {!! $question->answer !!}
                                                    </div>
                                                </div>
                                            </details>
                                        </div>
                                    </div>
                                @endforeach
                            </details>
                        @endforeach


                    </div>
                    <form class="info-page__ask" id="js-ask-questions" novalidate="novalidate" _lpchecked="1">
                        <div class="info-page__ask-txt">
                            <div class="nb-textarea-wrap">
                                <textarea id="js-ask-text" class="nb-textarea"
                                          placeholder="Не нашли ответа? Задайте вопрос" name="user_question"></textarea>
                            </div>
                        </div>
                        <div class="info-page__ask-user cf">
                            <div class="info-page__ask-user__name">
                                <div class="nb-input-wrap">
                                    <input id="js-ask-name-input" type="text" name="user_name" class="nb-input"
                                           placeholder="Ваше имя" value="" aria-required="true" aria-invalid="false">
                                </div>
                            </div>
                            <div class="info-page__ask-user__email">
                                <div class="nb-input-wrap">
                                    <input id="js-ask-email-input" type="email" name="user_email" class="nb-input"
                                           placeholder="Ваш email" value="">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="nb-btn form__btn-action js-ask">Задать вопрос</button>
                    </form>
                </div>
            </div>
        </div>
    </section>


@endsection