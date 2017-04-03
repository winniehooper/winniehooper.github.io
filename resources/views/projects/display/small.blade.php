<div class="card--small" xmlns="http://www.w3.org/1999/html">
    <div class="nb-card__preview">
        <img src="{{ $project->getImageUrl('small') }}" width="220" height="124" class="nb-card__img"
             alt="draft temporary card image">
        <a href="{{ route('project', $project) }}" class="nb-card__img-overlay"></a>
    </div>
    <div class="nb-card__content">
        <div class="nb-card__body">
            <h3 class="nb-card__head">
                <a href="{{ route('project', $project) }}" class="nb-card__head-link">{{ $project->name }}</a>
            </h3>
            <p class="nb-card__text">{{ $project->description_short }}</p>
        </div>
        <div class="nb-card__author">
            Минск
        </div>
        <div class="nb-card__foot">
            <progress class="nb-progress" value="{{ $project->collected_sum }}" max="{{ $project->needed_sum }}">
                <!-- fallback for progressbar, use if ie-->
            </progress>
            <div class="nb-card__res cf">
                <div class="nb-card__res__compl">
                    <strong class="nb-card__res__strong">{{ $project->collected_sum }}<sub> BYN </sub></strong>

                    <div class="nb-card__res__txt">Собрано ({{ $project->percent }}%)</div>
                </div>

                @if ($project->status == 'published')
                    <div class="nb-card__res__left">
                        <strong class="nb-card__res__strong">{{ $project->daysLeft }}</strong>
                        <div class="nb-card__res__txt">Осталось</div>
                    </div>
                @elseif($project->status == 'draft' or $project->status == 'moderation')
                    <div class="nb-card__res__finish">
                        <strong class="nb-card__res__strong nb-card__res__strong--gray">Черновик</strong>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>