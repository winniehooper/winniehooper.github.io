<div id="comments" class="user__content user__content--comments">

    @forelse ($profile->comments as $comment)
        <div class="user__comment">
            <div class="user__comment__left">
                <svg xmlns="http://www.w3.org/2000/svg" class="user__comment__icon" width="24" height="29" viewBox="0 0 24 29"><path fill="none" class="cls-str-6" stroke-width="2" d="M11.998.997C5.925.997 1.002 5.93 1.002 12.016s4.923 11.019 10.996 11.019c.062 0 .124-.008.185-.009l.661 3.965 5.743-6.168c2.601-1.958 4.314-5.035 4.403-8.525.001-.093.002-.187.002-.282C22.992 5.93 18.07.997 11.998.997z"></path></svg>
            </div>
            <div class="user__comment__right">
                <div class="user__comment__head">
                    <a href="#" class="nb-link user__comment__date-link"><time class="user__comment__date" datetime="">{{ $comment->created_at }}</time></a>
                    <span class="user__comment__head__txt"> к проекту </span>
                    <a href="{{ route('project', $comment->project) }}" class="nb-link user__comment__strong"><strong class="user__comment__head__strong">{{ $comment->project->name }}</strong></a>
                </div>
                <div class="user__comment__body">
                    <div class="user__comment__txt">
                        {!! $comment->comment !!}
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="message--empty">
            <h4 class="nb-heading--large">Комментарии отсутствуют</h4>
        </div>
    @endforelse
</div>