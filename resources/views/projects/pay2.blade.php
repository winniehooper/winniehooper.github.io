@extends('layouts.main')

@section('title', 'Платеж')

@section('overlays')
    <div class="overlayer overlayer--system js-donation-contract-popup">
        <div class="popup__block nb-section popup--system">
            <div class="js-system-popup-content">
                <div class="nb-section__head">
                    <h2 class="donation-contract__heading js-lang-section js-lang-ru">Условия дарения</h2><span class="donation-contract__subheading js-lang-section js-lang-ru"> —
                    договор дарения                </span>
                    <h2 class="donation-contract__heading js-lang-section js-lang-en">TERMS AND CONDITIONS OF DONATION</h2><span class="donation-contract__subheading js-lang-section js-lang-en"> — Agreement on Donation</span>
                    <div class="donation-contract__language">
                        <a href="javascript:void(0);" class="language-link language-link--is-active js-lang" data-lang="ru">На русском</a>
                        <a href="javascript:void(0);" class="language-link js-lang" data-lang="en">In English</a>
                    </div>
                </div>
                <div class="nb-section__body popup-donation-contract__section__body cf js-lang-section js-lang-ru">
                    <p>г. Минск, Республика Беларусь</p>

                    <p>Даритель: физическое лицо, совершающее Платеж в соответствии с Пользовательским соглашением участия в
                        системе Викибанк-краудфандинг, размещенным на сайте ulej.by (далее – Соглашение), и указавшее свои
                        идентификационные данные в системе Викибанк-краудфандинг в соответствии вышеуказанным Соглашением.</p>
                    <p>
                        Организатор Проекта: Сидоренко Антон Васильевич, Минск                        </p>

                    <ol>
                        <li>Акцептуя настоящие условия, Даритель безвозмездно передает Организатору Проекта сумму в белорусских
                            рублях в размере совершенного через сайт в сети Интернет ulej.by платежа с использованием банковской
                            платежной карточки (далее – Платеж).</li>
                        <li>Организатор Проекта возвращает сумму Платежа Дарителю (отказывается от принятия Платежа) в случае
                            несостоятельности или недействительности Проекта, а также в случаях, определенных Соглашением,
                            при условии наличия у Расчетного банка технической возможности осуществить возврат суммы платежа на
                            банковскую платежную карточку Дарителя с учетом условий п. 6.8. - 6.10. Соглашения.</li>
                        <li>Гражданско-правовые отношения между Организатором Проекта и Дарителем считаются возникшими в
                            момент акцепта Дарителем настоящего Соглашения в соответствии с порядком, определенным Соглашением.</li>
                        <li>Во всем остальном, что не предусмотрено настоящими условиями, стороны руководствуются законодательством Республики Беларусь.</li>
                    </ol>
                </div>
                <div class="nb-section__body popup-donation-contract__section__body cf js-lang-section js-lang-en">
                    <p>The city of Minsk, the Republic of Belarus</p>

                    <p>The Donor: natural person carrying out the Payment in accordance with the Terms of Service on Participation
                        in WikiBank - Crowdfunding System available on the Website ulej.by (hereinafter “the Agreement”)
                        who provided his identification data in the WikiBank - Crowdfunding System in accordance with the above Agreement.</p>
                    <p>
                        The Project Manager: Сидоренко Антон Васильевич, Минск                        </p>

                    <ol>
                        <li>By accepting the present Terms and Conditions the Donor shall donate the sum in Belarusian rubles
                            to the Project Manager in the amount of the payment performed through the website ulej.by on the
                            Internet using banking payment card (hereinafter “the Payment”).</li>
                        <li>The Project Manager shall refund the sum of the Payment to the Donor (shall refuse to accept the
                            Payment) in case of insolvency or invalidity of the Project, and in other cases determined in the
                            Agreement on conditions that the Settlement Bank has technical possibility to refund the sum of
                            payment to the Donor’s banking payment card taking into account the provisions of Paragraphs
                            6.8.-6.10. of the Agreement.</li>
                        <li>The civil and legal relations between the Project Manager and the Donor deem to be started from
                            the moment of the Donor’s acceptance under the present Agreement in accordance with the procedures
                            described in the Agreement.</li>
                        <li>All other issues not provided for by the present Terms and Conditions shall be governed by the
                            legislation of the Republic of Belarus.</li>
                    </ol>
                </div>
            </div>
            <button type="button" class="nb-btn--close-system js-close-popup">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid" viewBox="0 0 14 14"><path fill-rule="evenodd" d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z" class="cls-close-cross"/></svg>
            </button>
        </div>
    </div>
@endsection

@section('content')
    <div class="pay-page">
        <div class="pay__inner">
            <div class="pay__head">
                <div class="grid-container">
                    <div class="grid-w grid-w66">
                        <h1 class="heading--36">
                            <a href="{{ route('project', $project) }}" class="pay__heading__link">{{ $project->name }}</a>
                        </h1>
                    </div>
                </div>
            </div>
            <div class="pay__body pay__body--fields js-pay-body">
                <div class="grid-container">
                    <div class="grid-w grid-w66">
                        <form method="post" action="/donate" id="form-pay-step2" class="js-payment-form" data-ready-submit = "true">
                            {{ csrf_field() }}
                            <input id="js-payment-type" type="hidden" name="type" value="mpi">
                            <input type="hidden" name="project_id" value="{{ $project->id }}">
                            <input type="hidden" name="client_id" value="{{ Auth::id() }}">
                            <input id="sum-block" type="hidden" name="sum" value="{{ $sum }}">
                            <input type="hidden" name="compensation_id" value="{{ $gift->id }}">
                            <input type="hidden" name="no_gift" value="{{ $gift ? 0 : 1 }}">
                            <input type="hidden" name="interview" value="0">


                            {{-- @include('projects.pay.delivery') --}}
                            {{-- @include('projects.pay.type') --}}

                            <section class="pay-section">
                                <div class="pay-section__head">
                                    <h3 class="heading--ffo-16 pay-section__heading">Настройки приватности</h3>
                                </div>
                                <div class="pay-section__body">
                                    <div class="section__field">
                                        <p class="pay-section__txt">Отображать ваше имя в списке участников?</p>
                                    </div>
                                    <div class="section__field js-pay-privacies cf">
                                        <div class="radio-section-wrap radio-section-wrap--50">
                                            <div class="radio-section radio-section--selected js-pay-privacy">
                                                <div class="nb-input-radio-wrap radio-section__radio-input">
                                                    <input id="js-radio-3" value="1" name="view_flag" checked type="radio"
                                                           class="nb-input-radio js-radio-input">
                                                    <label for="js-radio-3" class="nb-input-radio-txt js-radio-label"></label>
                                                </div>
                                                <div class="radio-section__title">
                                                    <strong class="radio-section__title-txt">Отображать</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="radio-section-wrap radio-section-wrap--50">
                                            <div class="radio-section js-pay-privacy">
                                                <div class="nb-input-radio-wrap radio-section__radio-input">
                                                    <input id="js-radio-4" value="0" name="view_flag"
                                                           type="radio" class="nb-input-radio js-radio-input">
                                                    <label for="js-radio-4" class="nb-input-radio-txt js-radio-label"></label>
                                                </div>
                                                <div class="radio-section__title">
                                                    <strong class="radio-section__title-txt">Не отображать</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="section__divider pay-section__divider">
                                </div>
                            </section>
                            <section class="pay-section">
                                <p class="pay-section__terms">Нажимая кнопку "Продолжить", вы соглашаетесь с <a
                                            href="/agreement" target="_blank" class="nb-link info__link" >условиями пользования</a> платформы Ulej.by, а также принимаете
                                    <a href="javascript:void(0)" class="nb-link info__link js-open-donation-contract">условия дарения</a>.</p>
                                <button type="submit" value="Продолжить" class="nb-btn btn--wide pay-continue__btn pay__btn--more submit-form-pay-step2">Продолжить</button>
                            </section>
                        </form>
                    </div>
                    <div class="grid-w grid-w33">
                        <section class="pay-order">
                            <div class="pay-order__head">
                                <h2 class="heading--ffo-16 pay-order__heading">Ваша заявка</h2>
                                <a href="{{ route('project', $project) }}" class="nb-link pay-order__link">Изменить</a>
                            </div>

                            @if ($gift->id)
                            <div class="pay-order__body">
                                <dl class="pay-order__content">
                                    <div class="pay-order__item cf">
                                        <dt class="pay-order__strong">{{ $gift->description }}</dt>
                                        <dd class="pay-order__cost">{{ $gift->sum }} BYN</dd>
                                    </div>
                                </dl>
                            </div>
                            @endif

                            <div class="pay-order__foot">
                                <dl class="pay-order__content cf">
                                    <dt class="pay-order__strong pay-order__strong--result">Итого</dt>
                                    <dd class="pay-order__result">{{ $sum }} BYN</dd>
                                </dl>
                            </div>
                        </section>
                        <p class="nb-section__txt">Улей не является магазином. Это способ реализовывать творческие проекты. Ответственность за исполнение обязательств полностью лежит на авторе проекта. Улей не гарантирует реализацию проекта и не оценивает способность автора справиться с данными обещаниями. Подробнее о работе Улья вы <a href="http://ulej.by/trust-and-safety" target="_blank" class="nb-link">можете узнать здесь</a>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection