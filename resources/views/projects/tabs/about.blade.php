<div class="project__foot__content project__foot__content--about cf">
    <div class="project__foot__left">
        <div class="project__foot__info">
            {!! $project->description_full or "<p>Здесь будет описание вашего проекта</p>" !!}
        </div>

        <div class="project__faq__content">
            @if ($user && $user->id && $user->id != $project->user->id)
                <button class="btn btn--add-media btn--small js-open-message" data-client="{{ $user->id }}">Задать вопрос</button>
            @elseif (!$user)
                <button class="btn btn--add-media btn--small  js-open-confirmed-email js-msg-login">Задать вопрос</button>
            @endif
        </div>

    </div>
</div>