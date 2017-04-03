<section class="nb-section pay-gifts__section pay-gift-info-block gift-number-{{ $model->id }}">
    <div class="nb-section__head">
        <strong class="donate__strong">{{ $model->sum }} BYN</strong>
    </div>
    <div class="nb-section__body cf">
        <div class="section__body__left">
            <p class="donate__description">{{ $model->description }}</p>
            <div class="donate__status donate__status--available">
                @if ($model->count)
                <span class="js-available-gifts"> Осталось {{ $model->leftCount }} из {{ $model->count }}</span>
                @endif
            </div>
            <div class="create__gift__edit">
                <button type="button" onclick="showEditGiftForm({{ $model->id }});" class="btn btn--small">Изменить</button>
                <a href="javascript:void(0);" onclick="deleteGiftData({{ $model->id }}, 0);"
                   class="nb-link create-gift__link--remove">Удалить</a>
            </div>
        </div>
    </div>
    <input class='js-gift-sum' type='hidden' name='gift[{{ $model->id }}][sum]' value='{{ $model->sum }}'/>
    <input class='js-short-description-gift' type='hidden' name='gift[{{ $model->id }}][description]' value='Подписка на год'/>
    <input class='js-gift-count' type='hidden' name='gift[{{ $model->id }}][count]' value='{{ $model->count }}'/>
</section>
<section class="nb-create create--gift pay-gift-edit-block gift-number-{{ $model->id }}" style='display: none'>
    <div class="nb-create__body">
        <article class="section-group">
            <div class="nb-section__field">
                <h2 class="nb-heading--small create__heading--small">Редактирование лота</h2>
            </div>
            <div class="lots__section-content">
                <div class="nb-section__field cf">
                    <div class="nb-input-wrap input-wrap--33 nb-create__gift-sum">
                        <input required type="number" class="nb-input input--with-postfix js-gift-sum-edit-form"
                               placeholder="Стоимость"
                               value='{{ $model->sum }}'/>
                        <span class="input-postfix">BYN</span>
                    </div>
                </div>
                <div class="nb-section__field">
                    <div class="textarea-wrap nb-create__gift-description">
                        <textarea class='textarea' placeholder='Описание лота'>{{ $model->description }}</textarea>
                    </div>
                </div>
            </div>
        </article>
        <hr class="divider create__divider">
        <article class="section-group">
            <div class="nb-section__field">
                <h2 class="nb-heading--small create__heading--small">Количество</h2>
            </div>
            <div class="lots__section-content">
                <div class="nb-section__field nb-input-check-wrap">
                    <input id="js-gift-count-limit-input-edit-{{ $model->id }}" class="nb-input-check js-gift-count-limit-input-edit"
                           type="checkbox" name="view_flag" onclick="show_hideGiftCountInput(this);" value="{{ $model->count > 0 }}"
                           aria-invalid="false" @if ($model->count > 0) checked @endif>
                    <label for="js-gift-count-limit-input-edit-{{ $model->id }}" class="nb-input-check-txt">Есть ограничение по количеству</label>
                </div>
                <div class="nb-section__field cf nb-create__gift-limit" @if ($model->count == 0) style="display: none;" @endif>
                    <div class="nb-input-wrap input-wrap--33">
                        <input type="number" class="nb-input" alt="integer" placeholder="Укажите лимит" value="{{ $model->count }}"
                               aria-invalid="false">
                    </div>
                    <div class="nb-input-wrap lots__tooltip-wrap input-wrap--66">
                        							<span class="tooltip-wrap">
								 <span class="tooltip">?
									<span class="tooltip__content lots__tooltip__content">Введите количественное ограничение для лота</span>
								 </span>
							</span>
                    </div>
                </div>
            </div>
        </article>
        <hr class="divider create__divider">
        <div class="create__gift__edit">
            <button type="button" onclick="updateEditGiftInfo({{ $model->id }});" class="btn btn--small">Сохранить</button>
            <button type="button" onclick="clearEditGiftForm({{ $model->id }})"
                    class="btn btn--small btn--ghost donate__btn-cancel">Отменить
            </button>
            <a href="javascript:void(0);" onclick="deleteGiftData({{ $model->id }}, 0);"
               class="nb-link create-gift__link--remove">Удалить</a>
        </div>
    </div>
</section>