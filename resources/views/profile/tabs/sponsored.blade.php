<div id="ownprojects " class="user__content user__content--cards cf">

    @forelse ($profile->sponsored as $project)
        @include('projects.display.small')
    @empty
        <div class="message--empty">
            <h4 class="nb-heading--large">Нет проектов</h4>
            <a href="/projects?filter=start" class="nb-link message--empty__link">Новые проекты</a>
        </div>
    @endforelse
</div>