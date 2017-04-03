<div class="settings__content settings__content--access cf" xmlns="http://www.w3.org/1999/html">
    <div class="settings__body__left">
        <section class="nb-section settings__section">
            <div class="nb-section__head"><h2 class="nb-heading--small section__heading--small">Изменить email</h2>
            </div>

            <div class="nb-section__body">
                <div class="settings__email--new">
                    <form id="setting_new_email"><p class="nb-section__txt settings__email__txt"> Сейчас вы
                            используете электронный адрес {{ $user->emailObfuscated }} </p>
                        <div class="nb-input-wrap nb-section__field"><input id="js-set-email" type="email"
                                                                            class="nb-input"
                                                                            placeholder="Введите новый email" value=""
                                                                            name="new_email">
                        </div>

                        <button class="nb-btn nb-btn--add-media ">Изменить</button>

                    </form>

                </div>

            </div>

        </section>

        <section class="nb-section settings__section">
            <div class="nb-section__head"><h2 class="nb-heading--small section__heading--small">Изменить пароль</h2>
            </div>

            <div class="nb-section__body">
                <div class="settings__password--new cf">
                    <div class="settings__password__left">
                        <form id="js-password-change" class="settings__password__form" action="#" method="post">
                            <div class="nb-input-wrap nb-section__field"><input type="password" name="old_password"
                                                                                class="nb-input"
                                                                                placeholder="Старый пароль" value="">
                            </div>

                            <div class="nb-input-wrap nb-section__field"><input type="password" name="new_password"
                                                                                class="nb-input"
                                                                                placeholder="Новый пароль" value=""
                                                                                id="js_new_password">
                            </div>

                            <div class="nb-input-wrap nb-section__field"><input type="password"
                                                                                name="new_password_confirm"
                                                                                class="nb-input"
                                                                                placeholder="Повторите новый пароль"
                                                                                value="">
                            </div>

                            <div class="nb-section__field">
                                <button type="submit" class="nb-btn nb-btn--add-media">Изменить пароль</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </section>

    </div>

    <div class="settings__body__right">
        <section class="nb-section settings__section">
            <div class="nb-section__head">
                <h2 class="nb-heading--small section__heading--small">Социальныеаккаунты</h2>
            </div>

            <div class="nb-section__body">
                <div class="nb-section__field settings__section__social">
                    <ul class="nb-social-items settings__social-items">
                        <li class="nb-social-item settings__social-item"><a
                                    href="https://oauth.vk.com/authorize?client_id=4885458&redirect_uri=http://www.ulej.by/vkontakte-auth&response_type=code&scope=email"
                                    data-id="13738457" data-name="vk"
                                    class="social-link social-link--vk settings__social-link settings__social-link--vk js-social-link ">
                                @include('profile.social.vk')
                                <span class="social-link__status social-link__status--connected">Подключено</span>
                                <span class="social-link__status social-link__status--disconnected">Отключить</span>
                            </a>
                        </li>

                        <li class="nb-social-item settings__social-item"><a
                                    href="https://www.odnoklassniki.ru/oauth/authorize?client_id=1134023168&redirect_uri=http://www.ulej.by/odnoklassniki-auth&response_type=code&scope=VALUABLE_ACCESS"
                                    class="social-link social-link--ok settings__social-link settings__social-link--ok social-link--disconnected">
                                @include('profile.social.ok')
                                <span class="social-link__status">Подключить</span> </a>
                        </li>

                        <li class="nb-social-item settings__social-item"><a
                                    href="https://www.facebook.com/dialog/oauth?client_id=460037110820118&redirect_uri=http://www.ulej.by/facebook-auth&response_type=code&scope=email,user_about_me"
                                    data-id="10212117356115002" data-name="fb"
                                    class="social-link social-link--fb settings__social-link settings__social-link--fb js-social-link ">
                                @include('profile.social.fb')
                                <span class="social-link__status social-link__status--connected">Подключено</span>
                                <span class="social-link__status social-link__status--disconnected">Отключить</span>
                            </a>
                        </li>

                        <li class="nb-social-item settings__social-item"><a
                                    href="https://accounts.google.com/o/oauth2/auth?client_id=435568484419-9q14smgiiesse9mucpjgk0220jkp8bt8.apps.googleusercontent.com&redirect_uri=http://www.ulej.by/google-auth&response_type=code&scope=https://www.googleapis.com/auth/userinfo.email"
                                    class="social-link social-link--gp settings__social-link settings__social-link--gp social-link--disconnected">
                                @include('profile.social.gp')
                                <span class="social-link__status">Подключить</span> </a>
                        </li>

                    </ul>

                </div>
                <p class="nb-section__txt">Подключите социальные аккаунты, чтобы повысить доверие к себе и своим
                    проектам.</p>
            </div>

        </section>

    </div>

</div>