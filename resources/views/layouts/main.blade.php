<!DOCTYPE html>
<html class="no-js" lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - {{ config('app.name') }}</title>

    @include('parts.styles')
    @include('parts.scripts')
    @yield('scripts')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

    @include('parts.header-counters')
</head>
<body class="body--bg">

<header class="head js-head">
    <div class="head__inner cf">
        <div class="head__main">
            <a href="/" class="head__logo">
                <img src="/img/logo.png" alt="Supolka Logo" class="head__logo-icon">
            </a>
            <nav class="head__nav">
                <ul>
                    <li class="head__item">
                        <a href="/projects" class="nb-link head__link">Проекты</a>
                    </li>
                    <li class="head__item">
                        <a href="/project/create/info" class="nb-link head__link">Создать проект</a>
                    </li>
                    <li class="head__item">
                        <a href="/search" class="nb-link head__link js-open-search" data-link-type="popup">Поиск
                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="14" class="head__search-icon"
                                 preserveAspectRatio="xMidYMid" viewBox="0 0 13 14">
                                <path fill-rule="evenodd"
                                      d="M11.916 11.084c.622.183 1.084.735 1.084 1.416 0 .828-.672 1.5-1.5 1.5-.681 0-1.233-.462-1.416-1.084C9.462 12.733 9 12.181 9 11.5c0-.132.043-.251.075-.373C8.173 11.669 7.129 12 6 12c-3.314 0-6-2.686-6-6s2.686-6 6-6 6 2.686 6 6c0 1.55-.604 2.949-1.569 4.014.024-.001.045-.014.069-.014.681 0 1.233.462 1.416 1.084zM6 2C3.791 2 2 3.791 2 6s1.791 4 4 4 4-1.791 4-4-1.791-4-4-4z"
                                      class="cls-3"/>
                            </svg>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="head__right">
            @if ($user)
                @include('parts.user-menu')
            @else
                <a href="/login" class="head__menu__btn js-open-auth" data-link-type="popup">Вход</a>
            @endif
        </div>
    </div>
</header>

@include('parts.overlays')
@yield('overlays')


<div class="container">
    <main class="main" role="main">

        @yield('content')

    </main>
    <input id="js-previous-url" type="hidden" value="/"/>
    @include('parts.footer')
</div>
</body>
</html>