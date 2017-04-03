<div class="nb-section__head">
    <h2 class="nb-heading--small section__heading--small">Новое сообщение</h2>
</div>
<div class="nb-section__body popup-system__section__body">
    <div class="nb-section__field">
        <a href="{{ route('profile', $target->id) }}" class="popup-system-message__user-img-clip">
            <img class="popup-system-message__user-img" src="{{ $target->getAvatar('small') }}" width="40" height="40" alt="avatar">
        </a>
        <div class="popup-system-message__user-info">
            <a href="{{ route('profile', $target->id) }}" class="popup-system-message__user-info__strong">{{ $target->name }}</a>
            <span class="popup-system-message__user-info__txt">Автор проекта</span>
        </div>
        <div class="clearfix"></div>
    </div>
    <form>
        <div class="nb-section__field">
            <div class="nb-textarea-wrap">
                <textarea id="js-message-text" class="nb-textarea popup-system__textarea" placeholder="Введите сообщение"></textarea>
            </div>
        </div>
        <div class="nb-section__field">
            <button type="button" data-client="{{ $target->id }}" class="nb-btn popup-system__btn js-send-message">Отправить сообщение</button>
        </div>
    </form>
</div>