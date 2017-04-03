<div class="project__foot__content project__foot__content--comments cf">
    <div class="project__foot__left">
        <div class="project__comments">

            @cannot('comment', $project)
            <div class="nb-comment nb-comment--my cf">
                <div class="nb-comment__content">
                    <div class="nb-comment__message">

                        @if ($user)

                            Только спонсоры могут оставлять комментарии. Вы можете
                            <a href="#" onclick="location.href='{{ route('project.pay1', $project) }}'; return false;"
                               class="nb-link">поддержать проект</a>
                            или

                            <a href="javascript:void(0)" data-client="{{ $project->user_id }}"
                               class="nb-link js-open-message">задать вопрос</a>

                            напрямую автору.
                        @else

                            Только спонсоры могут оставлять комментарии. <a href="#"
                                                                            onclick="location.href='{{ route('project.pay1', $project) }}'; return false;"
                                                                            class="nb-link">Поддержите проект</a>, не
                            создавая учетной записи.


                        @endif
                    </div>
                </div>
            </div>

            @endcannot

            <div id="js-project-comment-block">
                @foreach ($project->comments as $comment)
                <div class="nb-comment cf">
                    <div class="nb-comment__author">
                        <div class="nb-comment__author__avatar-wrap">
                            <img class="js-open-bio" data-client="{{ $comment->user_id }}" width="52" height="52" src="{{ $comment->user->getAvatar('small') }}" alt="avatar">
                        </div>
                    </div>
                    <div class="nb-comment__content">
                        <a href="#" class="nb-comment__author-link js-open-bio" data-client="{{ $comment->user_id }}">
                            <strong class="nb-comment__author__name">{{ $comment->user->name }}</strong>
                        </a>
                        <div class="nb-comment__info">
                            <time class="nb-comment__info__date" datetime="">{{ $comment->created_at }}</time>
                        </div>
                        <div class="nb-comment__txt"> {{ $comment->comment }}</div>
                        @cannot('delete', $comment)
                            <div class="nb-comment__delete"><a href="javascript:void(0);" class="nb-link nb-comment__link js-remove-comment comment__delete" onclick="commentDelete(this, {{ $comment->id }});">Удалить</a></div>
                        @endcannot
                    </div>
                </div>
                @endforeach
            </div>

            @cannot('comment', $project)
            <div class="nb-comment nb-comment--my cf">
                <div class="nb-comment__author">
                    <div class="nb-comment__author__avatar-wrap">
                        <img id="js-author-avatar" width="52" height="52" src="{{ $user->getAvatar('small') }}" alt="avatar">
                    </div>
                </div>
                <div class="nb-comment__content">
                    <textarea id="js-comment-text" placeholder="Введите комментарий" class="nb-textarea nb-comment__textarea"></textarea>
                    <input id="js-author-name" type="hidden" value="{{ $user->name }}">
                    <input id="js-project-id" type="hidden" value="{{ $project->id }}">
                    <button id="js-send-comment" onclick="addCommentForProject({{ $project->user_id == $user->id ? 1 : 0}});" type="button" class="nb-btn nb-btn--add-media">Отправить</button>
                </div>
            </div>
            @endcan

        </div>
    </div>
</div>