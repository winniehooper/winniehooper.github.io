@extends('layouts.main')

@section('title', 'Настройки')

@section('scripts')
    <script type="text/javascript" src="/js/ajaxupload.3.5.js?2.3.7"></script>
@endsection


@section('overlays')
    <div class="overlayer overlayer--system js-password-popup">
        <div class="popup__block nb-section popup--system">
            <div class="js-system-popup-content">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Проверка безопасности</h2>
                </div>
                <div class="nb-section__body popup-password__section__body">
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt display-none js-password-popup-text change-email-text">
                        Введите пароль для подтверждения изменений.
                    </p>
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt display-none js-password-popup-text delete-account-text">
                        Введите пароль для подтверждения удаления аккаунта.
                    </p>
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt display-none js-password-popup-text delete-account-nopass-text">
                        Вы действительно хотите <b>безвозвратно</b> удалить Ваш аккаунт?
                    </p>
                    <div class="nb-input-wrap js-enter-pass-form-wrapper">
                        <form id="email_change">
                            {{ csrf_field() }}
                            <input type="hidden" name="new_email" value="" id="js-new-email-input">
                            <div class="nb-input-wrap">
                                <input type="password" name="password" class="nb-input popup-system-password__input" placeholder="Введите пароль">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="nb-section__foot">
                    <button class="nb-btn nb-btn--add-media popup-system-info__btn js-confirm-password">Подтвердить</button>
                    <div class="popup-system-info__cancel">
                        <a href="#" class="nb-link popup-system-info__cancel__link js-close-popup">Отменить</a>
                    </div>
                </div>
            </div>
            <button class="nb-btn--close-system js-close-popup">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" preserveAspectRatio="xMidYMid" viewBox="0 0 14 14"><path fill-rule="evenodd" d="M14 12.572L12.572 14 7 8.429 1.429 14 0 12.572 5.572 7 0 1.429 1.429 0 7 5.572 12.572 0 14 1.429 8.429 7 14 12.572z" class="cls-close-cross"/></svg>
            </button>
        </div>
    </div>
@endsection

@section('content')
<section class="settings-page">
    <div class="settings__inner client-settings-tab-links">
        <div class="settings__head">
            <div class="settings__nav">
                <ul class="nb-nav-underlined">
                    <li class="nb-nav-underlined__item"><a id="profile_control" href="javascript:void(0);" rel="#profile" data-pathname="" data-url="/get-settings-profile" data-tab-params="tab=profile" class="nb-link nb-nav-underlined__link @if($tab=='profile') nb-nav-underlined__link--active @endif"><span class="nb-nav-underlined__txt">Профиль</span></a></li>
                    <li class="nb-nav-underlined__item"><a id="access_control" href="javascript:void(0);" rel="#access" data-pathname="" data-url="/get-settings-access" data-tab-params="tab=access" class="nb-link nb-nav-underlined__link @if($tab=='access') nb-nav-underlined__link--active @endif"><span class="nb-nav-underlined__txt">Доступ</span></a></li>
                    <li class="nb-nav-underlined__item"><a id="notify_control" href="javascript:void(0);" rel="#notify" data-pathname="" data-url="/get-settings-notify" data-tab-params="tab=notify" class="nb-link nb-nav-underlined__link @if($tab=='notify') nb-nav-underlined__link--active @endif"><span class="nb-nav-underlined__txt">Уведомления</span></a></li>
                </ul>
            </div>
        </div>
        <div class="settings__body">
            <div id="settings-content" class="profile-settings-tab-block">
                @include('settings.tabs.'.$tab)
            </div>
        </div>
        <div class="new-project__foot cf">
            <hr class="new-project__foot-divider">
            <div class="new-project__foot__link-wrap">
                <a href="#" class="nb-link new-project__link--remove js-open-delete-account" style="display: none;">Удалить аккаунт</a>
            </div>
        </div>
    </div>
</section>
@endsection