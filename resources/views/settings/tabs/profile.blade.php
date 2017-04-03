<div class="settings__content settings__content--profile cf">
    <div class="settings__body__left">
        <form id="client_form" class="settings__form" action="/settings" method="post" autocomplete="off">
            {{ csrf_field() }}
            <section class="nb-section settings__section">
                <div class="nb-section__head"><h2 class="nb-heading--small section__heading--small">Личные данные</h2>
                </div>
                <div class="nb-section__body">
                    <div class="nb-input-wrap nb-section__field"><input id="js-name-field" type="text" name="name"
                                                                        class="nb-input" placeholder="Имя Фамилия"
                                                                        value='{{ $user->name }}' ></div>
                    <div class="nb-textarea-wrap nb-section__field"><textarea id="js-about-text"
                                                                              class="settings__textarea--about"
                                                                              name="information"
                                                                              placeholder="Пару слов о себе"
                                                                              maxlength="2000">{{ $user->information }}</textarea></div>
                    <div class="nb-input-wrap nb-section__field"><input id="js-location-field" type="text"
                                                                        name="residency" class="nb-input"
                                                                        placeholder="Страна, Город" value='{{ $user->residency }}'></div>
                    <div>
                        <button class="nb-btn nb-btn--add-media" type="submit" value="Submit">Сохранить</button>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <div class="settings__body__right">
        <section class="nb-section settings__section settings__section--avatar">
            <div class="nb-section__head settings__section-avatar__head">
                <div class="settings__section-avatar-container js-avatar-container"><img width="160" height="160"
                                                                                         src="{{ $user->getAvatar('promo') }}"
                                                                                         alt="avatar"/></div>
            </div>
            <div class="nb-section__body">
                <button class="btn btn--small settings__section-avatar__btn js-add-avatar">Загрузить аватар</button>
                <p class="nb-section__txt">Вы можете загрузить изображение в формате JPG, GIF, BMP, PNG, JPEG, JPEG2000,
                    JPE. Максимальный размер файла – 5 Мб.</p></div>
        </section>
        <section class="nb-section settings__section settings__section--website">
            <div class="nb-section__head"><h2 class="nb-heading--small section__heading--small">Веб-сайты</h2></div>
            <div class="nb-section__body js-websites-container">
                <div class="nb-section__field settings__field--website cf">
                    <form id="js-add-website-form">
                        <div class="nb-input-wrap settings__input-wrap--website"><input id="js-website-field"
                                                                                        type="text" class="nb-input"
                                                                                        placeholder="Адрес сайта"
                                                                                        value="" name="website"></div>
                        <button class="nb-btn nb-btn--add-media settings__btn-plus">+</button>
                    </form>
                </div>
                @foreach($user->webSites as $site)
                <div class="nb-section__field js-website">
                    <div class="nb-input settings__website">
                        <div class="settings__website__value">{{ $site->website_url }}</div>
                        <a class="settings__website__action js-remove-website" href="#"
                           onclick="return deleteWebsite(this, {{ $site->id }})">Удалить</a></div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>