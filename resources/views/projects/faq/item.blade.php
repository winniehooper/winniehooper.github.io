<div class='nb-create-details faq-number-{{ $model->id }}'>
    <div class='nb-create-details__inner'>
        <details class='nb-details nb-details--small faq-number-{{ $model->id }}'>
            <summary class='nb-summary nb-summary--small nb-summary--small-edit'>
                <svg xmlns='http://www.w3.org/2000/svg' width='8' height='14'
                     class='nb-summary-icon nb-summary-icon--small' preserveAspectRatio='xMidYMid' viewBox='0 0 8 14'>
                    <path fill-rule='evenodd' d='M1 1l5.398 5.714L1 12.429' class='cls-arrow-aquarium--round'/>
                </svg>
                <span class='question-text-faq'>{{ $model->question }}</span>
            </summary>
            <div class='nb-details-content'>
                <div class="nb-details-content-txt">
                    {{ $model->answer }}
                </div>
                <span class='nb-summary__edit'>
					<a href='javascript:void(0)' class='nb-link nb-summary__edit-link'
                       onclick='showEditFAQForm({{ $model->id }});'>Изменить</a>
					/
					<a href='javascript:void(0)' class='nb-link nb-summary__edit-link'
                       onclick='deleteFAQData({{ $model->id }}, 0);'>Удалить</a>
				</span>
                <input id='js-faq-question-{{ $model->id }}' type='hidden' value='Могу ли я скачивать музыку.'
                       name='faq[{{ $model->id }}][question]'/>
                <input id='js-faq-answer-{{ $model->id }}' type='hidden'
                       value='Для некоторых треков доступна загрузка. Ищите треки с пометкой.'
                       name='faq[{{ $model->id }}][answer]'/>
                <div class='nb-create-question__editing faq-edit-form' style='display: none;'>
                    <hr class='nb-create-media-divider'>
                    <div class='nb-input-wrap nb-create__input-wrap create-full-description__question'>
                        <input id='js-full-desc-question' type='text' class='nb-input' placeholder='Введите вопрос'
                               value='{{ $model->question }}'>
                    </div>
                    <div class='nb-textarea-wrap nb-create-full-description__answer'>
                        <textarea id='js-full-desc-answer' class='nb-textarea' placeholder='Введите ответ'>{{ $model->answer }}</textarea>
                    </div>
                    <button type='button' onclick='updateEditFAQInfo({{ $model->id }});'
                            class='nb-btn nb-btn--add-media create-full-description__btn--add-media'>Сохранить
                    </button>
                    <div class='nb-create-question__editing__cancel'>
                        <a href='javascript:void(0)' onclick='clearEditFAQForm({{ $model->id }});'
                           class='nb-link nb-create-question__editing__cancel__link'>Отменить</a>
                    </div>
                </div>
            </div>
        </details>
        <hr class="nb-create-media-divider">
    </div>
</div>