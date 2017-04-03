<section class="pay-section" style="display: none">
    <div class="pay-section__head">
        <h3 class="heading--ffo-16 pay-section__heading">Способы оплаты</h3>
    </div>
    <div class="pay-section__body">
        <div class="js-pay-methods cf">
            <div class="radio-section-wrap radio-section-wrap--66">
                <div class="radio-section radio-section--selected js-pay-method">
                    <div class="nb-input-radio-wrap radio-section__radio-input">
                        <input id="js-radio-1" value="0" checked type="radio" name="payType"
                               class="nb-input-radio js-radio-input" data-type="mpi" data-action="">
                        <label for="js-radio-1" class="nb-input-radio-txt js-radio-label"></label>
                    </div>
                    <div class="radio-section__logos">
                        <img class="radio-section__logo" width="47" height="15" src="/img/payment/visa_2.png" alt="visa">
                        <img class="radio-section__logo" width="34" height="27" src="/img/payment/mastercard_2.png" alt="mastercard">
                    </div>
                    <div class="radio-section__title">
                        <strong class="radio-section__title-txt">Платёжная карта</strong>
                        <span class="radio-section__title-caption">белорусского банка*</span>
                    </div>
                </div>
            </div>

            <div class="radio-section-wrap radio-section-wrap--33">
                <div class="radio-section js-pay-method">
                    <div class="nb-input-radio-wrap radio-section__radio-input">
                        <input id="js-radio-2" value="2" type="radio" name="payType" class="nb-input-radio js-radio-input" data-type="erip" data-action="/pay-step2-erip">
                        <label for="js-radio-2" class="nb-input-radio-txt js-radio-label"></label>
                    </div>
                    <div class="radio-section__logos">
                        <img class="radio-section__logo" width="38" height="26" src="/img/payment/erip.png" alt="erip">
                    </div>
                    <div class="radio-section__title">
                        <strong class="radio-section__title-txt">ЕРИП</strong>
                    </div>
                </div>
            </div>
        </div>
        <div class="js-pay-method-body cf">
            <div class="pay-method-selection js-pay-method-selection is-visible" data-value="mpi">
                <p class="nb-section__txt pay-method__caption-txt">*Оплату по проекту можно совершить только с карты белорусского банка.</p>
            </div>
            <div class="pay-method-selection js-pay-method-selection" data-value="erip" style="margin-top: 20px">
                <h3 class="heading--ffo-16 pay-method-selection__heading">Данные плательщика ЕРИП</h3>
                <p class="pay-section__txt">Для возврата средств в случае неуспешного завершения кампании необходимо указать паспортные данные.</p>
                <div class="section__field">
                    <div class="nb-input-wrap pay-section__input">
                        <input id="js-pay-erip-surname" type="text" name="last_name" param="erip_surname" class="nb-input js-ajax-client-update-info" placeholder="Фамилия" aria-required="true" value="{{ $user ? $user->last_name : '' }}">
                    </div>
                </div>
                <div class="section__field cf">
                    <div class="nb-input-wrap input-wrap--50 pay-section__input">
                        <input id="js-pay-erip-name" type="text" name="first_name" param="erip_name" class="nb-input js-ajax-client-update-info" placeholder="Имя" aria-required="true"  value="{{ $user ? $user->first_name : '' }}">
                    </div>
                    <div class="nb-input-wrap input-wrap--50 pay-section__input">
                        <input id="js-pay-erip-patronymic" type="text" name="patronymic" param="erip_patronymic" class="nb-input js-ajax-client-update-info" placeholder="Отчество" aria-required="true" value="{{ $user ? $user->patronymic : '' }}">
                    </div>
                </div>
                <div class="section__field cf">
                    <div class="nb-input-wrap input-wrap--100 pay-section__input">
                        <input id="js-pay-erip-passport" type="text" name="doc_series" param="erip_passport" class="nb-input js-ajax-client-update-info" placeholder="Серия и номер паспорта" aria-required="true"  value="{{ $user ? $user->doc_series : '' }}">
                        <label for="js-pay-erip-passport" class="nb-input-label">Пример: MP 12345678</label>
                    </div>
                </div>
                <div class="section__field cf">
                    <div class="nb-input-wrap input-wrap--100 pay-section__input">
                        <input id="js-pay-erip-issuer" type="text" name="doc_who_issued" param="erip_issuer" class="nb-input js-ajax-client-update-info" placeholder="Кем выдан" aria-required="true"  value="{{ $user ? $user->doc_who_issued : '' }}">
                        <label for="js-pay-erip-issuer" class="nb-input-label">Пример: Советское РУВД г.Минска</label>
                    </div>
                    <div class="nb-input-wrap input-wrap--100 pay-section__input">
                        <input id="js-pay-erip-issued" type="text" name="doc_when_issued"
                               param="erip_issued" class="nb-input
													   js-ajax-client-update-info" placeholder="Когда выдан"
                               aria-required="true"  value="{{ $user ? $user->doc_when_issued : '' }}">
                        <label for="js-pay-erip-issued" class="nb-input-label">Пример: 22.04.2015</label>
                    </div>
                </div>
            </div>
        </div>
        <hr class="section__divider pay-section__divider">
    </div>
</section>