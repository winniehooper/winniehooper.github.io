<div class="overlayer js-auth-popup @if ($show_auth) overlayer--show @endif">
    <a href="{{ Request::url() }}" type="button" class="nb-btn--close popup__btn--close js-close-popup js-popup-change-url">
        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52">
            <g fill="none">
                <circle cx="26" cy="26" r="25" stroke-width="2" class="cls-close-circle"/>
                <path d="M36 34.572L34.572 36 26 27.429 17.429 36 16 34.572 24.572 26 16 17.429 17.429 16 26 24.572 34.572 16 36 17.429 27.429 26 36 34.572z"
                      class="cls-close-cross"/>
            </g>
        </svg>
    </a>
    <div class="popup__block js-popup-content">
        <div class="popup__content cf">
            <div class="popup__block__restore js-rest-content @if ($uri =='recovery')popup__block__restore--show @endif">
                <div class="restore_form js-auth-form">
                    <h3 class="nb-heading popup__heading">Восстановление пароля</h3>
                    <form action="/restore" method="post" class="popup__form" id="js-restore" autocomplete="off">
                        {{ csrf_field() }}
                        <div class="popup__inputs-group">
                            <div class="nb-input-wrap popup__input-wrap">
                                <input id="js-rest-email-input" type="email" name="email" class="nb-input"
                                       alt="email" placeholder="Введите email">
                            </div>
                        </div>
                        <button type="submit" class="nb-btn form__btn-action" id="js-submit-restore">Отправить запрос
                        </button>
                    </form>
                    <div class="popup__change">
                        <a href="/login" class="nb-link change-popup-link js-open-login" data-link-type="popup">Вход в
                            систему</a>
                    </div>
                </div>
                <div class="restore_success js-auth-message display-none">
                    <p class="register_success">Спасибо! На ваш email было выслано письмо с инструкциями по смене
                        пароля.</p>
                    <a href="/login" class="nb-btn nb-btn--green nb-btn--add-media js-open-login"
                       data-link-type="popup">Вход в систему</a>
                </div>
                <div class="restore_fail js-auth-message display-none">
                    <p class="register_fail">Ошибка. Пользователь с таким email не найден.</p>
                    <a href="/login" class="nb-btn nb-btn--green nb-btn--add-media js-open-login"
                       data-link-type="popup">Вход в систему</a>
                </div>
            </div>
            <div class="popup__block__login js-login-content @if ($uri !='login') popup__block__login-registration--hidden @endif">
            <h3 class="nb-heading popup__heading">Вход</h3>
                <ul class="nb-social-items login__social-items">
                    <li class="nb-social-item login__social-item">
                        <a href="{{ url('/auth/vkontakte') }}"
                           class="social-link social-link--vk">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="14"
                                 class="vk-icon login__icon--vk" preserveAspectRatio="xMidYMid" viewBox="0 0 11 14">
                                <path fill-rule="evenodd"
                                      d="M10.239 7.444c-.512-.56-1.193-.932-2.044-1.114v-.075c.592-.251 1.056-.643 1.392-1.175.336-.533.504-1.141.504-1.824 0-.59-.122-1.11-.365-1.561C9.482 1.243 9.114.883 8.62.614 8.164.363 7.676.198 7.155.12 6.633.041 5.868.002 4.856.002H-.009v14.001h5.513c.955 0 1.743-.088 2.363-.264.619-.175 1.188-.47 1.706-.883.438-.345.786-.781 1.045-1.307.259-.527.389-1.138.389-1.834 0-.953-.256-1.71-.768-2.271zM6.54 11.163c-.358.157-.709.242-1.055.254-.345.013-.968.019-1.868.019h-.185V7.929h.638c.617 0 1.108.004 1.475.014.367.009.655.055.865.136.345.126.604.31.777.555.173.244.259.583.259 1.015 0 .339-.073.641-.217.908-.145.266-.375.468-.689.606zm-.694-5.848c-.253.119-.498.185-.735.197-.238.013-.652.019-1.244.019h-.435V2.569h.241c.616 0 1.08.005 1.391.014.312.01.581.065.81.165.24.107.417.279.531.517.115.238.171.47.171.696 0 .307-.052.576-.157.808-.105.232-.296.414-.573.546z"
                                      class="cls-F"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nb-social-item login__social-item">
                        <a href="{{ url('/auth/odnoklassniki') }}"
                           class="social-link social-link--ok">
                            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="19"
                                 class="ok-icon login__icon--ok" preserveAspectRatio="xMidYMid" viewBox="0 0 11 19">
                                <path fill-rule="evenodd"
                                      d="M5.5 9.617c2.557 0 4.63-2.153 4.63-4.809C10.13 2.153 8.057 0 5.5 0S.87 2.153.87 4.808c0 2.656 2.073 4.809 4.63 4.809zm0-7.174c1.258 0 2.278 1.059 2.278 2.365 0 1.307-1.02 2.366-2.278 2.366S3.222 6.115 3.222 4.808c0-1.306 1.02-2.365 2.278-2.365zm5.337 7.76c-.261-.545-.985-.999-1.947-.211-1.301 1.064-3.39 1.064-3.39 1.064s-2.089 0-3.39-1.064c-.962-.788-1.686-.334-1.947.211-.456.951.059 1.411 1.221 2.185.992.662 2.356.909 3.237 1.002l-.735.763c-1.036 1.075-2.035 2.113-2.729 2.833-.414.431-.414 1.129 0 1.56l.125.13c.415.43 1.087.43 1.502 0l2.728-2.834c1.036 1.075 2.035 2.113 2.729 2.834.414.43 1.087.43 1.501 0l.125-.13c.415-.431.415-1.129 0-1.56l-2.728-2.833-.738-.766c.882-.094 2.231-.343 3.215-.999 1.162-.774 1.677-1.234 1.221-2.185z"
                                      class="cls-F"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nb-social-item login__social-item">
                        <a href="{{ url('/auth/facebook') }}"
                           class="social-link social-link--fb">
                            <svg xmlns="http://www.w3.org/2000/svg" width="8" height="18"
                                 class="fb-icon login__icon--fb" preserveAspectRatio="xMidYMid" viewBox="0 0 8 18">
                                <path fill-rule="evenodd"
                                      d="M8.002.356C7.107.152 6.42-.001 5.48-.001c-2.706 0-3.783 1.428-3.783 3.977v1.861H0v3.009h1.697v9.153h3.301V8.846h2.407l.23-3.009H4.998V4.384c0-.816.069-1.326 1.124-1.326.389 0 1.008.077 1.467.179L8.002.356z"
                                      class="cls-F"/>
                            </svg>
                        </a>
                    </li>
                    <li class="nb-social-item login__social-item">
                        <a href="{{ url('/auth/google') }}"
                           class="social-link social-link--gp">
                            <svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
                                 class="gp-icon login__icon--gp" viewBox="0 0 21 20">
                                <path class="cls-F" fill-rule="evenodd"
                                      d="M20 9.82h-2.558v2.475h-1.46V9.82h-2.498v-.055h-.016V8.357h2.513V5.832h1.47v2.525h2.5v.012H20v1.45zM9.603 1.85c.15.092.317.227.503.404.18.184.354.41.526.68.164.254.31.554.436.9.104.346.156.75.156 1.21-.014.846-.2 1.523-.562 2.03-.177.246-.365.473-.563.68-.22.208-.46.42-.7.635-.15.14-.28.31-.4.49-.14.19-.21.41-.21.67 0 .24.07.45.21.61.123.15.242.29.36.4l.804.653c.5.407.94.857 1.316 1.35.356.5.54 1.152.555 1.96 0 1.145-.505 2.16-1.52 3.044-1.054.915-2.574 1.39-4.56 1.42-1.66-.017-2.905-.37-3.725-1.06-.815-.635-1.23-1.405-1.23-2.3 0-.438.134-.925.403-1.462.262-.537.735-1.01 1.42-1.416.768-.438 1.576-.73 2.422-.876.838-.123 1.534-.192 2.088-.207-.17-.224-.324-.464-.458-.72-.156-.246-.234-.544-.234-.892 0-.208.03-.382.09-.522l.15-.405c-.27.03-.52.05-.76.05-1.26-.01-2.22-.41-2.89-1.19-.69-.72-1.04-1.56-1.04-2.52 0-1.16.49-2.21 1.48-3.16.676-.55 1.377-.91 2.104-1.08C6.48 1.078 7.158 1 7.788 1h4.75l-1.47.852H9.603zM6.518 12.36c-.492.068-.994.18-1.508.333-.12.047-.29.116-.51.208-.22.1-.443.25-.67.43-.22.19-.404.43-.555.72-.174.3-.26.66-.26 1.09 0 .83.377 1.516 1.133 2.054.718.54 1.7.816 2.948.83 1.12-.014 1.973-.26 2.562-.737.575-.47.862-1.072.862-1.81 0-.6-.197-1.123-.59-1.57-.415-.422-1.065-.94-1.95-1.556-.15-.02-.328-.025-.532-.025-.122-.015-.43 0-.93.047zm1.975-9.04c-.224-.455-.52-.824-.886-1.11-.374-.27-.804-.412-1.29-.427-.644.015-1.18.273-1.605.774-.36.524-.532 1.11-.517 1.756 0 .856.252 1.746.754 2.67.24.43.55.797.94 1.098.38.3.82.45 1.32.45.62-.02 1.14-.24 1.56-.67.2-.3.33-.6.39-.92.03-.31.05-.58.05-.8 0-.93-.24-1.87-.72-2.82z"/>
                            </svg>
                        </a>
                    </li>
                </ul>
                <p class="nb-separator login__separator">или</p>
                <form action="/login" method="post" class="popup__form" id="js-login" autocomplete="off">
                    {{ csrf_field() }}
                    <div class="popup__inputs-group popup-login__inputs-group">
                        <div class="nb-input-wrap popup__input-wrap">
                            <input type="email" id="js-login-email-input" name="email" class="nb-input"
                                   placeholder="Email">
                        </div>
                        <div class="nb-input-wrap popup__input-wrap">
                            <input id="js-login-pass-input" type="password" name="password" class="nb-input"
                                   placeholder="Пароль">
                        </div>
                    </div>
                    <a href="/recovery" class="nb-link popup__link js-open-rest" data-link-type="popup">Забыли
                        пароль?</a>
                    <button type="submit" class="nb-btn form__btn-action" id="js-submit-login">Войти</button>
                </form>
                <p class="nb-separator login__separator">или</p>
                <a href="/registration" class="nb-btn nb-btn--green nb-btn--add-media js-open-reg"
                   data-link-type="popup">Зарегистрироваться</a>
            </div>
            <div class="popup__block__registration js-reg-content @if ($uri =='registration') popup__block__registration--show @endif">
                <div class="register_block js-auth-form">
                    <h3 class="nb-heading popup__heading">Регистрация</h3>
                    <form action="/registration" method="post" class="popup__form popup-reg__form" id="js-registration"
                          autocomplete="off">
                        {{ csrf_field() }}
                        <div class="popup__inputs-group">
                            <div class="nb-input-wrap popup__input-wrap">
                                <input id="js-reg-name-input" type="text" name="name" class="nb-input"
                                       placeholder="Имя Фамилия">
                            </div>
                            <div class="nb-input-wrap popup__input-wrap">
                                <input id="js-reg-email-input" type="email" name="email" placeholder="Email"
                                       class="nb-input">
                            </div>
                            <div class="nb-input-wrap popup__input-wrap">
                                <input id="js-reg-pass-input" type="password" name="password" class="nb-input"
                                       placeholder="Пароль">
                            </div>
                            <div class="nb-input-wrap popup__input-wrap">
                                <input id="js-reg-pass2-input" type="password" name="password_confirm" class="nb-input"
                                       placeholder="Повторите пароль">
                            </div>
                        </div>
                        <div class="popup__terms">
                            <div class="nb-input-check-wrap">
                                <input id="js-terms-input" class="nb-input-check" type="checkbox" name="terms-input"
                                       value="terms">
                                <label for="js-terms-input" class="nb-input-check-txt">С <a
                                            class="nb-link register__link" href="/agreement"
                                            target="_blank">условиями</a> ознакомлен и согласен</label>
                            </div>
                        </div>
                        <button type="submit" class="nb-btn form__btn-action" id="js-submit-registration">
                            Зарегистроваться
                        </button>
                    </form>
                    <p class="nb-separator reg__separator">или</p>
                </div>
                <div class="js_register_success js-auth-message display-none">
                    <h3 class="nb-heading popup__heading">Спасибо!</h3>
                    <p>Спасибо! На ваш email было выслано письмо для подтверждения регистрации.</p>
                </div>
                <div class="register_fail js-auth-message display-none">
                    <h3 class="nb-heading popup__heading">Ошибка регистрации.</h3>
                    <p class="error_message display-none"></p>
                </div>
                <a href="/login" class="nb-btn nb-btn--green nb-btn--add-media js-open-login" data-link-type="popup">Войти
                    в систему</a>
            </div>
        </div>
    </div>
</div>
<div class="overlayer js-subscription-popup">
    <button class="nb-btn--close popup__btn--close js-close-popup">
        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52">
            <g fill="none">
                <circle cx="26" cy="26" r="25" stroke-width="2" class="cls-close-circle"/>
                <path d="M36 34.572L34.572 36 26 27.429 17.429 36 16 34.572 24.572 26 16 17.429 17.429 16 26 24.572 34.572 16 36 17.429 27.429 26 36 34.572z"
                      class="cls-close-cross"/>
            </g>
        </svg>
    </button>
    <div class="popup__block">
        <h3 class="nb-heading popup__heading">Подпишись на новости</h3>
        <form action="/subscription" method="post" class="popup__form" id="js-subscription" autocomplete="off">
            {{ csrf_field() }}
            <div class="popup__inputs-group popup-subscription__inputs-group">
                <div class="nb-input-wrap popup__input-wrap">
                    <input type="email" id="js-subscription-email-input" name="email" class="nb-input"
                           placeholder="Email">
                </div>
            </div>
            <button type="submit" class="nb-btn form__btn-action" id="js-submit-subscription">Подписаться</button>
        </form>
    </div>
</div>
<div class="overlayer overlayer--system js-feedback-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-popup-content">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Обратная связь</h2>
            </div>
            <div class="nb-section__body popup-feedback__section__body cf">
                <form id="js-feedback-popup-form" action="" class="js-feedback-form-popup">
                    {{ csrf_field() }}
                    <div class="info-page__ask-dd">
                        <div class="nb-dd-toggle-wrap js-dd-select-box js-feedback-select">

                            <div class="nb-dd-toggle js-toggle-dd">
                                <span class="nb-dd-toggle-txt nb-dd-toggle-txt--default js-toggle-dd-txt">Выберите тему вопроса</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9" class="nb-dd-arrow-icon"
                                     preserveAspectRatio="xMidYMid" viewBox="0 0 13 9">
                                    <path fill-rule="evenodd" d="M12.003 1L6.502 6.592 1 1" class="cls-dd-arrow-Aqua"/>
                                </svg>
                            </div>

                            <select class="nb-dd-default js-dd-select" id="js-feedback-subject" name="feedback_subject">
                                <option class="js-dd-option" selected value="">Выберите тему вопроса</option>
                                <option class="js-dd-option" value="support">Служба поддержки</option>
                                <option class="js-dd-option" value="complaint">Жалоба</option>
                                <option class="js-dd-option" value="sentence">Предложение</option>
                                <option class="js-dd-option" value="other">Другое</option>
                            </select>

                            <ul class="nb-dd nb-dd--hidden js-dd-menu">
                                <li class="nb-dd-item">
                                    <div data-value=""
                                         class="dd-item-link js-dd-menu-item dd-item-link--default dd-item-link--selected js-default-select-value">
                                        <span class="">Выберите тему вопроса</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="9"
                                             class="nb-dd-arrow-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 13 9">
                                            <path fill-rule="evenodd" d="M.992 6.606l5.501-5.592 5.502 5.592"
                                                  class="cls-dd-arrow-Aqua"/>
                                        </svg>
                                    </div>
                                </li>
                                <li class="nb-dd-items">
                                    <ul class="nb-dd-items__list">
                                        <li class="nb-dd-item">
                                            <div data-value="support" class="dd-item-link js-dd-menu-item">Служба
                                                поддержки
                                            </div>
                                        </li>
                                        <li class="nb-dd-item">
                                            <div data-value="complaint" class="dd-item-link js-dd-menu-item">Жалоба
                                            </div>
                                        </li>
                                        <li class="nb-dd-item">
                                            <div data-value="sentence" class="dd-item-link js-dd-menu-item">
                                                Предложение
                                            </div>
                                        </li>
                                        <li class="nb-dd-item">
                                            <div data-value="other" class="dd-item-link js-dd-menu-item">Другое</div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="info-page__ask-txt">
                        <div class="nb-textarea-wrap">
                            <textarea required id="js-feedback-text" class="popup-feedback__textarea"
                                      placeholder="Задайте вопрос" name="user_question"></textarea>
                        </div>
                    </div>
                    <div class="info-page__ask-user">
                        <div class="nb-input-wrap">
                            <input required id="js-feedback-name-input" type="text" name="user_name" class="nb-input"
                                   placeholder="Как вас называть?" value="">
                        </div>
                    </div>
                    <div class="info-page__ask-user">
                        <div class="nb-input-wrap">
                            <input required id="js-feedback-email-input" type="email" name="user_email" class="nb-input"
                                   placeholder="Контактный email" value="">
                        </div>
                    </div>
                    <button type="submit" class="nb-btn form__btn-action">Задать вопрос</button>
                </form>
            </div>
        </div>
        <button type="button" class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--system js-donation-contract-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-popup-content">
            <div class="nb-section__head">
                <h2 class="donation-contract__heading js-lang-section js-lang-ru">Условия дарения</h2><span
                        class="donation-contract__subheading js-lang-section js-lang-ru"> —
                    договор подряда                </span>
                <h2 class="donation-contract__heading js-lang-section js-lang-en">TERMS AND CONDITIONS OF DONATION</h2>
                <span class="donation-contract__subheading js-lang-section js-lang-en"> — Agreement on Donation</span>
                <div class="donation-contract__language">
                    <a href="javascript:void(0);" class="language-link language-link--is-active js-lang" data-lang="ru">На
                        русском</a>
                    <a href="javascript:void(0);" class="language-link js-lang" data-lang="en">In English</a>
                </div>
            </div>
            <div class="nb-section__body popup-donation-contract__section__body cf js-lang-section js-lang-ru">
                Договор подряда для юр/ип ru
            </div>
            <div class="nb-section__body popup-donation-contract__section__body cf js-lang-section js-lang-en">
                Договор подряда для юр/ип en
            </div>
        </div>
        <button type="button" class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--search js-search-popup @if(request::path() == 'search') overlayer--show @endif">
    <a href="@if(request::path() != 'search'){{ Request::url() }}@else{{ url('/') }}@endif" class="nb-btn--close popup__btn--close search__btn--close js-close-popup js-popup-change-url">
        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52" viewBox="0 0 52 52">
            <g fill="none">
                <circle cx="26" cy="26" r="25" stroke-width="2" class="cls-close-circle"/>
                <path d="M36 34.572L34.572 36 26 27.429 17.429 36 16 34.572 24.572 26 16 17.429 17.429 16 26 24.572 34.572 16 36 17.429 27.429 26 36 34.572z"
                      class="cls-close-cross"/>
            </g>
        </svg>
    </a>
    <div class="popup__head">
        <div class="popup__head-center">
            <div class="nb-search-main">
                <input type="search" class="search-field__input js-search-field"
                       placeholder="Начинайте вводить что-нибудь"/>
            </div>
        </div>
    </div>

    <div class="popup__body popup__body--search display-none">
        <div class="popup__body-center search__body-center">
            <div class="popup__search-res cf"></div>
        </div>
    </div>

    <!-- start empty search results -->
    <div class="popup__body popup__body--empty display-none">
        <div class="popup__body-center search__body-center search__body-center--empty">
            <div class="popup__search-res search-res--empty cf">
                <div class="search-message">
                    <h2 class="nb-heading--large search__heading">Упс. Мы ничего не нашли.</h2>
                    <p class="search-message__txt">
                        К сожалению, по вашему запросу ничего не найдено. <br>Попробуйте еще раз или изучите то, <br>что
                        уже точно есть:
                    </p>
                    <a href="/projects?filter=favourite" class="nb-link search__link">Популярные проекты</a>
                    <a href="/projects?filter=start" class="nb-link search__link">Новые проекты</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end empty search results -->
</div>
<div class="overlayer overlayer--system js-add-video-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-popup-content">
            <div id="add-video" class="display-none js-video-block">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Видео проекта</h2>
                </div>
                <div class="nb-section__body popup-video__section__body">
                    <div class="popup-video__fields cf">
                        <div class="popup-video__field--left">
                            <div class="nb-input-wrap popup-video__input-wrap">
                                <input type="url" id="js-youtube-upload" name="" class="nb-input"
                                       placeholder="Укажите ссылку с YouTube или Vimeo">
                                <label for="js-add-video-url" class="nb-input-label popup-video__input-label">Вам
                                    необходимо предварительно загрузить свое видео на YouTube или Vimeo, а затем
                                    скопировать сюда ссылку на него.</label>
                            </div>
                        </div>
                        <div class="popup-video__field--right">
                            <button class="nb-btn nb-btn--add-media popup-system__btn js-add-video add-video-preview">
                                Добавить
                            </button>
                        </div>
                    </div>
                    <div class="popup-video__field-wrap js-video-player">
                    </div>
                </div>
            </div>
            <div id="apply-video" class="display-none js-video-block">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Sonic Youth — Mote</h2>
                </div>
                <div class="nb-section__body popup-video__section__body">
                    <div class="popup-video__fields cf">
                        <div class="popup-video__field--left">
                            <div class="nb-input-wrap popup-video__input-wrap">
                                <input type="url" id="js-add-video-url" name="" class="nb-input"
                                       placeholder="Добавьте Url видео с Youtube, Vimeo…"
                                       value="https://vimeo.com/video/69608564">
                            </div>
                        </div>
                        <div class="popup-video__field--right">
                            <button class="btn btn--add-media btn--small popup-system__btn popup-system__btn--input js-reload-video">
                                Обновить
                            </button>
                        </div>
                    </div>
                    <div class="popup-video__field-wrap js-video-player">
                        <div class="popup-video__field">
                            <div class="popup-video__player-wrap">
                            </div>
                        </div>
                        <!--						<button class="nb-btn nb-btn--add-media popup-system__btn js-add-video">Сохранить видео</button>-->
                        <button class="nb-btn nb-btn--add-media popup-system__btn js-add-video">Сохранить видео</button>
                    </div>
                </div>
            </div>
            <div id="view-video" class="display-none js-video-block">
                <div class="nb-section__head video-popup-title">
                    <h2 class="nb-heading--small section__heading--small js-popup-heading">Видеоообращение автора
                        проекта</h2>
                </div>
                <div class="nb-section__body popup-video__section__body">
                    <div class="popup-video__field-wrap js-video-player">
                        <div class="popup-video__field">
                            <div class="popup-video__player-wrap" id="popup-video__player-wrap">
                                <iframe id="js-popup-video-player" width="700" height="400" frameborder="0"
                                        webkitallowfullscreen mozallowfullscreen allowfullscreen src=""></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--system js-system-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-content"></div>
        <button class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--system js-info-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-popup-content">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Внимание!</h2>
            </div>
            <div class="nb-section__body popup-info__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt js-info-messages js-info-empty-email">
                    Для создания проекта необходимо указать свой email.
                </p>
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt js-info-messages js-info-confirmed-user-email">
                    Для создания проекта необходимо подтвердить свой email.
                </p>
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt js-info-messages js-info-manager">
                    Для запроса на изменение информации обратитесь к менеджеру.
                </p>
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt js-info-messages js-info-help">
                    Обучение будет добавлено в ближайшее время.
                </p>
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt js-info-messages js-info-postcreate-doc">
                    Если проект успешно пройдет модерацию, вам на почту будут отправлены договоры. Подписание договоров
                    будет происходить в офисе Улья. Данная процедура необходима для размещения проекта в Улье и открытия
                    временного счета в банке для сбора средств. Подробные инструкции будут отправлены после прохождения
                    модерации.
                </p>
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large nb-section__body js-info-messages js-request-change">
                    Для изменения верифицированных данных обратитесь к менеджерам проекта Улей по телефонам:<br> <a
                            href="tel:+375291323123" class="nb-link">+375 (29) 132 31 23</a>.
                </p>
            </div>
            <div class="nb-section__foot">
                <!-- 1st variant start -->
                <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Закрыть</button>
                <!-- 1st variant end -->
                <!-- 2nd variant start
                <button class="nb-btn nb-btn--add-media popup-system-info__btn">Подтвердить</button>
                <div class="popup-system-info__cancel">
                    <a href="#" class="nb-link popup-system-info__cancel__link">Отменить</a>
                </div>
                <!-- 2nd variant end -->
            </div>
        </div>

        <div class="js-info-prohibition-selection-gifts js-info-messages">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Внимание!</h2>
            </div>
            <div class="nb-section__body popup-info__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                    Автор проекта не может поддерживать свой же проект. Для привлечения финансирования расскажите о
                    своем проекте как можно большему количеству людей.
                </p>
            </div>
            <div class="nb-section__foot">
                <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Закрыть</button>
            </div>
        </div>

        <div class="js-info-preview-project-selection-gifts js-info-messages">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Предпросмотр</h2>
            </div>
            <div class="nb-section__body popup-info__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                    Вы находитесь в режиме предпросмотра. Данная страница была создана в ознакомительных целях. Выбор
                    подарка невозможен в данном режиме.
                </p>
            </div>
            <div class="nb-section__foot">
                <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Закрыть</button>
            </div>
        </div>

        <div class="js-info-prohibition-editing js-info-messages">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Внимание!</h2>
            </div>
            <div class="nb-section__body popup-info__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                    Обновление проекта находится на стадии модерации.
                </p>
            </div>
            <div class="nb-section__foot">
                <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Закрыть</button>
            </div>
        </div>

        <div class="js-info-additional-check js-info-messages">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Подписание договоров</h2>
            </div>
            <div class="nb-section__body popup-info__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                    Вам на электронный адрес были отправлены инструкции и копии договоров. Уточнить все детали вы можете
                    по телефону +375 (29) 132 31 23.
                </p>
            </div>
            <div class="nb-section__foot">
                <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Продолжить</button>
            </div>
        </div>
        <div class="js-info-confirmed-email js-info-messages">
            <div class="js-msg-confirmed-email">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Подтвердите свой email</h2>
                </div>
                <div class="nb-section__body popup-info__section__body">
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                        Чтобы связаться с автором, Вам необходимо подтвердить свой email.
                    </p>
                </div>
                <div class="nb-section__foot">
                    <button class="nb-btn nb-btn--add-media popup-system-info__btn" style="margin: 0 10px 0 0;"
                            onclick="window.location.href = '/settings?tab=access'; return false;">Подтвердить email
                    </button>
                    <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Закрыть</button>
                </div>
            </div>

            <div class="js-msg-set-email">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Укажите свой email</h2>
                </div>
                <div class="nb-section__body popup-info__section__body">
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                        Чтобы связаться с автором, необходимо указать свой email в "Настройках".
                    </p>
                </div>
                <div class="nb-section__foot">
                    <button class="nb-btn nb-btn--add-media popup-system-info__btn" style="margin: 0 10px 0 0;"
                            onclick="window.location.href = '/settings?tab=access'; return false;">Указать email
                    </button>
                    <button class="nb-btn nb-btn--add-media popup-system-info__btn js-close-popup">Закрыть</button>
                </div>
            </div>

            <div class="js-msg-login">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Войдите в систему</h2>
                </div>
                <div class="nb-section__body popup-info__section__body">
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                        Для того, чтобы связаться с пользователем, вам необходимо войти в систему.
                    </p>
                </div>
                <div class="nb-section__foot">
                    <a href="/login" class="nb-btn nb-btn--add-media popup-system-info__btn js-open-auth"
                       style="margin: 0 10px 0 0;" data-link-type="popup">Войти</a>
                    <div class="popup-system-info__cancel">
                        <a href="javascript:void(0)" class="nb-link popup-system-info__cancel__link js-close-popup">Отмена</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="nb-alert-container">
    <div class="nb-alert nb-alert--success js-alert-success" style="display: none;" id="js-alert-success">Данные успешно
        сохранены
    </div>
    <div class="nb-alert nb-alert--error js-alert-error" style="display: none;" id="js-alert-error">Внимание! Ошибка
        сохранения
    </div>
    <div class="nb-alert nb-alert--avatar js-alert-avatar" style="display: none;" id="js-alert-avatar">Неверный формат
        файла
    </div>
    <div class="nb-alert nb-alert--success js-alert-send" style="display: none;">Сообщение отправлено</div>
    <div class="nb-alert nb-alert--success js-alert-any-message js-alert-success-any-message @if(!$success) display-none @endif">{{ $success }}</div>
    <div class="nb-alert nb-alert--error js-alert-any-message js-alert-error-any-message @if(!$error) display-none @endif">{{ $error }}</div>
</div>
<div class="overlayer overlayer--system js-poll-popup">
    <div class="popup__block nb-section popup--system popup-system--poll">
        <div class="js-system-popup-content">
            <div class="nb-section__head poll__head">
                <h2 class="nb-heading--small section__heading--small">Опрос от куратора проекта</h2>
                <div class="poll__logo">
                    <svg class="poll__logo-img" xmlns="http://www.w3.org/2000/svg" width="70" height="25"
                         viewBox="0 0 182 65">
                        <g fill="none" fill-rule="evenodd">
                            <path fill="#3F3F3E"
                                  d="M137.473 51.41h-7.063V10.988c0-2.51-1.207-3.625-3.345-3.625-1.952 0-3.996.743-6.506 2.51v41.54h-7.07V1.227h7.06V4.48c2.05-1.95 4.74-3.81 8.65-3.81 3.623 0 6.04 1.488 7.34 4.09 2.51-2.137 5.483-4.09 9.572-4.09 5.483 0 8.27 3.347 8.27 8.83v41.91h-7.062V10.988c0-2.51-1.207-3.625-3.345-3.625-1.95 0-3.996.743-6.505 2.51v41.54m-35.62-8.458V26.402l-6.41 2.428c-2.604 1.02-3.44 2.32-3.44 5.2v7.62c0 2.415 1.208 3.622 3.438 3.622 2.137 0 4.09-.743 6.412-2.322zM84.93 33.94c0-6.226 2.044-8.735 7.434-10.593l9.48-3.253V11.73c0-2.974-1.488-4.554-4.46-4.554h-1.152c-2.974 0-4.46 1.58-4.46 4.554v7.107h-6.878V12.01c0-7.53 3.81-11.34 11.338-11.34h1.336c7.527 0 11.338 3.81 11.338 11.34v39.4h-7.063v-3.158c-1.95 1.858-4.553 3.717-8.642 3.717-5.67 0-8.27-3.26-8.27-8.83v-9.2zm-21.92 8.736c1.95 1.673 4.182 2.6 6.505 2.6 2.602 0 4.09-1.206 4.09-4.087V11.45c0-2.88-1.488-4.088-4.09-4.088-2.323 0-4.554.93-6.505 2.602v32.712zM55.95 1.228h7.062V4.48C64.685 2.716 67.566.67 71.654.67c6.04 0 9.015 3.997 9.015 9.945v31.41c0 5.948-2.98 9.944-9.02 9.944-4.09 0-6.97-1.96-8.64-3.63v16.19h-7.06V1.222zm-21.69 21.16h10.037V11.73c0-2.974-1.486-4.46-4.46-4.46h-1.115c-2.974 0-4.46 1.486-4.46 4.46v10.657zm-.022 6.8l.023 11.722c0 2.974 1.49 4.46 4.47 4.46h1.3c2.977 0 4.46-1.486 4.46-4.46v-5.762h6.88v5.484c0 7.527-3.81 11.337-11.336 11.337h-1.49c-7.53 0-11.34-3.81-11.34-10.46V12.89C27.2 4.48 31.01.67 38.537.67h1.487C47.55.67 51.36 4.48 51.36 12.01l-.022 17.178h-17.1z"/>
                            <path fill="#44BBC7"
                                  d="M18.146 5.85v9.228L6.26 26.405l11.886 11.123v9.43L0 29.9v-6.79L18.146 5.85m163.348 17.26v6.79l-18.146 17.058v-9.43l11.885-11.123-11.885-11.327V5.85l18.146 17.26"/>
                        </g>
                    </svg>
                </div>
            </div>
            <div class="nb-section__body popup-system__section__body poll__body js-poll">
                <form id="epamPoll" action="#" method="post">
                    {{ csrf_field() }}
                    <div class="nb-section__field">
                        <div class="poll__field">
                            <span class="poll__heading">Выберите свой вариант</span>
                        </div>
                        <div class="nb-input-radio-wrap poll__radio-wrap">
                            <input id="js-radio-1" type="radio" value="1" name="epam-poll"
                                   class="nb-input-radio js-radio">
                            <label for="js-radio-1" class="nb-input-radio-txt poll-radio-label">Я сотрудник EPAM</label>
                        </div>
                        <div class="nb-input-radio-wrap poll__radio-wrap">
                            <input id="js-radio-2" type="radio" value="2" name="epam-poll"
                                   class="nb-input-radio js-radio">
                            <label for="js-radio-2" class="nb-input-radio-txt poll-radio-label">Я бывший сотрудник
                                EPAM</label>
                        </div>
                        <div class="nb-input-radio-wrap poll__radio-wrap">
                            <input id="js-radio-3" type="radio" value="3" name="epam-poll"
                                   class="nb-input-radio js-radio">
                            <label for="js-radio-3" class="nb-input-radio-txt poll-radio-label">Я хочу работать в
                                EPAM!</label>
                        </div>
                        <div class="nb-input-radio-wrap poll__radio-wrap">
                            <input id="js-radio-4" type="radio" value="4" name="epam-poll"
                                   class="nb-input-radio js-radio">
                            <label for="js-radio-4" class="nb-input-radio-txt poll-radio-label">Не понимаю, о чём вы
                                :)</label>
                        </div>
                    </div>
                    <div class="nb-section__field">
                        <button type="submit" disabled="disabled"
                                class="nb-btn popup-system__btn poll__sumbit popup-system__btn--inactive js-continue js-interview-button">
                            Продолжить
                        </button>
                    </div>
                </form>
                <div class="poll__skip">
                    <a href="javascript:void(0);" class="poll__skip-link js-skip js-interview-button">Пропустить
                        опрос</a>
                </div>
            </div>
            <div class="nb-section__foot popup-system__section__foot">
                Данный опрос инициирован куратором проекта и является необязательным. Вы можете сразу перейти к оплате,
                нажав на ссылку «Пропустить&nbsp;опрос».
            </div>
        </div>
        <button type="button" class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--system js-about-popup">
    <div class="popup__block nb-section about-popup">
        <div class="js-system-popup-content">
            <div class="about-popup__head">
                <h2 class="about-popup__heading">Улей — это краудфандинг</h2>
                <h3 class="about-popup__subheading">Что такое краудфандинг?</h3>
                <p class="about-popup__caption">Краудфандинг (от англ. crowdfunding) — это способ коллективного
                    финансирования проектов, при котором деньги на создание продукта поступают от его конечных
                    потребителей.</p>
                <p class="about-popup__caption">Совместно с десятками и даже сотнями других людей вы можете
                    профинансировать понравившийся проект, получив взамен уникальные бонусы и вознаграждения, связанные
                    с результатами проекта.</p>
                <img width="468" height="395" class="about-popup__head__img" src="/img/pop_info.png"
                     srcset="/img/pop_info.png 1x, /img/pop_info@2x.png 2x"
                     alt="illustration — ulej book">
            </div>
            <div class="about-popup__body">
                <div class="cf">
                    <div class="about-popup__section">
                        <h3 class="about-popup__section__heading">Зачем мне это надо?</h3>
                        <p class="about-popup__section__caption">Улей — это возможность самостоятельно определять, какие
                            проекты должны быть реализованы.</p>
                        <p class="about-popup__section__caption">Почувствуйте себя издателем, продюсером, разработчиком,
                            соавтором или инвестором.</p>
                        <p class="about-popup__section__caption">Финансируйте проекты и пользуйтесь полученными
                            результатами.</p>
                    </div>
                    <div class="about-popup__section">
                        <h3 class="about-popup__section__heading">Eсли проект не соберет необходимую сумму?</h3>
                        <p class="about-popup__section__caption">В случае, если автор проекта не соберет заявленную
                            сумму, то все перечисленные вами деньги вернутся на вашу банковскую карту без каких-либо
                            комиссий со стороны банка.</p>
                        <p class="about-popup__section__caption">Финансовую безопасность обеспечивает ОАО «<a
                                    href="http://bgpb.by" class="nb-link" target="_blank">Белгазпромбанк</a>», платежную
                            систему которого использует Улей.</p>
                    </div>
                    <div class="about-popup__section">
                        <h3 class="about-popup__section__heading">Как поддержать проект?</h3>
                        <p class="about-popup__section__caption">Поддержать проект можно двумя способами: нажав кнопку
                            <strong>«Поддержать проект»</strong>, либо выбрав подарок на определенную сумму из
                            предложенного списка.</p>
                        <p class="about-popup__section__caption">Перечислить деньги очень просто — это займет у вас
                            буквально несколько минут.</p>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="about-popup__btn-close js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--system js-share-idea-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-popup-content">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Поделиться идеей</h2>
            </div>
            <div class="nb-section__body popup-share-idea__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                    Опишите в общих чертах свою идею. Мы обязательно с ней ознакомимся и свяжемся с вами.
                </p>
            </div>
            <div class="nb-section__body popup-feedback__section__body cf">
                <form action="/ask" id="js-share-idea-form">
                    {{ csrf_field() }}
                    <div class="info-page__ask-txt">
                        <div class="nb-textarea-wrap">
                            <textarea id="js-feedback-text" class="popup-feedback__textarea" name="idea_text"
                                      placeholder="Опишите свою идею"></textarea>
                        </div>
                    </div>
                    <div class="info-page__ask-user">
                        <div class="nb-input-wrap">
                            <input id="js-feedback-name-input" type="text" name="user_name" class="nb-input"
                                   placeholder="Ваше имя" value="">
                        </div>
                    </div>
                    <div class="info-page__ask-user">
                        <div class="nb-input-wrap">
                            <input id="js-feedback-contact-input" type="text" name="user_email" class="nb-input"
                                   placeholder="Email/Телефон">
                        </div>
                    </div>
                    <button type="submit" class="nb-btn form__btn-action">Поделиться идеей</button>
                </form>
            </div>
        </div>
        <button type="button" class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>
<div class="overlayer overlayer--system js-consult-popup">
    <div class="popup__block nb-section popup--system">
        <div class="js-system-popup-content">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Запись на консультацию</h2>
            </div>
            <div class="nb-section__body popup-consult__section__body">
                <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                    Вы можете записаться на бесплатную консультацию по телефонам: <a class="nb-link"
                                                                                     href="tel:+375291323123">+375 (29)
                        132 31 23</a>. Вы также можете отправить нам заявку, заполнив форму ниже:
                </p>
            </div>
            <div class="nb-section__body popup-feedback__section__body cf">
                <form action="/ask" id="js-consult-form">
                    {{ csrf_field() }}
                    <div class="info-page__ask-user">
                        <div class="nb-input-wrap">
                            <input id="js-feedback-name-input" type="text" name="user_name" class="nb-input"
                                   placeholder="Ваше имя" value="">
                        </div>
                    </div>
                    <div class="info-page__ask-user">
                        <div class="nb-input-wrap">
                            <input id="js-feedback-phone-input" type="text" name="user_phone" class="nb-input"
                                   placeholder="Номер телефона">
                        </div>
                    </div>
                    <button type="submit" class="nb-btn form__btn-action">Отправить заявку</button>
                </form>
            </div>
        </div>
        <button type="button" class="nb-btn--close-system js-close-popup">
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid"
                 viewBox="0 0 14 14">
                <path fill-rule="evenodd"
                      d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z"
                      class="cls-close-cross"/>
            </svg>
        </button>
    </div>
</div>