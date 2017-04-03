<div class="head__user">
    <span class="welcome-text">Привет</span>
    <span class="head__username">
						<a href="{{ url('profile', ['id'=>$user->id]) }}" class="head__user__label">{{ $user->name }}</a>
						<a href="javascript:void(0)" class="head__user__avatar js-open-menu" onclick="return false;">
							<span class="head__user__avatar-cut">
								<img class="head__user__avatar-img" src="{{ $user->getAvatar('small') }}" alt="avatar" width="40" height="40">
							</span>
							<svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" class="head__usermenu-icon" preserveAspectRatio="xMidYMid" viewBox="0 0 8 8"><path fill-rule="evenodd" d="M.009 7.988h7.983V.005C6.063 3.304 3.308 6.059.009 7.988z" class="cls-C"></path></svg>
						</a>
					</span>
    @if (count($user->unreadNotifications ))
    <a href="/notifications" class="head__notify js-notify">
        <span class="head__notify__txt js-notify-txt">{{ count($user->unreadNotifications) }}</span>
    </a>
    @endif
    <div class="menu js-menu" style="display: none;">
        <ul class="menu-list">
            <li class="menu-item"><a href="{{ url('profile', ['id'=>$user->id]) }}" class="menu-link">Профиль</a></li>
            <li class="menu-item">
                <a href="/notifications" class="menu-link">
                    Уведомления
                    @if (count($user->unreadNotifications))<span class="unread">{{ count($user->unreadNotifications ) }}</span>@endif
                </a>
            </li>
            <li class="menu-item"><a href="/donations" class="menu-link">История платежей</a></li>
            <li class="menu-item"><a href="/settings" class="menu-link">Настройки</a></li>

            @foreach ($user->draftProjects as $project)
            <li class="menu-item menu-item--proj proj--draft">
                <a href="{{ route('project', $project->id) }}" class="menu-proj__info proj-info--draft js-proj-draf-{{ $project->id }}">
                    <span class="menu-proj__name proj__name--draft">{{ $project->name or "Без названия" }}</span>
                    <span class="menu-proj__caption">{{ $project->statusName }}</span>
                </a>
            </li>
            @endforeach

            <li class="menu-item"><a href="/logout" class="menu-link menu-link--exit">Выход</a></li>
        </ul>
    </div>
</div>