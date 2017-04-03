<section class="super-project">
    <div class="super-project__inner">
        <div class="card--big">
            <!-- <div class="card--big"> -->
            <div class="nb-card__preview">
                <img width="520" height="292" class="nb-card__img" src="{{ $project->getImageUrl('promo') }}">
                <a href="/project?id=112671" class="nb-card__img-overlay"></a>
                <button type="button" class="video-icon-aqua--card js-open-video-popup js-open-video" data-show="#view-video" data-src="http://www.youtube.com/embed/tc2EOir1rm4" data-video-name="{{ $project->name }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="81" height="45" viewBox="0 0 81 45">
                        <g fill="none" fill-rule="evenodd"><rect width="80" height="45" fill="currentColor" rx="3"></rect>
                            <path fill="#FFF" d="M34 30V16l14 7"></path>
                        </g>
                    </svg>
                </button>
            </div>
            <div class="nb-card__content">
                <div class="nb-card__body">
                    <h3 class="nb-card__head header--s26">
                        <a href="/project?id=112671" class="nb-card__head-link">
                            {{ $project->name }}							</a>
                    </h3>
                    <p class="nb-card__text">
                        {{ $project->description_short }}
                    </p>
                </div>
                <div class="nb-card__foot">
                    <progress class="nb-progress" value="{{ $project->collected_sum }}" max="{{ $project->needed_sum }}">
                    </progress>
                    <div class="nb-card__res cf">
                        <div class="nb-card__res__compl">
                            <strong class="nb-card__res__strong">{{ $project->collected_sum }}<sub> BYN </sub></strong>
                            <div class="nb-card__res__txt">Собрано ({{ $project->percent }}%)</div>
                        </div>

                        <div class="nb-card__res__center">
                            <strong class="nb-card__res__strong">{{ $project->needed_sum }}<sub> BYN </sub></strong>
                            <div class="nb-card__res__txt">Цель</div>
                        </div>
                        <div class="nb-card__res__left">
                            <strong class="nb-card__res__strong">{{$project->daysLeft}}</strong>
                            <div class="nb-card__res__txt">Осталось</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
        </div>
    </div>
</section>