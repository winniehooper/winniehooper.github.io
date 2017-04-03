<div class="settings__content settings__content--notify cf">
    <div class="settings__body__left">
        <section class="nb-section settings__section">
            <div class="nb-section__head"><h2 class="nb-heading--small section__heading--small">Уведомления по
                    email</h2></div>
            <div class="nb-section__body">
                <div class="settings__notify">
                    <div class="nb-input-check-wrap settings__notify__item"><input id="js-notify-input-my"
                                                                                   class="nb-input-check js-check-notify"
                                                                                   type="checkbox"
                                                                                   name="send_comments_flag" @if($user->settings['notifications']['send_comments_flag']) checked @endif>
                        <label for="js-notify-input-my" class="nb-input-check-txt">Хочу получать новые комментарии к
                            <strong>моим проектам</strong></label></div>
                    <div class="nb-input-check-wrap settings__notify__item"><input required id="js-notify-input-other"
                                                                                   class="nb-input-check js-check-notify"
                                                                                   type="checkbox"
                                                                                   name="send_other_comments_flag"
                                                                                   @if($user->settings['notifications']['send_other_comments_flag']) checked @endif> <label
                                for="js-notify-input-other" class="nb-input-check-txt">Хочу получать новые комментарии к
                            <strong>профинансированным проектам</strong></label></div>
                    <div class="nb-input-check-wrap settings__notify__item"><input required id="js-notify-input-news"
                                                                                   class="nb-input-check js-check-notify"
                                                                                   type="checkbox" name="send_news_flag"
                                                                                   @if($user->settings['notifications']['send_news_flag']) checked @endif> <label
                                for="js-notify-input-news" class="nb-input-check-txt">Хочу получать <strong>новости
                                проекта Ulej.by</strong></label></div>
                </div>
            </div>
        </section>
    </div>
</div>