@extends('layouts.main')

@section('title', 'Редактирование проекта')
@section('scripts')
    <script type="text/javascript" src="/js/ajaxupload.3.5.js?2.3.7"></script>
    <script type="text/javascript" src="/js/dropdown.js?2.3.7"></script>
@endsection

@section('overlays')
    <div class="overlayer overlayer--system js-delete-project-popup">
        <div class="popup__block nb-section popup--system">
            <div class="js-system-popup-content">
                <div class="nb-section__head">
                    <h2 class="nb-heading--small section__heading--small">Удаление черновика</h2>
                </div>
                <div class="nb-section__body popup-password__section__body">
                    <p class="nb-section__txt nb-section__txt--dark nb-section__txt--large popup-system-info__section__txt">
                        Вы действительно хотите удалить черновик?
                    </p>
                </div>
                <div class="nb-section__foot">
                    <a href="{{ url('project/'.$project->id.'/delete') }}">
                        <button class="nb-btn nb-btn--add-media popup-system-info__btn js-confirm-password js-delete--project-draft">
                            Удалить
                        </button>
                    </a>
                    <div class="popup-system-info__cancel">
                        <a href="javascript:void(0)"
                           class="nb-link popup-system-info__cancel__link js-close-popup">Отмена</a>
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
@endsection

@section('content')
    <section class="new-project-page">
        <form id="js-edit-project-form" class="edit-project-page-content">
            {{ csrf_field() }}
            <div class="new-project__bg">
                <div class="new-project__intro">
                    <h1 class="nb-heading--large new-project__heading--large">Черновик проекта</h1>
                    <p class="new-project__intro__text">Последовательно заполните все поля проекта.<br> Черновик будет храниться у вас в профиле, пока вы не отправите проект на модерацию.</p>
                </div>
                <div class="new-project__head">
                    <ul class="create__nav">
                        <li class="create__nav-item"><a href="#general-info" rel="#general-info" class="nb-link create__nav__link general-info-link">Общая информация</a></li>
                        <li class="create__nav-item"><a href="#awards-and-gifts" rel="#awards-and-gifts" class="nb-link create__nav__link awards-and-gifts-link">Список<br>лотов</a></li>
                        <li class="create__nav-item"><a href="#detailed-info" rel="#detailed-info" class="nb-link create__nav__link detailed-info-link">Подробная информация</a></li>
                        <li class="create__nav-item"><a href="#payment-info" rel="#payment-info" class="nb-link create__nav__link payment-info-link nb-create__nav__link--valid-val">Платёжная информация</a></li>
                        <li class="create__nav-item--with-button">
                            <button type="submit" formmethod="POST"
                                    formaction="{{ url('/project/'.$project->id.'/update') }}?status=1"
                                    class="btn create__nav__btn js-create-nav-btn btn--ghost create__nav__btn-more--inactive">Отправить на модерацию
                                <span class="nb-tooltip__content" style="text-align: left!important">Чтобы отправить проект на модерацию, необходимо заполнить все поля.</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="new-project__inner">
                <div class="new-project__body cf">
                    <div class="edit-project-content general-information" id="general-info">
                        <div class="new-project__left">
                            <section class="nb-create create--title project-edit-form">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Название проекта</h2>
                                </div>
                                <div class="nb-create__body">
                                    <div class="nb-input-wrap nb-create__input-wrap">
                                        <input id="js-project-title" type="text" name="project[name]" param="name" maxlength="60" class="nb-input js-ajax-project-update-info" placeholder="Введите название проекта" value = "{{ $project->name }}" >
                                    </div>
                                    <p class="nb-create-desc">Название должно быть лаконичным, уникальным и запоминающимся. Будьте уверены в том, что название проекта отражает его суть.</p>
                                </div>
                            </section>
                            <section class="nb-create create--description project-edit-form">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Краткое описание проекта</h2>
                                </div>
                                <div class="nb-create__body">
                                    <div class="nb-textarea-wrap">
                                        <textarea id="js-description-text" class="nb-textarea" placeholder="Коротко расскажите о проекте" name="project[description_short]" param="description_short">{{ $project->description_short }}</textarea>
                                        <span class="nb-textarea-count"><span class="js-description-entered">0</span> / 160 символов</span>
                                    </div>
                                    <p class="nb-create-desc">Опишите в одном предложении цель вашего проекта.</p>
                                </div>
                            </section>
                            <section class="nb-create create--category project-edit-form">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Категория проекта</h2>
                                </div>
                                <div class="nb-create__body">
                                    @include('projects.select', [
                                    'items'=> ['' => 'Выберите категорию'] + $categories,
                                    'label' => 'Выберите категорию',
                                    'value' => $project->category_id,
                                    'name' => 'project[category_id]',
                                    'id' => 'category_id',
                                    ])
                                </div>
                            </section>
                            <section class="nb-create create--location js-section-location project-edit-form">
                                <div id="js-create-map" class="nb-create__map-bg" style="display: none;">

                                </div>
                                <div class="nb-create__head nb-create-location__head">
                                    <h2 class="nb-heading--small create__heading--small">Локация проекта</h2>
                                </div>
                                <div class="nb-create__body">
                                    @include('projects.select', [
                                    'items'=> ['' => 'Выберите город'] + $locations,
                                    'label' => 'Локация проекта',
                                    'value' => $project->location,
                                    'name' => 'project[location]',
                                    'id' => 'location',
                                    ])
                                </div>
                            </section>
                            <section class="nb-create create--media project-edit-form">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Обложка проекта и видео</h2>
                                </div>
                                <div class="nb-create__body nb-create-media__body">
                                    <div class="nb-create__media--img js-create-media">
                                        <div class="nb-create__media__img-wrap_project_image">
                                            @if ($project->image)
                                                <img src="{{ $project->getImageUrl('promo') }}" width="630" height=" 354" alt="placeholder image" class="nb-create__media__img">
                                            @else
                                                <img src="{{ url('/img/create_img_bg.jpg') }}" width="630" height=" 354" alt="placeholder image" class="nb-create__media__img">
                                            @endif

                                        </div>
                                        <p id="status-upload-image"></p>
                                        <div class="nb-create__media__caption--bottom">
                                            <div class="nb-create__media__caption__btn-wrap">
                                                <button class="btn btn--small btn--add-media js-btn-add-media">
                                                    @if ($project->image)
                                                        Изменить обложку
                                                    @else
                                                        Добавить обложку
                                                    @endif
                                                </button>
                                            </div>
                                            <div class="nb-create__media__caption__txt--img">Это основное изображение вашего проекта.<br>JPG, PNG, GIF, BMP / Формат: 16х9 / Лимит: 5 Мб</div>
                                        </div>
                                        <input id="js-image-link-hidden" class="js-ajax-project-update-info" type="hidden" name="project[image]" param="image" value="{{ $project->image }}" />
                                    </div>
                                    <div class="nb-create__media--video">
                                        <div class="nb-create__media__video-preview">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="44" height="26" class="video-icon--create" preserveAspectRatio="xMidYMid" viewBox="0 0 44 26"><path fill-rule="evenodd" d="M4.15 1h35.7C41.58985 1 43 2.4650909 43 4.27272727V21.7272727C43 23.5349091 41.58985 25 39.85 25H4.15C2.41015 25 1 23.5349091 1 21.7272727V4.27272727C1 2.4650909 2.41015 1 4.15 1z" class="cls-border-gray9"/><path fill-rule="evenodd" d="M27 13l-8 4V9l8 4z" class="cls-triangle-gray9"/></svg>
                                            @if ($project->video_url)
                                                <img class="video-preview" src="{{ $project->getVideoPreview() }}" alt="" />
                                            @else
                                                <img class="video-preview" src="/img/create_img_bg.jpg" alt="" />
                                            @endif

                                        </div>
                                        <div class="nb-create__media__caption">
                                            <button type="button" data-show="#add-video" class="btn btn--add-media btn--small popup-system__btn js-open-video js-video-button">
                                                @if ($project->video_url)
                                                    Изменить видео
                                                @else
                                                    Добавить видео
                                                @endif
                                            </button>
                                            <div class="nb-create__media__caption__txt--video">Проекты с видео имеют больше шансов на успех!<br>Добавьте ссылку с YouTube или Vimeo.</div>
                                            <input id="js-preview-video-image" class="js-ajax-project-update-info" type="hidden" name="project[preview_url]" param="preview_url" value="{{ $project->preview_url }}"/>
                                            <input id="js-video-link" class="js-ajax-project-update-info" type="hidden" name="project[video_url]" param="video_url" value="{{ $project->video_url }}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="nb-create__foot">
                                    <hr class="nb-create-media-divider"/>
                                    <div class="nb-create-question">
                                        <a class="nb-link nb-create__link js-open-video js-open-video-popup" data-src="https://www.youtube.com/embed/wgEzP6uUvco" data-show="#view-video" data-video-name="Как снять видео" style="cursor:pointer">Как записать хорошее видео?</a>
                                    </div>
                                </div>
                            </section>
                            <section class="nb-create create--fund project-edit-form">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Бюджет и продолжительность кампании</h2>
                                </div>
                                <div class="nb-create__body">
                                    <div class="nb-create__fund cf">
                                        <div class="nb-create__money">
                                            <div class="nb-input-wrap">
                                                <input type="text" id="js-project-money" name="project[needed_sum]" param="needed_sum" class="nb-input nb-input--with-postfix" placeholder="Введите сумму" value="{{ $project->needed_sum }}"/>
                                                <span class="input-postfix">BYN</span>
                                            </div>
                                        </div>
                                        <div class="nb-create__time">
                                            <div class="nb-input-wrap">
                                                <input type="text" id="js-dd-time-proj" name="project[days_count]" param="days_count" alt="integer" class="nb-input js-ajax-project-update-info" placeholder="Дней" value="{{ $project->days_count }} "/>
                                            </div>
                                        </div>
                                        <div class="nb-create__time-caption">
                                            <span class="nb-create__time-txt">от 1 до 180 дней</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="nb-create__foot">
                                    <div class="nb-create-fund__info">
                                        <div class="nb-create-fund__commission">
                                            <strong class="nb-create-fund__value">0 BYN</strong>
                                            <span class="nb-create-fund__txt">Комиссионный сбор (10%)</span>
                                            <span class="nb-tooltip pay__tooltip__link">?<span class="nb-tooltip__content">Комиссионный сбор включает общую комиссию Улья, банка и платежной системы. Комиссия взимается со всей собранной суммы ТОЛЬКО в случае успешного окончания краудфандинговой кампании.</span></span>
                                        </div>
                                        <div class="nb-create-fund__income-tax">
                                            <strong class="nb-create-fund__value">0 BYN</strong>
                                            <span class="nb-create-fund__txt">Подоходный налог (13%)</span>
                                            <span class="nb-tooltip pay__tooltip__link">?<span class="nb-tooltip__content">Подоходный налог, взимаемый государством, составляет 13%. Стоит учитывать, что сумма в 4 947 руб. налогом не облагается. Уплату налога следует производить самостоятельно.</span></span>
                                        </div>
                                        <div class="nb-create-fund__final-sum">
                                            <strong class="nb-create-fund__value nb-create-fund__value--final">&asymp; <span class="js-create-final-sum">0</span> BYN</strong>
                                            <span class="nb-tooltip pay__tooltip__link">?<span class="nb-tooltip__content">Данный подсчет является приблизительным. Итоговая сумма может отличаться от указанной.</span></span>
                                        </div>
                                    </div>
                                    <hr class="nb-create-media-divider">
                                    <p class="nb-create-desc">Мы рекомендуем указывать минимальную сумму, необходимую для реализации проекта. Улей использует модель «все или ничего», а это значит, что для получение средств вам обязательно необходимо собрать от 100% и выше.<br><br>Обращаем ваше внимание на то, что Улей берет комиссию только с успешных проектов.</p>
                                </div>
                            </section>
                        </div>
                        <div class="new-project__right">
                            <section class="nb-create">
                                <div class="nb-create__head">
                                    <p class="create__status-message">Последнее сохранение
                                        <time class="js-date-temp-version" datetime="{{ $project->updated_at->format('Y.m.d H:i:s') }}">{{ $project->updated_at->format('d F Y в H:i:s') }}</time>
                                    </p>
                                </div>
                                <div class="nb-create__body cf">
                                    <a href="javascript:void(0);" class="btn btn--small btn--add-media btn--gray js-save-project-info">Сохранить</a><a href="javascript:void(0);" class="edit__btn--preview js-save-project-info-and-preview">Предпросмотр</a>
                                </div>
                            </section>	<section class="nb-create create--project">
                                <div class="nb-create__head nb-create-project__head">
                                </div>
                                <div class="nb-create__body nb-create-project__body">
                                    <div class="nb-card__preview">
                                        @if ($project->image)
                                            <img width="300" height="169" class="nb-card__img" src="{{ $project->getImageUrl('small') }} " alt="{{ $project->name or "Название вашего проекта" }}">
                                            @else
                                            <img width="300" height="169" class="nb-card__img" src="/img/card_tmp_bg.jpg" alt="{{ $project->name or "Название вашего проекта" }}">
                                            @endif;

                                    </div>
                                    <div class="nb-card__content">
                                        <div class="nb-card__body">
                                            <h3 class="nb-card__head" id="js-cart-tmp-project-name">{{ $project->name or "Название вашего проекта" }}</h3>
                                            <p class="nb-card__text">
                                                <span class="nb-card__text__tmp" id="js-cart-tmp-description">{{ $project->description_short or "Краткое описание вашего проекта" }}</span>
                                            </p>
                                        </div>
                                        <div class="nb-card__author"><a href="{{ url('profile/'.$project->user_id) }}" class="nb-card__author-name">{{ $project->user->name }}</a><span class="nb-card__author-location" id="js-card-tmp-location">{{ $project->location or "Локация проекта" }}</span></div>
                                        <div class="nb-card__foot">
                                            <progress class="nb-progress" value="0" max="0">
                                                <!-- fallback for progressbar, use if ie-->
                                            </progress>		<div class="nb-card__res cf">
                                                <div class="nb-card__res__compl">
                                                    <strong class="nb-card__res__strong">{{ $project->needed_sum or "0" }} BYN</strong>
                                                    <div class="nb-card__res__txt">Собрано (0%)</div>
                                                </div>
                                                <div class="nb-card__res__left">
                                                    <strong class="nb-card__res__strong">
					<span class="js-card-left-days" id="js-card-tmp-left-days">
				{{ $project->days_count or "0"}}</span> дней</strong>
                                                    <div class="nb-card__res__txt">Осталось</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nb-create__foot nb-create-project__foot">
                                </div>
                            </section>

                            <section class="nb-create create--help">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Помощь</h2>
                                </div>
                                <div class="nb-create__body create-help__body">
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Как мне создать хороший проект?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Мы подготовили для вас курс «Обучение краудфандингу», изучив который, вы<br />
                                                без проблем сможете привлечь финансирование с помощью «Улья».<br />
                                                <a href="/project/create/info" target="_blank" class="nb-link nb-create__link">Перейти к обучению</a>.</div>
                                        </div>
                                    </details>
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Зачем записывать видео?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Видео-обращение значительно повысит ваши шансы на успех. Это эффективный<br />
                                                инструмент, который позволит лично обратиться к потенциальным спонсорам,<br />
                                                рассказать о проекте и призвать к действию.</div>
                                        </div>
                                    </details>
                                </div>
                                <div class="nb-create__foot">
                                    <hr class="nb-create-status-divider">
                                    <div class="nb-create-question">
                                        <a href="javascript:void(0)" class="nb-link nb-create__link js-open-feedback-popup">Задать вопрос</a>
                                    </div>
                                </div>
                            </section>
                        </div>				</div>
                    <div class="edit-project-content awards-and-gifts" id="awards-and-gifts">
                        <div class="new-project__left">
                            <div class="new-project__temp-gift js-project-temp-gift">
                                <section class="nb-create create--gift js-temp-gift">
                                    <form id="js-add-gift-form">
                                        <div class="nb-create__body">
                                            <article class="section-group">
                                                <div class="nb-section__field">
                                                    <h2 class="nb-heading--small create__heading--small">Новый лот</h2>
                                                </div>
                                                <div class="lots__section-content">
                                                    <div class="nb-section__field cf">
                                                        <div class="nb-input-wrap input-wrap--33 nb-create__gift-sum">
                                                            <input type="text" class="nb-input input--with-postfix" id="js-gift-sum-input" alt="money" placeholder="Стоимость" value=""/>
                                                            <span class="input-postfix">BYN</span>
                                                        </div>
                                                    </div>
                                                    <div class="nb-section__field">
                                                        <div class="textarea-wrap nb-create__gift-description">
                                                            <textarea class="textarea" id="js-gift-description-textarea" placeholder="Описание лота"></textarea>
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
                                                        <input id="js-gift-count-limit-input" class="nb-input-check" type="checkbox" onclick="show_hideGiftCountInput(this);"
                                                               name="view_flag" value="1" aria-invalid="false">
                                                        <label for="js-gift-count-limit-input" class="nb-input-check-txt">Есть ограничение по количеству</label>
                                                    </div>
                                                    <div class="nb-section__field cf nb-create__gift-limit" style="display: none;">
                                                        <div class="nb-input-wrap input-wrap--33">
                                                            <input type="text" class="nb-input" id="js-gift-count-input" alt="integer" placeholder="Укажите лимит" value="" aria-invalid="false">
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
                                                <button type="button" onclick="addGift();" class="btn btn--small">Добавить</button>
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </div>
                            <div class="new-project__gifts js-project-gifts">
                                @foreach($project->gifts as $item)
                                    @include('projects.gift.item', ['model' => $item])
                                @endforeach
                            </div>
                            <input type="hidden" id="js-hidden-input-gifts-count" name="all-gifts-count" value="{{ count($project->gifts) }}"/>
                        </div>
                        <div class="new-project__right">
                            <section class="nb-create">
                                <div class="nb-create__head">
                                    <p class="create__status-message">Последнее сохранение
                                        <time class="js-date-temp-version" datetime="{{ $project->updated_at->format('Y.m.d H:i:s') }}">{{ $project->updated_at->format('d F Y в H:i:s') }}</time>
                                    </p>
                                </div>
                                <div class="nb-create__body cf">
                                    <a href="javascript:void(0);" class="btn btn--small btn--add-media btn--gray js-save-project-info">Сохранить</a><a href="javascript:void(0);" class="edit__btn--preview js-save-project-info-and-preview">Предпросмотр</a>
                                </div>
                            </section>	    <section class="nb-create create--help">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Помощь</h2>
                                </div>
                                <div class="nb-create__body create-help__body">
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Что такое лоты?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Лоты – это продукты, которые вы предлагаете в рамках крауд-кампании. Это то, ради чего люди перечисляют деньги в ваш проект.</div>
                                        </div>
                                    </details>
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Какие лоты лучше добавлять?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Если вы выводите на рынок новый продукт, то в качестве лота должен выступить сам продукт и его модификации. Если вы решили издать книгу, то лотом является ваша книга. Если вы организуете концерт или другое мероприятие, то лотами могут выступить билеты на мероприятие. Подробнее с нашими рекомендациями вы можете <br />
                                                <a href="/study/4" target="_blank" class="nb-link nb-create__link">ознакомиться здесь</a>.</div>
                                        </div>
                                    </details>
                                </div>
                                <div class="nb-create__foot">
                                    <hr class="nb-create-status-divider">
                                    <div class="nb-create-question">
                                        <a href="javascript:void(0)" class="nb-link nb-create__link js-open-feedback-popup">Задать вопрос</a>
                                    </div>
                                </div>
                            </section>
                        </div>				</div>
                    <div class="edit-project-content detailed-information" id="detailed-info">
                        <div class="new-project__left">
                            <section class="nb-create create--full-description project-edit-form">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Описание проекта</h2>
                                </div>
                                <div class="nb-create__body section__body--full-description">
                                    <div class="nb-textarea-wrap">
                                        <textarea id="editor" class="nb-textarea create-full-description__textarea js-ajax-project-update-info" name="project[description_full]" placeholder="Пара сотен слов о вашем проекте">{!! $project->description_full !!} </textarea>
                                    </div>
                                    <p class="nb-create-desc">Используйте описание проекта для того, чтобы подробнее рассказать о том, что и как вы собираетесь сделать. Добавьте картинки, фотографии и видео, чтобы более наглядно представить проект.</p>
                                </div>
                            </section>
                            <section class="nb-create create--faq">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Частые вопросы</h2>
                                </div>
                                <div class="nb-create__body nb-create__faq">
                                    <div class="nb-input-wrap nb-create__input-wrap_faq create-full-description__question">
                                        <input id="js-full-desc-question" type="text" class="nb-input" placeholder="Введите вопрос">
                                    </div>
                                    <div class="nb-textarea-wrap nb-create-full-description__answer" style="bottom: 10px">
                                        <textarea id="js-full-desc-answer" class="nb-textarea" placeholder="Введите ответ"></textarea>
                                    </div>
                                    <button type="button" onclick="addFAQ();" class="nb-btn nb-btn--add-media create-full-description__btn--add-media add-faq-btn">Добавить вопрос</button>
                                    <hr class="nb-create-media-divider nb-create-media-summary-divider" @if (!$project->faqs->count()) style="display: none" @endif>

                                    @foreach($project->faqs as $item)
                                        @include('projects.faq.item', ['model' => $item])
                                    @endforeach


                                </div>
                                <div class="nb-create__foot">

                                </div>
                            </section>
                        </div>
                        <div class="new-project__right">
                            <section class="nb-create">
                                <div class="nb-create__head">
                                    <p class="create__status-message">Последнее сохранение
                                        <time class="js-date-temp-version" datetime="18.02.2017 22:53:49">
                                            18 февраля 2017 в 22:53:49            </time>
                                    </p>
                                </div>
                                <div class="nb-create__body cf">
                                    <a href="javascript:void(0);" class="btn btn--small btn--add-media btn--gray js-save-project-info">Сохранить</a><a href="javascript:void(0);" class="edit__btn--preview js-save-project-info-and-preview">Предпросмотр</a>
                                </div>
                            </section>	    <section class="nb-create create--help">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Помощь</h2>
                                </div>
                                <div class="nb-create__body create-help__body">
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Что должно быть в описании?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Специально для вас мы подготовили рекомендации для написания грамотного<br />
                                                и эффективного описания.<br />
                                                <a href="/project/create/info?page=2" target="_blank" class="nb-link nb-create__link">Перейти к рекомендациям</a>.</div>
                                        </div>
                                    </details>
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Что такое «Частые вопросы»?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">«Частые вопросы» – это блок, в котором вы можете заранее ответить на<br />
                                                наиболее очевидные вопросы, которые могут возникнуть у потенциальных спонсоров в процессе знакомства с вашим проектом.</div>
                                        </div>
                                    </details>
                                </div>
                                <div class="nb-create__foot">
                                    <hr class="nb-create-status-divider">
                                    <div class="nb-create-question">
                                        <a href="javascript:void(0)" class="nb-link nb-create__link js-open-feedback-popup">Задать вопрос</a>
                                    </div>
                                </div>
                            </section>
                        </div>				</div>
                    <div class="edit-project-content payment-information" id="payment-info">
                        <div class="new-project__left">
                            <section class="nb-create create--personal project-edit-form ">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small section__heading--small">Личные данные</h2>
                                    <p class="nb-create-desc create__head__desc">Чтобы Улей мог заключить с вами договор, необходимо заполнить паспортные данные. Информация, которую вы передаете в Улей, является конфиденциальной и не подлежит разглашению.</p>
                                </div>
                                <div class="nb-create__body">
                                    <hr class="popup__divider settings__divider">
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap nb-section__field">
                                            <input id="js-settings-surname" type="text" name="user[last_name]" param="last_name" class="nb-input js-ajax-client-update-info" placeholder="Фамилия" value="{{ $project->user->last_name }}">
                                        </div>
                                    </div>
                                    <div class="nb-section__field cf">
                                        <div class="nb-input-wrap settings__input-wrap--name">
                                            <input id="js-settings-name" type="text" name="user[first_name]" param="first_name" class="nb-input js-ajax-client-update-info" placeholder="Имя" value="{{ $project->user->first_name }}">
                                        </div>
                                        <div class="nb-input-wrap settings__input-wrap--fname">
                                            <input id="js-settings-fname" type="text" name="user[patronymic]" param="patronymic" class="nb-input js-ajax-client-update-info" placeholder="Отчество" value="{{ $project->user->patronymic }}">
                                        </div>
                                    </div>
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap nb-input-wrap-date js-get-dob-wrap">
                                            <input required id="datetimepicker" type="text" name="user[dt_birth]" param="dt_birth" placeholder="Дата рождения" class="nb-input nb-input-date js-ajax-client-update-info" value="{{ $project->user->dt_birth }}">
                                            <svg class="nb-input__icon-date" xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path class="cls-calendar" fill-rule="evenodd" d="M20 17H0V1h2V0h2v1h12V0h2v1h2v16zM18 3H2v12h16V3zM7 8H5V6h2v2zm0 4H5v-2h2v2zm4-4H9V6h2v2zm0 4H9v-2h2v2zm4-4h-2V6h2v2zm0 4h-2v-2h2v2z"/></svg>
                                        </div>
                                    </div>
                                    <hr class="popup__divider settings__divider">
                                    <div class="nb-section__field">

                                         @include('projects.select', [
                                            'items'=> ['' => 'Выберите тип документа'] + $docs,
                                            'label' => 'Выберите категорию',
                                            'value' => $project->user->type_doc_id,
                                            'name' => 'user[type_doc_id]',
                                            'id' => 'type_doc_id',
                                            ])

                                    </div>
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap">
                                            <input id="js-settings-series-and-number-doc" type="text" name="user[doc_series]" param="doc_series" class="nb-input js-ajax-client-update-info" placeholder="Серия и номер" value="{{ $project->user->doc_series }}">
                                            <label for="js-settings-series-and-number-doc" class="nb-input-label">Пример: MР1234567</label>
                                        </div>
                                    </div>
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap">
                                            <input id="js-settings-personal-num" type="text" name="user[personal_num]" param="personal_num" class="nb-input js-ajax-client-update-info" placeholder="Личный номер" value="{{ $project->user->personal_num }}">
                                            <label for="js-settings-personal-num" class="nb-input-label">Пример: 1234567A002PB9</label>
                                        </div>
                                    </div>
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap nb-create__input-wrap">
                                            <input id="js-settings-document-issued" type="text" name="user[doc_who_issued]" param="doc_who_issued" class="nb-input js-ajax-client-update-info" placeholder="Кем и когда выдан" value="{{ $project->user->doc_who_issued }}">
                                            <label for="js-settings-document-issued" class="nb-input-label">Пример: Советское РУВД г.Минска, выдан 22.04.2015</label>
                                        </div>
                                    </div>
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap nb-create__input-wrap">
                                            <input id="js-settings-passport-address" type="text" name="user[registration]" param="registration" class="nb-input js-ajax-client-update-info" placeholder="Адрес регистрации" value="{{ $project->user->registration }}">
                                            <label for="js-settings-passport-address" class="nb-input-label">Пример: г.Минск, ул. Е. Полоцкой, д.3, кв. 16</label>
                                        </div>
                                    </div>
                                    <div class="nb-section__field">
                                        <div class="nb-input-wrap nb-create__input-wrap">
                                            <input id="js-settings-phone" type="text" name="user[phone]" param="phone" class="nb-input js-ajax-client-update-info" placeholder="Контактный номер" value="{{ $project->user->phone }}">
                                            <label for="js-settings-phone" class="nb-input-label">Пример: +375 (29) 123 45 67</label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="new-project__right">
                            <section class="nb-create">
                                <div class="nb-create__head">
                                    <p class="create__status-message">Последнее сохранение
                                        <time class="js-date-temp-version" datetime="18.02.2017 22:53:49">
                                            18 февраля 2017 в 22:53:49            </time>
                                    </p>
                                </div>
                                <div class="nb-create__body cf">
                                    <a href="javascript:void(0);" class="btn btn--small btn--add-media btn--gray js-save-project-info">Сохранить</a><a href="javascript:void(0);" class="edit__btn--preview js-save-project-info-and-preview">Предпросмотр</a>
                                </div>
                            </section>	    <section class="nb-create create--help">
                                <div class="nb-create__head">
                                    <h2 class="nb-heading--small create__heading--small">Помощь</h2>
                                </div>
                                <div class="nb-create__body create-help__body">
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Зачем вводить номер счета?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Номер счета необходим для перечисления средств в случае успеха вашей<br />
                                                краудфандинговой кампании.</div>
                                        </div>
                                    </details>
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Зачем вводить паспортные данные?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Для публикации проекта и сбора средств вам необходимо заключить<br />
                                                договоры с «Ульем» и ОАО «Белгазпромбанком». Ваши данные необходимы<br />
                                                для формирования договоров.</div>
                                        </div>
                                    </details>
                                    <details class="nb-details nb-details--small">
                                        <summary class="nb-summary nb-summary--small"><svg xmlns="http://www.w3.org/2000/svg" width="8" height="14" class="nb-summary-icon nb-summary-icon--small" preserveAspectRatio="xMidYMid" viewBox="0 0 8 14"><path fill-rule="evenodd" d="M1 1l5.398 5.714L1 12.429" class="cls-arrow-aquarium--round"/></svg>Кому доступны мои данные?</summary>
                                        <div class="nb-details-content">
                                            <div class="nb-details-content-txt">Ваши данные будут использоваться исключительно для вашей идентификации и<br />
                                                формирования договоров. Доступ третьих лиц к вашим данным исключен.</div>
                                        </div>
                                    </details>
                                </div>
                                <div class="nb-create__foot">
                                    <hr class="nb-create-status-divider">
                                    <div class="nb-create-question">
                                        <a href="javascript:void(0)" class="nb-link nb-create__link js-open-feedback-popup">Задать вопрос</a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <input id="js-project-id" type="hidden" name="projectId" value="{{ $project->id }}"/>
                <input id="js-client-id" type="hidden" name="clientId" value="{{ Auth::user()->id }}">
                <div class="new-project__foot cf">
                    <hr class="new-project__foot-divider">
                    <div class="new-project__foot__save-wrap">
                        <button type="button" class="btn btn--add-media btn--small nb-btn--gray js-save-project-info">Сохранить черновик</button>
                        <div class="new-project__foot__save__txt">Последнее сохранение
                            <time class="js-date-temp-version" datetime="{{ $project->updated_at->format('Y.m.d H:i:s') }}">{{ $project->updated_at->format('d F Y в H:i:s') }}</time>
                        </div>
                    </div>

                    <div class="new-project__foot__link-wrap">
                        <a href="javascript:void(0)" class="nb-link new-project__link--remove js-open-delete-project-popup">Удалить черновик</a>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
